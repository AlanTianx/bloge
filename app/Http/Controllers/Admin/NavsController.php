<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    public function index()
    {
        $cate = Navs::orderBy('nav_order','asc')->paginate(2);
        return view('admin.navs.index',compact('cate'));
    }
    public function create()
    {
        return view('admin.navs.add');
    }

    public function store()
    {
        $post = Input::except(array('_token'));
        //dd($post);
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required'
        ];
        //规则信息反馈
        $message = [
            'nav_name.required' => '导航名不能为空',
            'nav_url.required' => '导航Url不能为空',
        ];
        //验证服务
        $validator = Validator::make($post, $rules, $message);
        if ($validator->passes()){
            if(Navs::create($post)){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','服务器异常，添加失败');
            }
        } else
        {
            return back()->withErrors($validator);
        }
    }

    public function edit($id)
    {
        $cate = Navs::find($id);
        return view('admin.navs.upd',compact('cate'));
    }

    public function update($id){
        $input = Input::except('_token','_method');
        if(Navs::where('nav_id',$id)->update($input)){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','数据更新失败');
        }
    }

    public function destroy($id)
    {
        if(Navs::where('nav_id',$id)->delete()){
            $data = [
                'status'=> 0,
                'msg' => '链接已经成功删除！'
            ];
        }else{
            $data = [
                'status'=> 1,
                'msg' => '服务器异常，删除失败！'
            ];
        }
        return $data;
    }

    public function change_order()
    {
        $input = Input::all();
        $cate = Navs::find($input['nav_id']);
        $cate->nav_order = $input['nav_order'];
        if($cate->update()){
            $data = [
                'status' => 0,
                'mas' => '链接排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'mas' => '链接排序更新失败！请稍后重试!',
            ];
        }
        return $data;
    }
}
