<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions;

class AuthController extends Controller
{
    public function logout(Request $request){
        try{
            JWTAuth::parseToken()->invalidate();
//            JWTAuth::setToken($request->header('Authorization'));//->invalidate();

    	} catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
//        JWTAuth::invalidate();
        return ['status' => 'success'];
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return ['token' => $token, 'status' => 'success'];//response()->json()
    }

    public function getUser(Request $request)
    {
        try{
            JWTAuth::setToken($request->header('Authorization'));
            $user = JWTAuth::toUser();
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
        return ['status' => 'success', 'data' => $user];
    }
}
