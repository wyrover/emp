@extends('master')

@section('content')
<div class="row" id="app">
  <div class="col-md-4 col-sm-6">
    <div class="panel panel-default clearfix dashboard-stats rounded">
      <ul class="backpage transit">
        <li>共有职工@{{employeeCount}}人</li>
        <li>共有@{{ companyCount }}家公司</li>
        <li> 共有办公地点@{{ officeCount }}个</li>
      </ul>
      <i class="fa fa-users bg-blue transit stats-icon"></i>
      <h3 class="transit">共有人员数量<small class="text-blue"> @{{employeeCount}}</small></h3>
      <p class="text-muted transit">自有职工@{{ourEmployees}}人 分包队伍@{{employeeCount-ourEmployees}}人</p>
    </div>
  </div>
  <div class="col-md-4 col-sm-6">
    <div class="panel panel-default clearfix dashboard-stats rounded">
      <ul class="backpage transit">
        <li v-repeat="item:latestPassport">@{{ item.name }} 至<small class="text-green">@{{item.passport_deadline }}</small></li>
      </ul>
      <i class="fa fa-newspaper-o bg-success transit stats-icon"></i>
      <h3 class="transit">护照最近期限</h3>
      <p class="text-muted transit">@{{latestPassport[0]['passport_deadline']}}</p>
    </div>
  </div>
  <div class="col-md-4 col-sm-6">
    <div class="panel panel-default clearfix dashboard-stats rounded">
      <ul class="backpage transit">
        <li v-repeat="item:latestVisa">@{{ item.name }} 至<small class="text-orange">@{{item.visa_deadline }}</small></li>
      </ul>
      <i class="fa  fa-edit bg-danger transit stats-icon"></i>
      <h3 class="transit">签证最近期限</h3>
      <p class="text-muted transit">@{{latestVisa[0]['visa_deadline']}}</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading clean">
        人员分布概况  <a class="badge bg-blue" href="{{url('spread')}}" style="margin-left: 2em">查看详情</a>
          <div class="btn-group pull-right">
          <select class="form-control" v-model="currentChart" v-on="change:changeChart(currentChart)">
              <option value="position">按岗位</option>
              <option value="office">按现场</option>
              <option value="company">按公司</option>
            </select>
          </div>
      </div>
      <div class="panel-body" id="chartBox">
        <canvas id="myChart"></canvas>
      </div>
    </div>

  </div>

</div>

@section('scripts')
@parent
<script src="/js/chart.js"></script>
<script src="/js/home.js"></script>
@stop
@stop
