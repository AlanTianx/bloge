<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class LoginController extends CommonController
{
    public function login(){
        if($input=Input::all()){
            $vf_code = new \Code();
            if(strtoupper($input['vf_code'])!=$vf_code->get()){
                return back()->with('error','验证码错误');
            }
            $user = User::first();
            if($input['user_name']==$user['user_name']&&$input['user_pass']==Crypt::decrypt($user['user_pwd'])){
                session(['user'=>$user]);
                return redirect(route('A_index'));
            }else{
                return back()->with('error','用户名或密码错误');
            }
        }else{
            return view('admin.login');
        }
    }

    /**
     * 验证码
     * */
    public function vf_code(){
        $vf_code = new \Code();
        return $vf_code->make();
    }
}
