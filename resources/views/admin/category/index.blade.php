@extends('layout/admin')
@section('content')
    <body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 全部列表
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

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#" onclick="location.reload();"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox" name=""></th>
                        <th class="tc">排序</th>
                        <th>分类</th>
                        <th>标题</th>
                        <th>关键字</th>
                        <th>描述</th>
                        <th>查看次数</th>
                        <th>操作</th>
                    </tr>
                    @foreach($cate as $v)
                    <tr>
                        <td class="tc"><input type="checkbox" name="id[]" value="59"></td>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v['cate_id']}})" value="{{$v['cate_order']}}">
                        </td>
                        <td>{{$v['_cate_name']}}</td>
                        <td>{{$v['cate_title']}}</td>
                        <td>{{$v['cate_keywords']}}</td>
                        <td>{{$v['cate_description']}}</td>
                        <td>{{$v['cate_view']}}</td>
                        <td>
                            <a href="{{url('admin/category/'.$v['cate_id'].'/edit')}}">修改</a>
                            <a onclick="delCate({{$v->cate_id}})" href="javascript:;">删除</a>
                        </td>
                    </tr>

                    @endforeach
                </table>


                <div class="page_nav">
                    {{--<div>--}}
                        {{--<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a>--}}
                        {{--<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>--}}
                        {{--<span class="current">8</span>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>--}}
                        {{--<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a>--}}
                        {{--<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a>--}}
                        {{--<span class="rows">11 条记录</span>--}}
                    {{--</div>--}}
                </div>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
<!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj,cate_id){
            $.post('{{url('admin/cate/change_order')}}',{'_token':'{{csrf_token()}}','cate_order': obj.value,'cate_id':cate_id}, function (data) {
                if(data.status==0){
                    layer.msg(data.mas, {icon: 6});
                }else {
                    layer.msg(data.mas, {icon: 5});
                }

            })
        }
        function delCate(id){
            layer.confirm('你确定要删除这个分类吗？', {
                btn: ['YES','NO'] //按钮
            }, function(){
                //layer.msg('的确很重要', {icon: 1});
                $.post('{{url('admin/category/')}}/'+id,{'_method':'delete','_token':'{{csrf_token()}}'}, function (data) {
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