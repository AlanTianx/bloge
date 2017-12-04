<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    // get.admin/category  分类列表
    public function index(){
        $cate = (new Category)->tree();
        return view('admin.category.index',compact('cate'));
    }

    public function change_order()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        if($cate->update()){
            $data = [
                'status' => 0,
                'mas' => '分类排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'mas' => '分类排序更新失败！请稍后重试!',
            ];
        }
        return $data;
    }

    // get.admin/category/create 添加分类
    public function create(){
        $date = Category::where('cate_pid',0)->get();
        return view('admin.category.add')->with('date',$date);
    }
    // post  category.store 添加分类提交
    public function store()
    {
        $input = Input::except('_token'); //接收除了token之外的数据
        $rules = [
            'cate_name' => 'required',
        ];
        //规则信息反馈
        $message = [
            'cate_name.required' => '分类名称不能为空',
        ];
        //验证服务

        $validator = Validator::make($input, $rules, $message);
        if ($validator->passes()){
            if(Category::insert($input)){
                return redirect('admin/category');
            }else{
                return back()->with('errors','服务器异常，添加失败');
            }
        } else
        {
            return back()->withErrors($validator);
        }
    }
    // delete.admin/category/{category} 删除单个分类
    public function destroy($id){
        if(Category::where('cate_id',$id)->delete()){
            $data=[
                'status'=> 0,
                'msg' => '分类已经成功删除！'
            ];
        }else{
            $data=[
                'status'=> 1,
                'msg' => '服务器异常，删除失败！'
            ];
        }
        return $data;
    }
    //  put.admin/category/{category} 更新分类
    public function update($id){
        $input = Input::except('_token','_method');
        if(Category::where('cate_id',$id)->update($input)){
            return redirect('admin/category');
        }else{
            return back()->with('errors','数据更新失败');
        }
    }
    //grt.admin/category/{category}  显示单个分类

    public function show(){
        echo "get333";
    }
    //get.admin/category/{category}/edit 编辑分类
    public function edit($id){

        $date = Category::where('cate_pid',0)->get();
        $cate = Category::find($id);
        return view('admin.category.upd',compact('date','cate'));
    }
}
