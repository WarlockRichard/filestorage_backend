<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(){

        if($files = File::all()){
            return ['status' => 'success', 'data' => $files];
        }
        else{
            return ['status' => 'fail'];
        }
    }

    public function store(Request $request)
    {
            return ['status' => File::create(array(
                'user_id' => auth()->id(),
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

    public function destroy($id)
    {
        return ['status' => File::destroy($id)?'success':'fail'];
    }
}
