@inject('btn','App\Estar\Composers\Estar')
<div class="row"  id="employee">
   <div class="col-lg-9">
      <div class="panel panel-primary">
         <div class="panel-heading">
            <h4><i class="fa fa-user"></i> 人员信息卡片</h4>
         </div>
         <div class=" panel-body">
            <div class="row">
               <div class="col-lg-1 visible-lg hidden-print">
                  <i class="fa fa-user fa-4x alpha3"></i>
               </div>
               <div class="col-lg-11 col-lg-push-1">
                     <h3>@{{name}} (@{{ pinyin }})</h3>
               </div>
            </div>
            <div class="row" style="padding-top: 15px">
               <div class="col-lg-5">
                  <dl class="dl-horizontal">
                     <dt>工作岗位:</dt> <dd>  @{{position.name}}</dd>
                     <dt>所属公司:</dt> <dd>  @{{ company.name }}</dd>
                     <dt>办公地点:</dt> <dd>  @{{ office.name }}</dd>
                     <dt>赴哈时间:</dt> <dd>  @{{ reached_at }}</dd>
                     <dt>签证类型:</dt> <dd>  @{{ visa_type.type }}</dd>
                  </dl>
               </div>
               <div class="col-lg-7" id="cluster_info">
                  <dl class="dl-horizontal">
                      <dt>签证预案:</dt> <dd>  @{{ visa_handle.method }}</dd>
                     <dt>护照号码:</dt> <dd><mark>@{{ passport }}</mark></dd>
                     <dt>发照日期:</dt> <dd>@{{ passport_date }}</dd>
                     <dt>护照截止:</dt> <dd>@{{ passport_deadline }} <span class="badge bg-success">剩@{{ passport_deadline_diff }}天</span></dd>
                     <dt>签证截止:</dt> <dd>@{{ visa_deadline }} <span class="badge bg-success">剩@{{ visa_deadline_diff }}天</span></dd>
                     <dt>落地截止:</dt> <dd>@{{ land_deadline }} <span class="badge bg-success">剩@{{ land_deadline_diff }}天</span></dd>
                  </dl>
               </div>
               <div class="col-md-2 pull-right {{$btn->showAtLeastEditor()}}"><a href="@{{ edit_url }}" class="btn btn-lg btn-success">修改</a></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3">
     <div class="panel panel-info"  v-if="memo">
        <div class="panel-heading"><i class="fa fa-plus-circle"></i> 备注说明</div>
       <div class="panel-body">
          @{{ memo }}
       </div>
     </div>
      <h5 class=" text-primary"><i class="fa fa-plus-circle"></i> 相关信息</h5>
      <ul class="tag-list" style="padding: 0">
         <li><a href="@{{ company_url }}"><i class="fa fa-tag"></i>@{{ company.name }} </a></li>
         <li><a href=""><i class="fa fa-tag"></i> @{{ position.name }}</a></li>
         <li><a href=""><i class="fa fa-tag"></i> @{{ office.name }}</a></li>
         <li><a href=""><i class="fa fa-tag"></i> @{{ visa_type.type }}</a></li>
         <li><a href=""><i class="fa fa-tag"></i> @{{ visa_handle.method }}</a></li>
      </ul>
   </div>
</div>