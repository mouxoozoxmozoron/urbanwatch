<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyCategory;
use App\Models\Incidence;
use App\Models\IncidenceStatus;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function DashboardHome(){
        return view('backend.pages.dashboard');
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


     public function Consultant(){

        $mangers = User::where('user_type_id', 2)->orWhere('user_type_id', 1)->get();
        $companies = Company::with('manager', 'bases')->where('archive', 0)->get();
        $cocategories = CompanyCategory::where('archive', 0)->get();
        //return response()->json($companies);
        return view('backend.pages.consultants', compact( 'mangers', 'cocategories', 'companies'));
     }


     public function Managers(){
        $managers = User::where('user_type_id', 2)->orWhere('user_type_id', 1)->with('companies')->get();
        // return response()->json($managers);
        return view('backend.pages.company_managers', compact('managers'));
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
}
