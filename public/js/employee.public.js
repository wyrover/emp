"use strict";Vue.http.headers.common["X-CSRF-TOKEN"]=document.querySelector("#token").getAttribute("value");var baseURL="http://"+window.location.host,vm=new Vue({el:"#employee",data:{keyword:"",sortKey:"",reverse:!1,records_show:10,pagersCount:5,perpage:15,disabled:!0,columns:[{header:"姓名","class":""},{header:"岗位","class":""},{header:"单位","class":""},{header:"现场","class":""},{header:"护照号码","class":""},{header:"护照期限","class":"visible-lg"},{header:"签证期限","class":"visible-lg"},{header:"赴哈时间","class":"visible-lg"}],ids:["pinyin","position_id","company_id","office_id","passport","passport_deadline","visa_deadline","reached_at"]},ready:function(){this.getData()},methods:{buttonState:function(){this.disabled=$("#datatable>tbody input:checkbox:checked").length>0?!1:!0},getData:function(e){addLoading(),this.$http.get(baseURL+"/api/v1/employee?page="+e+"&perpage="+this.perpage,function(e){this.$set("user_level",e.user_level),this.$set("data",e.data),this.$set("total",e.total),this.$set("from",e.from),this.$set("to",e.to),this.$set("perPage",e.per_page),this.$set("currentPage",e.current_page),this.$set("lastPage",e.last_page)}).success(function(){$("#checkAll").prop("checked",!1),removeLoading()}).error(function(e){$("#show-error").show()})},changePerPage:function(e){this.perpage=e,addLoading(),this.getData()},getOption:function(e){var t=$("#datatable>tbody input:checkbox:checked"),a=[];t.each(function(){a.push($(this).val())}),"delete"==e.target.id?this.doDelete(a):"show"==e.target.id?window.location.href=baseURL+"/admin/employee/"+a+"/show/":"edit"==e.target.id?window.location.href=baseURL+"/admin/employee/"+a+"/edit/":"create"==e.target.id&&(window.location.href=baseURL+"/admin/employee/create/")},doDelete:function(e){addLoading(),this.$http["delete"](baseURL+"/api/v1/employee/"+e,function(){}).success(function(){this.getData(),this.disabled=!0,$("#modal").modal("hide")})},checkAll:function(e){$("input:checkbox").prop("checked",e.target.checked),this.buttonState()},sortBy:function(e){var t=$(e.target).closest("th").attr("id");this.sortKey=t,this.reverse=this.sortKey==t?!this.reverse:!1},goSearch:function(){this.perpage="all",addLoading(),this.getData("all")},clearInput:function(){this.$$.input.value=""}},computed:{pagers:{get:function(){var e=[],t=this.$data.currentPage,a=this.$data.lastPage,s=t+this.pagersCount,i=Math.round((parseInt(this.pagersCount)-1)/2);if(1>t-i)if(t+i>=a)for(var o=1;a>=o;o++)e.push(o);else for(var o=1;s>o;o++)e.push(o);else if(t+i>a)if(a-this.pagersCount>0)for(var o=a-this.pagersCount;a+1>o;o++)e.push(o);else for(var o=1;t>=o;o++)e.push(o);else for(var o=t;s>o;o++){var r=o-i;e.push(r),r++}return e}}}});