<?php
namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// use Firebase\JWT\ExpiredException;
// use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    // protected $request;
    public function __construct()
    {
        // $this->request = $request;
    }

    protected function jwt($data) {
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $data->password, 
            'iat' => time(), 
            'exp' => time() + 60*60 
        ];
        Log::info("Generate Token");
        return JWT::encode($payload, 'JWT_SECRET');
    } 

    public function authenticate(Request $request, User $user) {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        
        $user = User::where('email', $request->input('email'))->first();
        if(!$user)
        {
            Log::error('Email does not exist.');
            return response()->json(['eror' => 'Email does not exist.'], 400);
        }

        // $user = ;
        if(Hash::check($request->input('password'), $user->password))
        {
            // Log::info("Generate Token");php artisan 
            return response()->json([
                'token' => $this->jwt($request)
            ], 200);
        }
        return response()->json([
            'email' => $request->input('email'),
            'password'=> hash('md5', $request->input('password')),
            'token' => $this->jwt($request)
        ], 200);
        

        // return response()->json([
        //     'error' => 'Email or password is wrong.'
        // ], 400);
    }
}