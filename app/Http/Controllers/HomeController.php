<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
    public function getStudent()
    {
        $user=User::get();
        return view('admin.student',compact('user'));
    }
    public function landing()
    {
        return view('home');
    }
    public function course()
    {
        return view('admin.course');
    }
    public function edituser($id)
    {
       return view('admin.edituser');

        // return view('admin.edituser',compact('user'));
    }
    public function delete($id)
    {
        $user=User::find($id)->delete();
        return Redirect()->back();
    }

}
