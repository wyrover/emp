<div class="row" id="form">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-check-square-o"></i> 人员基本信息</div>
            <div class="panel-body form-horizontal" style="min-height: 380px;">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">人员姓名</label>

                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" v-on="keyup:genPinyin" value="@{{ name }}"  class="form-control" placeholder="请填写姓名...">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">姓名简写</label>
                    <div class="col-sm-9">
                        <input type="text" name="pinyin" id="pinyin"  value="@{{ pinyin }}" v-model="pinyin" class="form-control" placeholder="通常这里会自动生成...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">所属公司</label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" id="company" v-model="selected_company" options="data.company" >
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">人员岗位</label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" id="position" v-model="selected_job" options="data.position">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">办公地点</label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" id="office" v-model="selected_office" options="data.office">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">赴哈时间</label>
                    <div class="col-sm-9">
                        <div class="input-group date datepicker" >
                            <input type='text' class="form-control" id="reached_at" value="@{{ reached_at }}" data-date-format="YYYY-MM-DD"/>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">备注说明</label>
                    <div class="col-sm-9">
                        <textarea name="memo" class="form-control" id="memo" rows="2">@{{ memo }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-check-square-o"></i> 护照签证信息</div>
            <div class="panel-body form-horizontal" style="min-height: 380px;">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">护照编号</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="passport" value="@{{ passport }}" placeholder="请填写护照号码...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">发照日期</label>
                    <div class="col-sm-9">
                        <div class="input-group date datepicker" >
                            <input type='text' class="form-control" id="passport_date" value="@{{ passport_date }}" data-date-format="YYYY-MM-DD" placeholder="请选择或填写发照日期"/>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">有效期限</label>
                    <div class="col-sm-9">
                        <div class="input-group date datepicker" >
                            <input type='text' class="form-control" id="passport_deadline" value="@{{ passport_deadline }}" data-date-format="YYYY-MM-DD" placeholder="请选择或填写截止日期"/>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">签证类型</label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" id="visa_type_id" v-model="selected_visa" options="data.visatype">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">签证期限</label>
                    <div class="col-sm-9">
                        <div class="input-group date datepicker" >
                            <input type='text' class="form-control" id="visa_deadline" value="@{{ visa_deadline }}" data-date-format="YYYY-MM-DD" placeholder="请选择或填写签证日期"/>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">落地期限</label>
                    <div class="col-sm-9">
                        <div class="input-group date datepicker" >
                            <input type='text' class="form-control" id="land_deadline" value="@{{ land_deadline }}" data-date-format="YYYY-MM-DD" placeholder="请选择或填写落地签日期"/>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">签证预案</label>
                    <div class="col-sm-9">
                        <select class="form-control chosen-select" id="visa_handle_id" v-model="selected_handle" options="data.visahandle">
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-7 col-sm-offset-5">
        <button class="btn btn-primary btn-lg" v-on="click:submit"><span class="fa fa-check"></span> 确认无误，提交</button>
    </div>

</div>

