<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Incidence;
use App\Models\IncidenceStatus;
use App\Models\InsidenceAttacement;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class DashboardController extends Controller
{

    public function MyProfile(){
        $wards =[];
        $user = User::findOrfail(Auth::user()->id);
        return view('backend.pages.profile', compact('user', 'wards'));
    }


        public function UpdateProfile(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone,' . Auth::user()->id, // Allow unique except for the current user
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $userID = Auth::user()->id;
            $user = User::find($userID);


            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                // Delete old profile image if exists
                $oldImagePath = str_replace('storage/', '', $user->profile_image);
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($oldImagePath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldImagePath);
                }
            }


                $imagePath = $request->file('profile_image')->store('UserProfileImages', 'public');
                $validated['profile_image'] = 'storage/' . $imagePath;
            } else {
                $validated['profile_image'] = $user->profile_image;
            }

            // Update user details
            $user->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'data' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
        ]);

            $userID = Auth::user()->id;
            $user = User::find($userID);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect.',
            ], 400);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.',
        ]);
    }

    public function DashboardHome(){
        $issuescount = 0;
        $resolvedissues = 0;
        $unresolvedissues = 0;
        $subscribers = 0;
        $consultants = [];
        $pendingCount = 0;
        $inProgressCount = 0;;
        $resolvedCount = 0;

        $year = now()->year;

        $monthlyReports = Incidence::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->where('archive', 0)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $monthlyCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyCounts[] = $monthlyReports[$i] ?? 0;
        }

        $reportedIssues = Incidence::where('archive', 0)->count();
        $availableConsultants = Company::where('archive', 0)->count();

        $pendingCount = Incidence::where('archive', 0)->where('resolve_status', 1)->count();
        $inProgressCount = Incidence::where('archive', 0)->where('resolve_status', 2)->count();
        $resolvedCount = Incidence::where('archive', 0)->where('resolve_status', 3)->count();

        $issuescount = Incidence::where('archive', 0)->count();
        $resolvedissues = Incidence::where('archive', 0)->where('resolve_status', 3)->count();
        $unresolvedissues = Incidence::where('archive', 0)->whereIn('resolve_status', [1,2])->count();

        $consultants = Company::with('manager', 'incidences')->where('archive', 0)->get();

        // return response()->json($consultants);
        return view('backend.pages.dashboard', compact(
            'issuescount',
            'resolvedissues',
            'unresolvedissues',
            'subscribers',
            'consultants',
            'pendingCount',
            'inProgressCount',
            'resolvedCount',
            'reportedIssues',
            'availableConsultants',
            'monthlyCounts'
        ));

    }

    public function LoginCheck(Request $request){
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully!',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password!',
            ], 401);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed!',
                // 'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred!',
                'error' => $e->getMessage(),
            ], 500);
        }
     }

     public function ReportedIncidences(){
        $consultants = Company::where('archive', 0)->get();
        $inc_statuses = IncidenceStatus::where('archive', 0)->get();
        $incidences = Incidence::with('attachments', 'consultant', 'statuses')->where('archive', 0)->get();
    //   return response()->json($incidences);
        return view('backend.pages.reported_issues', compact('inc_statuses','consultants','incidences'));
     }


     public function resolvedIssues(){
        $consultants = Company::where('archive', 0)->get();
        $inc_statuses = IncidenceStatus::where('archive', 0)->get();
        $incidences = Incidence::with('attachments', 'consultant', 'statuses')
        ->where('resolve_status', 3)
        ->where('archive', 0)->get();
    //   return response()->json($incidences);
        return view('backend.pages.resolved_issues', compact('inc_statuses','consultants','incidences'));
     }

     public function unresolvedIssues(){
        $consultants = Company::where('archive', 0)->get();
        $inc_statuses = IncidenceStatus::where('archive', 0)->get();
        $incidences = Incidence::with('attachments', 'consultant', 'statuses')
        ->where('resolve_status', 1)
        ->orWhere('resolve_status', 2)
        ->where('archive', 0)->get();
    //   return response()->json($incidences);
        return view('backend.pages.un_resolved_issues', compact('inc_statuses','consultants','incidences'));
     }

     public function CompanyIncidence($id){

        $consultants = Company::where('archive', 0)->get();
        $inc_statuses = IncidenceStatus::where('archive', 0)->get();
        $incidences = Incidence::with('attachments', 'consultant', 'statuses')
        ->where('assigned_company', $id)
        ->where('archive', 0)->get();
    //   return response()->json($incidences);
        return view('backend.pages.companyincidencepage', compact('inc_statuses','consultants','incidences'));
     }


     public function Consultant(){

        $mangers = User::where('user_type_id', 2)->orWhere('user_type_id', 1)->get();
        $companies = Company::with('manager', 'bases')->where('archive', 0)->get();
        $cocategories = CompanyCategory::where('archive', 0)->get();
        //return response()->json($companies);
        return view('backend.pages.consultants', compact( 'mangers', 'cocategories', 'companies'));
     }

     public function MyCompany(){

        $adminID = Auth::user()->id;

        $mangers = User::where('user_type_id', 2)->orWhere('user_type_id', 1)->get();
        $companies = Company::with('manager', 'incidences', 'bases')
        ->where('admin_id', $adminID)
        ->where('archive', 0)->get();
        $cocategories = CompanyCategory::where('archive', 0)->get();
        // return response()->json($companies);
        return view('backend.pages.my_company', compact( 'mangers', 'cocategories', 'companies'));
     }


     public function Managers(){
        $managers = User::where('user_type_id', 2)->orWhere('user_type_id', 1)->with('companies')->get();
        // return response()->json($managers);
        return view('backend.pages.company_managers', compact('managers'));
     }

     public function SystemManger(){
        $managers = User::where('user_type_id', 5)->orWhere('user_type_id', 1)->with('companies')->get();
        // return response()->json($managers);
        return view('backend.pages.system_manager', compact('managers'));
     }


     public function addCompanyAdmin(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email',
        'phone'      => 'required|string|max:20',
        'password'   => 'required|string|min:6',
    ]);


    try {
        $admin = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'user_type_id'  => 2, // Assuming 1 represents admin
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Admin added successfully.',
            'data'    => [
                'admin_id' => $admin->id,
            ],
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Failed to add admin. ' . $e->getMessage(),
        ], 500);
    }
}


     public function addSystemManager(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email',
        'phone'      => 'required|string|max:20',
        'password'   => 'required|string|min:6',
    ]);


    try {
        $admin = User::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'user_type_id'  => 1, // Assuming 1 represents admin
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Admin added successfully.',
            'data'    => [
                'admin_id' => $admin->id,
            ],
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Failed to add admin. ' . $e->getMessage(),
        ], 500);
    }
}
     public function AddCompany(Request $request){
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:company_categories,id',
            'admin' => 'required|exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            $company = Company::create([
                'name' => $validated['company_name'],
                'description' => $validated['description'],
                'category' => $validated['category_id'],
                'admin_id' => $validated['admin'],
                'status' => 1,
                'archive' => 0,
            ]);

            // Associate admin and address if necessary
            // For example, if there's a pivot table or related models

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Company registered successfully.',
                'data' => [
                    'company_id' => $company->id,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to register company. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function assignConsultant(Request $request)
    {
        $request->validate([
            'incident_id' => 'required',
            'consultant_id' => 'required',
        ]);

        $incident = Incidence::find($request->incident_id);
        $incident->assigned_company = $request->consultant_id;
        $incident->save();

        return response()->json(['success' => true, 'message' => 'Consultant assigned successfully.']);
    }

    public function updateIncidentStatus(Request $request)
{
    $request->validate([
        'incident_id' => 'required',
        'statusID' => 'required',
    ]);

    try {
        $incident = Incidence::findOrFail($request->incident_id);
        $incident->resolve_status = $request->statusID;
        $incident->save();

        return response()->json(['success' => true, 'message' => 'Incident status updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to update status.'], 500);
    }
}

public function reassignOrRemoveConsultant(Request $request)
{
    $request->validate([
        'incident_id' => 'required',
        'new_consultant_id' => 'nullable', // allow null for removing
    ]);

    try {
        $incident = Incidence::findOrFail($request->incident_id);
        $incident->assigned_company = $request->new_consultant_id?? null; // null means remove
        $incident->save();

        $msg = $request->new_consultant_id
            ? 'Consultant reassigned successfully.'
            : 'Consultant removed from incident.';

        return response()->json(['success' => true, 'message' => $msg]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to update consultant.'], 500);
    }
}

public function IncidencePreview($id)
{
    $incidence = Incidence::with(['attachments', 'consultant', 'statuses'])
        ->where('archive', 0)
        ->findOrFail($id);

    // Filter attachments by incidence_status
    $beforeAttachments = InsidenceAttacement::
    where('incidence_id', $id)
     ->where('type', 1)
    // ->orwhere('type', 2)
    ->where('archive', 0)->get();


    $afterAttachments = InsidenceAttacement::
    where('incidence_id', $id)
    ->where('type', 2)
    ->where('archive', 0)->get();


    // return $beforeAttachments;

    return view('backend.pages.preview_incidence', compact('incidence', 'beforeAttachments', 'afterAttachments'));
}

}
