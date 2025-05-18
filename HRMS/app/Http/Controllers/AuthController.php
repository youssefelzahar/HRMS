<?php

namespace App\Http\Controllers;

use App\ControllerRepo\AuthReprository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\ResponseTrait;
use App\Http\Requests\AuthRequest;

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
    public function index(AuthRequest $request){
        $user = $this->reprisotry->getAll();
        return $this->success(
            data: $user,
            message: "success to login",
        );
    }
    public function login(AuthRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            
            // Find the tenant by email
            $tenant = Tenant::whereHas('domains', function ($query) use ($request) {
                $query->where('domain', 'like', '%' . explode('@', $request->email)[0] . '%');
            })->first();

            if (!$tenant) {
                return $this->failure(
                    message: "Login failed",
                    error: "Tenant not found"
                );
            }

            // Try to authenticate in the tenant's context
            $tenant->run(function () use ($credentials, &$user, &$token) {
                if (!Auth::attempt($credentials)) {
                    return false;
                }
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
                return true;
            });

            if (!isset($user)) {
                return $this->failure(
                    message: "Login failed",
                    error: "Invalid credentials"
                );
            }

            return $this->success(
                data: [
                    'token' => $token,
                    'user' => $user,
                    'domain' => $tenant->domains->first()->domain
                ],
                message: "success to login"
            );
        } catch (\Exception $e) {
            return $this->failure(
                message: "Login failed",
                error: $e->getMessage()
            );
        }
    }

 
       public function register(AuthRequest $request)
       {
        try {
            // Create a new tenant
            $tenant = Tenant::create();
            $domain = strtolower(str_replace(' ', '', $request->name)) . '.localhost';
            $tenant->domains()->create(['domain' => $domain]);

            // Initialize the tenant
            $tenant->run(function () {
                // Run migrations for the tenant
                \Artisan::call('migrate', [
                    '--force' => true,
                    '--path' => 'database/migrations/tenant',
                ]);
            });

            // Create user in tenant database
            $tenant->run(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                // Create a default department for the tenant
                DB::table('departments')->insert([
                    'name' => 'Default Department',
                    'description' => 'Default department for new tenant',
                    'version' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return $user;
            });

            return $this->success(
                data: [
                    'domain' => $domain
                ],
                message: "success to register",
            );
        } catch (\Exception $e) {
            return $this->failure(
                message: "Registration failed",
                error: $e->getMessage()
            );
        }
    }
}
