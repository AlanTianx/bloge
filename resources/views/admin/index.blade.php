@extends('layout.admin')
@section('content')
			<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">后台管理模板</div>
			<ul>
				<li><a href="#" class="active">首页</a></li>
				<li><a href="#">管理页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：{{session('user.user_name')}}</li>
				<li><a href="{{url('admin/upd_pass')}}" target="main">修改密码</a></li>
				<li><a href="{{route('A_logout')}}">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>常用管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/navs/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加导航</a></li>
					<li><a href="{{url('admin/navs')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>导航列表</a></li>
					<li><a href="{{url('admin/links/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>链接添加</a></li>
					<li><a href="{{url('admin/links')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>链接列表</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>分类管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/category/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>分类添加</a></li>
					<li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>分类列表</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>文章管理</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/article/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加文章</a></li>
					<li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>文章列表</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-clipboard"></i>网站配置</h3>
				<ul class="sub_menu">
					<li><a href="{{url('admin/config/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加配置</a></li>
					<li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>配置列表</a></li>
				</ul>
			</li>
			<li>
				<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
				<ul class="sub_menu">
					<li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
					<li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
					<li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
					<li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
	</div>
	<!--底部 结束-->
@endsection

