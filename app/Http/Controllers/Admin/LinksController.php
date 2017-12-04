<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    public function index()
    {
        $cate = Links::orderBy('link_order','asc')->paginate(2);
        return view('admin.links.index',compact('cate'));
    }
    public function create()
    {
        return view('admin.links.add');
    }

    public function store()
    {

        $post = Input::except(array('_token'));
        //dd($post);
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required'
        ];
        //规则信息反馈
        $message = [
            'link_name.required' => '链接名不能为空',
            'link_url.required' => '链接Url不能为空',
        ];
        //验证服务
        $validator = Validator::make($post, $rules, $message);
        if ($validator->passes()){
            if(Links::create($post)){
                return redirect('admin/links');
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
        $cate = Links::find($id);
        return view('admin.links.upd',compact('cate'));
    }
    public function update($id){
        $input = Input::except('_token','_method');
        if(Links::where('link_id',$id)->update($input)){
            return redirect('admin/links');
        }else{
            return back()->with('errors','数据更新失败');
        }
    }

    public function destroy($id)
    {
        if(Links::where('link_id',$id)->delete()){
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
        $cate = Links::find($input['link_id']);
        $cate->link_order = $input['link_order'];
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
