<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;


use App\Models\Incidence;
use App\Models\InsidenceAttacement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

   public function Home(){
    return view('frontend.home');
   }

   public function About(){
    return view('frontend.pages.about');
   }


   public function Contact(){
    return view('frontend.pages.contact');
   }


   public function RepoRtIncidence(){
    return view('frontend.pages.report_incidence');
   }


   public function SaveIncidence(Request $request)
   {
       $validated = $request->validate([
           'tittle' => 'required|string|max:255',
           'description' => 'required|string',
           'latitude' => 'required',
           'longitude' => 'required',
           'user_name' => 'required|string|max:255',
           'phone' => 'required|string|max:20',
           'region' => 'required|string|max:100',
           'district' => 'required|string|max:100',
           'ward' => 'required|string|max:100',
           'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
       ]);

       DB::beginTransaction();

       try {
           // Save Incidence
           $incidence = Incidence::create([
               'description' => $request->description,
               'tittle' => $request->tittle,
               'latitude' => $request->latitude,
               'longitude' => $request->longitude,
               'user_name' => $request->user_name,
               'phone' => $request->phone,
               'region' => $request->region,
               'district' => $request->district,
               'ward' => $request->ward,
               'resolve_status' => 1,
               'archive' => 0,
               'status' => 1,
           ]);

           // Save Attachments
           if ($request->hasFile('images')) {
               foreach ($request->file('images') as $file) {
                   $path = $file->store('attachements', 'public');

                   InsidenceAttacement::create([
                       'incidence_id' => $incidence->id,
                       'type' => 1,
                       'attachement' => "/storage/" . $path,
                       'status' => 1,
                       'archive' => 0,
                   ]);
               }
           }

           DB::commit();

           return response()->json([
               'status' => 'success',
               'message' => 'Incidence reported successfully.',
               'data' => [
                   'incidence_id' => $incidence->id,
               ],
           ]);
       } catch (\Exception $e) {
           DB::rollBack();

           return response()->json([
               'status' => 'error',
               'message' => 'Failed to save incidence. ' . $e->getMessage(),
           ], 500);
       }
   }


    public function updateImagesForIncidence(Request $request)
    {
        $validated = $request->validate([
            'incidence_id' => 'required|exists:incidences,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Check if files are present
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $path = $file->store('attachements', 'public');

                    InsidenceAttacement::create([
                        'incidence_id' => $request->incidence_id,
                        'type' => 2,
                        'attachement' => "/storage/" . $path,
                        'status' => 1,
                        'archive' => 0,
                    ]);
                }

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Images uploaded successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No images were uploaded.',
                ], 400);
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to upload images. ' . $e->getMessage(),
            ], 500);
        }
    }



    public function Logout(){
        Auth::logout();

        Session::flush();

        return redirect()->route('home');
    }


    public function newuseraccount(){
        return view('frontend.pages.register');
    }


    public function createAccount(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'phone'      => 'required|string|max:20',
        'email'      => 'required|email|unique:users,email',
        'password'   => 'required|string|min:6',
    ]);

    User::create([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'phone'      => $request->phone,
        'email'      => $request->email,
        'password'   => Hash::make($request->password),
        'user_type_id'  => 3,
    ]);

    return response()->json(['status' => 'success', 'message' => 'Account created successfully']);
}


public function defaultlogin(){
    return view('frontend.pages.auth');
}


public function authenticate(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'user_type' => $user->user_type,
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid email or password.'
    ]);
}

}
