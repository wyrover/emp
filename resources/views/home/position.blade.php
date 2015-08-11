@extends('master')
@section('content')
    @inject('btn','App\Estar\Composers\Estar')
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading clean">现场列表
                <span class="pull-right"><button type="button" class="btn btn-danger btn-xs" v-on="click:addNew"><i class="fa fa-plus"></i> 添加数据</button></span>
            </div>
            <div class="panel-body nopadd">
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <div class="input-group" style="display: none" id="addNewEle">
                                    <input type="text" class="form-control" id="addNew" placeholder="请输入内容">
                                          <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" v-on="click:saveNew()">保存</button>
                                          </span>
                                </div>
                                <div class="input-group" style="display: none" id="updateEle">
                                    <input type="text" class="form-control" id="updateInput" placeholder="请输入内容">
                                          <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" v-on="click:updateLocale()">更新</button>
                                          </span>
                                </div>
                            <tr v-repeat="office:offices" >
                                <td><a id="@{{ office.id }}"  v-class="on:id==current_office" class="label label-success" v-on="click:changeLocale"  href="javascript:void (0)">@{{ office.name }}</a>
                                </td>
                                <td><span class="badge bg-gray text-white">@{{ office.employee_counts }}人</span></td>
                                <td  class="{{$btn->showAtLeastEditor()}}">
                                    <div class="btn-group btn-group-xs pull-right">
                                        <a data-id ="@{{ office.id }}" class="btn btn-default" v-class="disabled:editable==false" v-on="click:editLocale(office)"><i class="fa fa-edit"></i></a>
                                        <a  data-id ="@{{ office.id }}"  class="btn btn-default" data-toggle="modal" data-target="#modal" v-on="click:setRemoveId"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading clean">
                统计数据： @{{ offices[parseInt(this.current_office)-1].name }}
                <div class="btn-group pull-right">
                    <select class="form-control" v-model="currentChart" v-on="change:changeChart(currentChart)">
                        <option value="positions">按岗位</option>
                        <option value="companies">按公司</option>
                    </select>
                </div>
            </div>

            <div class="panel-body" id="chartBox" >
                <canvas id="myChart"></canvas>
            </div>
            <ul class="list-unstyled"  id="legend"></ul>

        </div>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="">每页显示</label>
                        <select class="form-control" v-model="perpage" v-on="change:changePerPage(perpage)">
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="100">100</option>
                            <option value="all">全部</option>dd
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="form-inline pull-right">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control"  v-model="keyword"  placeholder="输入关键字">
                          <span class="input-group-btn">
                            <button v-on="click:goSearch" class="btn btn-purple" type="button"><i class="fa fa-search"></i></button>
                          </span>
                        </div>
                    </div>
                </div>
                <div class="btn-group pull-right">
                </div>
            </div>
        </div>
        <hr class="clean">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table table-striped table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th v-repeat="column:columns" id="@{{ ids[$index] }}" class="@{{ column.class }}"><a href="javascript:void(0)" v-on="click:sortBy">@{{column.header}}</a></th>
                        <th class="{{$btn->showAtLeastEditor()}}">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-repeat="data | filterBy keyword | orderBy sortKey reverse">
                        <td><a class="label label-primary" href="{{url('employee/show')}}/@{{ id }}">@{{ name }}</a></td>
                        <td><a class="label label-warning" href="{{url('job/show')}}/@{{ position.id }}">@{{ position.name }}</a></td>
                        <td><a class="label label-success" href="{{url('company/show')}}/@{{ company.id }}">@{{ company.name }}</a></td>
                        <td><a href="{{url('admin/employee')}}/@{{ id }}/edit" class="btn btn-purple {{$btn->showAtLeastEditor()}}">修改</a></td>
                        <td style="display: none">@{{pinyin}}</td>
                    </tr>
                    </tbody>
                </table>

                <div id="show-error" class="alert alert-danger alert-dismissible fade in" style="display: none" role="alert">
                    <h4>数据通讯异常！</h4>
                    <p>请检查您的网络，或与管理员联系。</p>
                </div>
                <hr>
                <div class="row" style="margin-bottom: 2em">
                    <div class="col-md-12" v-class="hidden:perpage=='all'">
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

            </div>

        </div>
    </div>
</div>
@include('partials._modal_delete')
@section('scripts')
    @parent
    <script src="/js/chart.js"></script>
    <script src="/js/locale.public.js"></script>
@stop
@stop