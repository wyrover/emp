@extends('master')
@section('content')
    @inject('btn','App\Estar\Composers\Estar')

	<div class="panel panel-primary">
		<div class="panel-heading"><i class="fa fa-lightbulb-o"></i> 您可以输入姓名首字母/各类关键词检索，也可以点击表头进行排序</div>
		<div class="panel-body" id="employee">
			<div class="row">
		<div class="col-xs-6">
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
				<div class="col-xs-6">
					<div class="form-inline pull-right">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control"  v-model="keyword"  placeholder="输入关键字">
                          <span class="input-group-btn">
                            <button v-on="click:goSearch" class="btn btn-purple" type="button"><i class="fa fa-search"></i> 全局搜索</button>
                          </span>
							</div>
						</div>
					</div>
					<div class="btn-group pull-right" style="margin-right: 2em">
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12 table-responsive">
					<table class="table table-striped table-hover" id="datatable">
						<thead>
                        <div class="{{$btn->showAtLeastEditor()}}">
                            <a class="btn btn-danger" data-toggle="modal" v-attr="disabled:disabled" data-target="#modal"><i class="fa fa-trash"></i> 删除</a>
                            <a id="create"  class="btn btn-success" v-on="click:getOption"><i class="fa fa-plus"></i> 新增</a>
                        </div>
						<tr>
							<th class="{{$btn->showAtLeastEditor()}}"><label class="cr-styled" ><input type="checkbox" v-on = "click:checkAll" id="checkAll"> <i class="fa"></i></label></th>
							<th v-repeat="column:columns" id="@{{ ids[$index] }}" class="@{{ column.class }}"><a href="javascript:void(0)" v-on="click:sortBy">@{{column.header}}</a></th>
						    <th class="{{$btn->showAtLeastEditor()}}">操作</th>
                        </tr>
						</thead>
						<tbody>
						<tr v-repeat="data | filterBy keyword | orderBy sortKey reverse">
							<td class="{{$btn->showAtLeastEditor()}}"><label class="cr-styled"><input name="ids[]" type="checkbox" v-on="click:buttonState()" value=@{{id}}> <i class="fa"></i></label></td>
							<td><a class="label label-primary" href="{{url('employee/show')}}/@{{ id }}">@{{ name }}</a></td>
							<td><a class="label label-warning" href="{{url('job')}}#@{{ position.id }}">@{{ position.name }}</a></td>
							<td><a class="label label-success" href="{{url('company')}}#@{{ company.id }}">@{{ company.name }}</a></td>
							<td><a class="label label-info" href="{{url('locale')}}#@{{ office.id }}">@{{ office.name }}</a></td>
							<td>@{{passport}}</td>
							<td class="visible-lg">@{{passport_deadline}}</td>
							<td class="visible-lg">@{{visa_deadline}}</td>
							<td class="visible-lg">@{{reached_at}}</td>
							<td><a href="{{url('admin/employee')}}/@{{ id }}/edit" class="btn btn-purple {{$btn->showAtLeastEditor()}}">修改</a></td>
							<td style="display: none">@{{pinyin}}</td>
						</tr>
						</tbody>
					</table>
					<div id="show-error" class="alert alert-danger alert-dismissible fade in" style="display: none" role="alert">
						<h4>数据通讯异常！</h4>
						<p>请检查您的网络，或与管理员联系。</p>
					</div>

					<div class="col-md-12 col-sm-12 col-lg-12 {{$btn->showAtLeastEditor()}}" style="margin-bottom: 20px">
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