<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function upload()
    {
        $file = Input::file('myfile');
//        dd($file);
        if($file->isValid()){
            $realPath = $file->getRealPath(); //临时文件的绝对路径
            $entension = $file->getClientOriginalExtension();//临时文件的后缀
            $filename = date('YmdHis').rand(100,999).'.'.$entension;
            $path = $file->move('./uploads',$filename);
            $data['status'] = '1';
            $data['file_path'] = $filename;
            return json_encode($data);
        }else{
            $data = ['status'=>'0','msg'=>'faild'];
            echo json_encode($data);
        }
    }
}
