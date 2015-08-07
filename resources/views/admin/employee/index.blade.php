@extends('master')
@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading"><i class="fa fa-lightbulb-o"></i> 您可以输入姓名首字母/各类关键词检索，也可以点击表头进行排序</div>
		<div class="panel-body" id="employee">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-inline">
						<div class="form-group">
							<label for="">每页显示记录</label>
							<select class="form-control" v-model="perpage" v-on="change:changePerPage(perpage)">
								<option value="15">15</option>
								<option value="30">30</option>
								<option value="100">100</option>
								<option value="all">全部</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-inline pull-right">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-search"></i>
								</div>
								<input type="text" class="form-control"  v-model="keyword" v-on="focus:goSearch" placeholder="可输入各类关键字">
							</div>
						</div>
					</div>
					<div class="btn-group pull-right" style="margin-right: 2em">
						<button type="button" class="btn btn-default">导出表格 <i class="fa fa-file-excel-o"></i></button>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				@if(Auth::user()->level > 1)
					<div class="col-md-12 col-sm-12 col-lg-12">
						<button type="button"  class="btn btn-danger" data-toggle="modal" v-attr="disabled:disabled" data-target="#modal"><i class="fa fa-trash"></i> 删除</button>
						<a id="create" class="btn btn-success" v-on="click:getOption"><i class="fa fa-plus"></i> 新增</a>
					</div>
				@endif
				<div class="col-md-12 table-responsive">
					<table class="table table-striped table-hover" id="datatable">
						<thead>
						<tr>
							<th><label class="cr-styled" ><input type="checkbox" v-on = "click:checkAll" id="checkAll"> <i class="fa"></i></label></th>
							<th v-repeat="column:columns" id="@{{ ids[$index] }}" class="@{{ column.class }}"><a href="javascript:void(0)" v-on="click:sortBy">@{{column.header}}</a></th>
						</tr>
						</thead>
						<tbody>
						<tr v-repeat="data | filterBy keyword | orderBy sortKey reverse">
							<td><label class="cr-styled"><input name="ids[]" type="checkbox" v-on="click:buttonState()" value=@{{id}}> <i class="fa"></i></label></td>
							<td><a class="label label-primary" href="{{url('employee/show')}}/@{{ id }}">@{{ name }}</a></td>
							<td><a class="label label-warning" href="{{url('job/show')}}/@{{ position.id }}">@{{ position.name }}</a></td>
							<td><a class="label label-success" href="{{url('company/show')}}/@{{ company.id }}">@{{ company.name }}</a></td>
							<td><a class="label label-info" href="{{url('office/show')}}/@{{ office.id }}">@{{ office.name }}</a></td>
							<td>@{{passport}}</td>
							<td class="visible-lg">@{{passport_deadline}}</td>
							<td class="visible-lg">@{{visa_deadline}}</td>
							<td class="visible-lg">@{{reached_at}}</td>
							<td><a href="{{url('admin/employee')}}/@{{ id }}/edit" class="btn btn-purple">修改</a></td>
							<td style="display: none">@{{pinyin}}</td>
						</tr>
						</tbody>
					</table>
					<div id="show-error" class="alert alert-danger alert-dismissible fade in" style="display: none" role="alert">
						<h4>数据通讯异常！</h4>
						<p>请检查您的网络，或与管理员联系。</p>
					</div>
					<div class="col-md-12 col-sm-12 col-lg-12" style="margin-bottom: 20px">
						<a class="btn btn-danger" data-toggle="modal" v-attr="disabled:disabled" data-target="#modal"><i class="fa fa-trash"></i> 删除</a>
						<a id="create"  class="btn btn-success" v-on="click:getOption"><i class="fa fa-plus"></i> 新增</a>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="dataTables_info">共@{{total}}条记录，当前为@{{ from }}到@{{ to }}条</p>
				</div>
				<div class="col-md-6" v-class="hidden:perpage=='all'">
					<div class="dataTables_paginate paging_simple_numbers">
						<ul class="pagination no-margin pull-right">
							<li class="paginate_button" v-class="hidden:currentPage==1"><a href="javascript:void(0)" v-on = "click:getData(1)">首页</a></li>
							<li class="paginate_button " v-class="hidden:currentPage<=1"><a href="javascript:void(0)" v-on = "click:getData(currentPage - 1)">上页</a></li>
							<li class="paginate_button" v-class="active:currentPage == pager " v-repeat="pager:pagers"><a href="javascript:void(0)" v-on = "click:getData(pager)">@{{pager}}</a></li>
							<li class="paginate_button" v-class="hidden:currentPage>=lastPage"><a href="javascript:void(0)" v-on = "click:getData(currentPage + 1)">下页</a></li>
							<li class="paginate_button" v-class="hidden:currentPage==lastPage"><a href="javascript:void(0)" v-on = "click:getData(lastPage)">末页</a></li>
						</ul>
					</div>
				</div>
			</div>

			@include('partials/_modal')
		</div>
	</div>

@section('scripts')
	@parent
	<script src="/js/employee.public.js"></script>
@stop
@stop