<?php

namespace App\Http\Controllers;

use App\Jobs\SaveExcel;
use Illuminate\Http\Request;
use App\Imports\UsersAgeImport;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{

    public function import(Request $request){

        if ($request->hasFile('file')){

            $file = $request->file('file');
            $title = $file->getClientOriginalName();
            $file->move(storage_path() . '/file/', $title);

            SaveExcel::dispatch($title);
            

            return 'Preocesando archivo...';
        }
        return 'sin archivo';

    }

    public function data(){
        
    }
}
