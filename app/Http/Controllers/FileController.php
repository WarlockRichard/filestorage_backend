<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions;

class FileController extends Controller
{
    public function index(Request $request, Filesystem $filesystem){
        try{
            $user = JWTAuth::parseToken()->toUser();
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
        if($files = File::where('user_id', $user->id)->get()){
            $result = [];
//            $result = $filesystem->allFiles('/OSPanel/domains/backend.dev/storage/app/files/upload');
            foreach ($files as $file){
                $fullPath = storage_path('app/'.$file->path);
                if($filesystem->exists($fullPath)){
                    $info = [];
                    $info['id'] = $file->id;
                    $info['path'] = $file->path;
                    $info['original_name'] = $file->original_name;
                    $info['created_at'] = $file->created_at->toDateTimeString();
                    $info['size'] = $filesystem->size($fullPath);
                    $result[] = $info;
                }
            }

            return ['status' => 'success', 'data' => $result];
        }
        else{
            return ['status' => 'fail'];
        }
    }

    public function store(Request $request)
    {
        try{
            $user = JWTAuth::parseToken()->toUser();;
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
        $path = $request->file->store('files/'.time());
//        return request();
        return ['status' => File::create(array(
            'user_id' => $user->id,
            'path' => $path,
            'original_name' => $request->file->getClientOriginalName()
        ))
            ?'success':'fail'];
    }

    public function show($id)
    {
        try{
            $user = JWTAuth::parseToken()->toUser();
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
        if($file = File::where('user_id', $user->id)->find($id)){
            $fullPath = storage_path('app/'.$file->path);
            return response()->download(storage_path($fullPath));//['status' => 'success', 'data' => $file];
        }
        else{
            return ['status' => 'fail'];
        }
    }

    public function destroy($id, Request $request, Filesystem $filesystem)
    {
        try{
            $user = JWTAuth::parseToken()->toUser();
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
        if($file = File::where('user_id', $user->id)->find($id)){
            $fullPath = storage_path('app/'.$file->path);
            $filesystem->delete($fullPath);
            return ['status' => File::destroy($id)?'success':'fail'];
        }
        else{
            response()->json(['error' => 'File not found'], 404);
        }
    }

    public function download($id, Request $request)
    {
        try{
            $user = JWTAuth::parseToken()->toUser();;
        } catch (Exceptions\TokenExpiredException $e) {

            return response()->json(['error' => 'token_expired'], 401);

        } catch (Exceptions\TokenInvalidException $e) {

            return response()->json(['error' => 'token_invalid'], 401);

        } catch (Exceptions\JWTException $e) {

            return response()->json(['error' => 'token_absent'], 401);

        }
        if($file = File::where('user_id', $user->id)->find($id)) {
            return response()->download(storage_path('app/'.$file->path));
        }
        else{
            return response()->json(['error' => 'file_not_found'], 404);
        }
    }
}
