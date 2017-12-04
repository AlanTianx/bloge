<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Article;
use App\Http\Model\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index(){
        $cate = Article::join('category','category.cate_id','=','article.cate_id')->orderBy('article_id','desc')->paginate(2);

        //dd($cate->links());
        return view('admin.article.index',compact('cate'));
    }
    public function create(){
        $date =  (new Category)->tree(['cate_id','cate_name']);
        return view('admin.article.add',compact('date'));
    }
    public function store()
    {
        $post = Input::except(array('_token','article'));
        $post['article_time'] = time();
        //dd($post);
        $rules = [
            'article_title' => 'required',
            'article_content' => 'required'
        ];
        //规则信息反馈
        $message = [
            'article_title.required' => '文章标题不能为空',
            'article_content.required' => '文章内容不能为空',
        ];
        //验证服务
        $validator = Validator::make($post, $rules, $message);
        if ($validator->passes()){
            if(Article::create($post)){
                return redirect('admin/article');
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
        echo base_path();
        $date = Category::get();
        $cate = Article::find($id);
        return view('admin.article.upd',compact('cate','date'));
    }

    public function update($id){
        $input = Input::except('_token','_method','article');
        $input['article_time'] = time();
        if(Article::where('cate_id',$id)->update($input)){
            return redirect('admin/article');
        }else{
            return back()->with('errors','数据更新失败');
        }
    }

    public function destroy($id)
    {
        if(Article::where('article_id',$id)->delete()){
            $data = [
                'status'=> 0,
                'msg' => '文章已经成功删除！'
            ];
        }else{
            $data = [
                'status'=> 1,
                'msg' => '服务器异常，删除失败！'
            ];
        }
        return $data;
    }
}
