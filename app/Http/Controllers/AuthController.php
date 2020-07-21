<?php
namespace App\Http\Controllers;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
// use Firebase\JWT\ExpiredException;
// use Illuminate\Support\Facades\Hash;

class AuthController extends controller
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function jwt() {
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $this->request->password, 
            'iat' => time(), 
            'exp' => time() + 60*60 
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    public function authenticate() {
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if($this->request)
        {
            return response()->json([
                'token' => $this->jwt()
            ], 200);
        }

        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
}