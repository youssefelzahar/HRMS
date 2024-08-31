<?php

namespace App\Http\Controllers;

use App\ControllerRepo\AuthReprository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\ResponseTrait;
class AuthController extends Controller
{
    use ResponseTrait;

   protected $reprisotry;

    public function __construct(AuthReprository $reprisotry){
        $this->reprisotry = $reprisotry;
    }
    //

    public function showRegistrationForm(){

        return view('register');
    }
    public function index(Request $request){
        $user=$this->reprisotry->getAll();
        return $this->success(
            data:$user,
            message:"success to login",
        );
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $cardinatles=$request->only('email', 'password');
        if(!Auth::attempt($cardinatles)){
           return $this->failure(
        
            message:"failed to login",
            error:"failed to login"
           );

        }
        $user=Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->success(
            data:$token,
            message:"success to login",

        ); 
       }

 
       public function register(Request $request)
       {
           $request->validate([
               'name' => 'required',
               'email' => 'required|email|unique:users',
               'password' => 'required|min:6',
           ]);
    
           $user=$this->reprisotry->create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
           ]);
    
           return $this->success(
               data:$user,
               message:"success to register",
           );
       }
}
