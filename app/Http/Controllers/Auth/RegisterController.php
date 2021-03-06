<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/viewUsers';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'admin' => 'required|max:1',
            'course' => 'required|string|max:255',
            'duration'=> 'required|integer|max:11',
            'password' => 'required|string|min:6|confirmed',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'admin' => $data['admin'],
            'password' => bcrypt($data['password']),
        ]);
        
        if($data['role']=="Teacher")
        {
        $teacher=Teacher::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'cname'=>$data['course'],
            'duration'=>$data['duration']
        ]);
        }
        if($data['role']=="Student")
        {
        $student=Student::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'cname'=>$data['course'],
            'duration'=>$data['duration']
        ]);
        }
        $course=new Course();
        $course->cname=$data['course'];
        $course->duration = $data['duration'];
        $user->course()->save($course);
        return $user;
    }
}
