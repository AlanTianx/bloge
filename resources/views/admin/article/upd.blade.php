@extends('layout/admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 添加分类
</div>
<!--面包屑导航 结束-->
<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>快捷操作</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>新增文章</a>
            <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
            <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <div class="mark">
        @if(count($errors)>0)
            @if(is_object($errors))
                @foreach($errors->all() as $error)
                    <p style="color:red">{{$error}}</p>
                @endforeach
            @else
                <p style="color:red">{{$errors}}</p>
            @endif
        @endif
    </div>
    <form action="{{url('admin/article/').'/'.$cate->cate_id}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>父级分类：</th>
                <td>
                    <select name="cate_id">
                        @foreach($date as $v)
                            <option value="{{$v['cate_id']}}"
                                @if($cate['cate_id']==$v->cate_id) selected @endif
                            >{{$v['cate_name']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>标题：</th>
                <td>
                    <input type="text" name="article_title" value="{{$cate['article_title']}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>编辑：</th>
                <td>
                    <input type="text" class="lg" name="article_tag" value="{{$cate['article_tag']}}">
                    <p>标题可以写30个字</p>
                </td>
            </tr>
            <tr>
                <th>缩略图：</th>
                <td>
                    <input name="article_thumb" type="text" value="{{$cate['article_thumb']}}" id="thumb">
                    <input id="file_upload" name="article" type="file">
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                    <p onclick="upload_img()">upload</p>
                </td>
                <script>
                    function upload_img(){
                        var data = new FormData();
                        var token = $("#token").val();
                        var file = document.getElementById('file_upload').files[0];
                        data.append('myfile',file);
                        data.append('_token', token);
                        $.ajax({
                            {{--headers: { 'X-CSRF-TOKEN' : '{{csrf_token()}}' },--}}
                            url : '{{url('upload')}}',
                            type : 'post',
                            data : data,
                            cache : false,
                            contentType : false,
                            processData : false,
                            dataType : 'json',
                            success : function(data) {
                                if(data.status=='1'){
                                    alert('upload success');
                                    var p = data.file_path;
                                    $('#thumb').val(p)
                                }
                            },
                            error : function (data) {
                                if(data.status=='0'){
                                    alert('upload failed');
                                }
                            }
                        })
                    }
                </script>
            </tr>
            <tr>
                <th>预览：</th>
                <td>
                    <img alt="44" style="max-height: 100px;max-width: 350px" src="{{'/uploads/'.$cate['article_thumb']}}">
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="article_description">{{$cate['article_description']}}</textarea>
                </td>
            </tr>
            <tr>
                <th>文章内容：</th>
                <td>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/ueditor.all.min.js')}}"> </script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script id="editor" name="article_content" type="text/plain" style="width:820px;height:300px;">{!! $cate['article_content'] !!}</script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection