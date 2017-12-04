@extends('layout/admin')
@section('content')
    <body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置项管理
    </div>
    <!--面包屑导航 结束-->

    <!--结果页快捷搜索框 开始-->
    <div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->
    <div class="result_title">
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
    <!--搜索结果页面 列表 开始-->

    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增配置</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#" onclick="location.reload();"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>
        <div class="result_wrap">

            <div class="result_content">
                <form action="{{url('admin/config/change_content')}}" method="post">
                    {{csrf_field()}}
                    <table class="list_tab">
                        <tr>
                            <th class="tc">排序</th>
                            <th class="tc">ID</th>
                            <th>配置标题</th>
                            <th>名称</th>
                            <th>内容</th>
                            <th>操作</th>
                        </tr>
                        @foreach($cate as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,{{$v['conf_id']}})" value="{{$v['conf_order']}}">
                            </td>
                            <td>{{$v['conf_id']}}</td>
                            <td>{{$v['conf_title']}}</td>
                            <td>{{$v['conf_name']}}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{$v->conf_id}}" />
                                {!! $v['_html'] !!}
                            </td>
                            <td>
                                <a href="{{url('admin/config/'.$v['conf_id'].'/edit')}}">修改</a>
                                <a onclick="delCate({{$v->conf_id}})" href="javascript:;">删除</a>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                    <div class="btn_group">
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回" >
                    </div>
                </form>

                <div class="page_list">
                    <ul>
                       {{$cate->links()}}
                    </ul>
                </div>
                <style>
                    .result_content ul li span {
                        font-size: 15px;
                        padding: 6px 12px;
                    }
                </style>
            </div>
        </div>

<!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj,conf_id){
            $.post('{{url('admin/config/change_order')}}',{'_token':'{{csrf_token()}}','conf_order': obj.value,'conf_id':conf_id}, function (data) {
                if(data.status==0){
                    layer.msg(data.mas, {icon: 6});
                }else {
                    layer.msg(data.mas, {icon: 5});
                }

            })
        }
        function delCate(id){
            layer.confirm('你确定要删除这个链接吗？', {
                btn: ['YES','NO'] //按钮
            }, function(){
                //layer.msg('的确很重要', {icon: 1});
                $.post('{{url('admin/config/')}}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'}, function (data) {
                    if(data.status==0){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function () {
                            location.reload();
                        },500);
                    }else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            }, function(){
//                layer.msg('也可以这样', {
//                    time: 20000, //20s后自动关闭
//                    btn: ['明白了', '知道了']
//                });
            });
        }
    </script>
@endsection