@extends('layout.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加文章</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/article')}}" method="post" id="t">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120">分类：</th>
                <td>
                    <select name="cate_id">
                        @foreach($date as $d)
                        <option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i> 文章标题：</th>
                <td>
                    <input type="text" class="lg" name="article_title">
                </td>
            </tr>
            <tr>
                <th>编辑：</th>
                <td>
                    <input type="text" class="sm" name="article_tag">
                </td>
            </tr>
            <tr>
                <th>缩略图：</th>
                <td>
                    <input name="article_thumb" type="text" value="" id="thumb">
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
                                    $('#thumb').val(p);
                                    $('#up_img').attr('src','/uploads/'+p)
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
                    <img src="" id="up_img" style="max-height: 100px;max-width: 350px">
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="article_description"></textarea>
                </td>
            </tr>

            <tr>
                <th>文章内容：</th>
                <td>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/ueditor.all.min.js')}}"> </script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script id="editor" name="article_content" type="text/plain" style="width:820px;height:300px;"></script>
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
