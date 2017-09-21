<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller
{
    public function logout(Request $request){
        JWTAuth::logout();
        return ['status' => 'success'];
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $token = JWTAuth::attempt($credentials);

        if ($token) {
            return ['token' => $token, 'status' => 'success'];//response()->json()
        } else {
            return response()->json(['code' => 401, 'status' => 'Invalid credentials.'], 401);
        }
    }

    public function getUser(Request $request)
    {
        JWTAuth::setToken($request->header('Authorization'));
        try{
            $user = JWTAuth::toUser();
        }
        catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return ['status' => 'success', 'user' => $user];
    }
}
