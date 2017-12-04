<?php
/**
 * Created by PhpStorm.
 * User: tian
 * Date: 2017/8/31
 * Time: 17:37
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Admin\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController{

    public function index()
    {
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }
    public function logout()
    {
        session(['user'=>null]);
        return redirect(route('A_login'))->with('error','成功退出！');
    }
    public function upd_pwd()
    {
        if($input = Input::all())
        {
            if($input['password_o']!= Crypt::decrypt(session('user.user_pwd')))
            {
                return back()->with('errors','原密码错误');
            }else
            {
                //验证规则
                $rules = [
                    'password' => 'required|between:6,20',
                ];
                //规则信息反馈
                $message = [
                    'password.required' => '新密码不能为空',
                    'password.between' => '请注意：新密码必须在6～20位之间',
                ];
                //验证服务
                $validator = Validator::make($input, $rules, $message);
                if ($validator->passes())
                {
                    $user = User::where('user_id', session('user.user_id'))->first();
                    $user->user_pwd = Crypt::encrypt($input['password']);
                    if ($user->update())
                    {
                        session(['user' => null]);
                        return redirect(route('A_login'))->with('error','密码修改成功!请重新登录');
                    }
                } else
                {
                    return back()->withErrors($validator);
                }
            }
        }else
        {
            return view('admin.pass');
        }
    }
}