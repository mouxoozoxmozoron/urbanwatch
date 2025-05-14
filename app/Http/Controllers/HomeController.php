<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
