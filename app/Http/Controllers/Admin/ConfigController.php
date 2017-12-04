<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Admin\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    public function index()
    {
        $cate = Config::orderBy('conf_order','asc')->paginate(2);
        foreach($cate as $k => $v){
            switch($v->field_type){
                case 'input':
                    $cate[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'" />';
                    break;
                case 'textarea':
                    $cate[$k]->_html = '<textarea name="conf_content[]" cols="30" rows="10">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    $da = explode(',',$v->field_value);
                    $str = '';
                    if($da){
                        foreach($da as $value){
                            $dc = explode('|',$value);
                            if($v->conf_content==$dc[0]) {
                                $str .= '<input type="radio" name="conf_content[]" checked value="' . $dc[0] . '" />' . $dc[1] . '　';
                            }else{
                                $str .= '<input type="radio" name="conf_content[]" value="' . $dc[0] . '" />' . $dc[1] . '　';
                            }
                        }
                        $cate[$k]->_html = $str;
                    }else{
                        $cate[$k]->_html = '';
                    }
                    break;
            }
        }
        return view('admin.config.index',compact('cate'));
    }
    public function create()
    {
        return view('admin.config.add');
    }

    public function store()
    {
        $post = Input::except(array('_token'));
        //dd($post);
        $rules = [
            'conf_title' => 'required',
            'conf_name' => 'required'
        ];
        //规则信息反馈
        $message = [
            'conf_title.required' => '配置项标题不能为空',
            'conf_name.required' => '配置项名不能为空'
        ];
        //验证服务
        $validator = Validator::make($post, $rules, $message);
        if ($validator->passes()){
            if(Config::create($post)){
                return redirect('admin/config');
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
        $cate = Config::find($id);
        return view('admin.Config.upd',compact('cate'));
    }

    public function update($id){
        $input = Input::except('_token','_method');
        if(Config::where('conf_id',$id)->update($input)){
            return redirect('admin/config');
        }else{
            return back()->with('errors','数据更新失败');
        }
    }

    public function destroy($id)
    {
        if(Config::where('conf_id',$id)->delete()){
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

    public function change_cccc()
    {
        $da = Config::all();
        dd($da);
    }
    public function change_order()
    {
        $input = Input::all();
        $cate = Config::find($input['conf_id']);
        $cate->conf_order = $input['conf_order'];
        if($cate->update()){
            $data = [
                'status' => 0,
                'mas' => '配置项排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'mas' => '配置项排序更新失败！请稍后重试!',
            ];
        }
        return $data;
    }

    public function change_content(Request $request)
    {
        //dd($request->id);
//        $input = $request->input();
//        dd($request->query('id'));
        //dd($request->fullUrl());
        //dd($request);
//        if($request->is('admin/*')){
//            dd($request->path());
//        }else{
//            return back()->with('errors','非法访问！');
//        }
        //dd(Input::all());
        $input = $request->input();
        //dd($input);
        //$input = Input::all();
        foreach($input['id'] as $k=>$v){
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        return back()->with('errors','配置项值修改成功！');
    }
}
