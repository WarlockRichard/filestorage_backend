<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use JWTAuth;

class FileController extends Controller
{
    public function index(Request $request){

        try{
            JWTAuth::setToken($request->header('Authorization'));
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], $e->getStatusCode());

        }
        if($files = File::all()){
            return ['status' => 'success', 'data' => $files];
        }
        else{
            return ['status' => 'fail'];
        }
    }

    public function store(Request $request)
    {

        try{
            JWTAuth::setToken($request->header('Authorization'));
            $user = JWTAuth::toUser();
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], $e->getStatusCode());

        }
            return ['status' => File::create(array(
                'user_id' => $user->id,
                'path' => request('author'),
                'type' => request('text')
            ))
                ?'success':'fail'];
    }

    public function show($id)
    {
        if($file = File::find($id)){
            return ['status' => 'success', 'data' => $file];
        }
        else{
            return ['status' => 'fail'];
        }
    }

    public function destroy($id, Request $request)
    {
        try{
            JWTAuth::setToken($request->header('Authorization'));
            $user = JWTAuth::toUser();
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], $e->getStatusCode());

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], $e->getStatusCode());

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], $e->getStatusCode());

        }
        $file = File::find($id);
        if($file->user_id == $user->id){
            return ['status' => File::destroy($id)?'success':'fail'];
        }
        else{
            response()->json(['error' => 'Some tea?'], 418);
        }
    }
}
