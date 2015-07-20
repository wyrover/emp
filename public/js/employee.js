"use strict";
Vue.http.headers.common["X-CSRF-TOKEN"] = document.querySelector("#token").getAttribute("value");
var baseURL =  'http://'+window.location.host ;
var vm = new Vue({
  el: "#employee",
  data: {
    keyword: "",
    sortKey:"",
    reverse:false,
    records_show:10,
        pagersCount:5,//显示的pager数量
        perpage:15,
        disabled:true,
        columns:[
        "人员姓名","工作岗位","所属单位","所在现场","护照号码","护照期限","签证期限","赴哈时间","更多操作"
        ]
      },

      ready:function(){
       this.getData();
     //this.makePagers();
   },

   methods:{

    buttonState:function(){

      if($("#datatable>tbody input:checkbox:checked").length>0)
      {
       this.disabled = false;
     }else
     this.disabled = true;
   },
        //从API获取相应数据
        getData: function(page){
          this.$http.get(baseURL+"/api/v1/employee?page="+page+"&perpage="+this.perpage,function(data){
            this.$set("data",data["data"]);
            this.$set("total",data["total"]);
            this.$set("from",data["from"]);
            this.$set("to",data["to"]);
            this.$set("perPage",data["per_page"]);
            this.$set("currentPage",data["current_page"]);
            this.$set("lastPage",data["last_page"]);
          }).success(function(){
            $("#checkAll").prop("checked",false);
          }).error(function (status) {
            $("#show-error").show();
          });
        },

        changePerPage:function(param){
          this.perpage =  param;
          this.getData();
        },

        getOption:function(e){

          var checkboxes = $("#datatable>tbody input:checkbox:checked");
          var ids = [];
          checkboxes.each(function(){
            ids.push($(this).val());
          });

          if (e.target.id == "delete"){
            this.doDelete(ids);
          }

          else if (e.target.id == "edit"){
            window.location.href=baseURL+'/admin/employee/'+ids+'/edit/';
          }

          else if (e.target.id == "create"){
            window.location.href=baseURL+'/admin/employee/create/';
          }


        },

        doDelete:function(ids){
          this.$http.delete(baseURL+'/api/v1/employee/'+ids)
          .success(function(){
            this.getData();
            this.disabled = true;
            $("#modal").modal("hide");
          });
        },


        checkAll:function(e){
          $('input:checkbox').prop('checked', e.target.checked);
          this.buttonState();
        },

        //页面传递过来v-on索引值($index),然后进行判断
        sortBy:function(index){
            var items = Object.keys(this.data[0]);//获取json对象各个节点(id,name,job...)
            var onKey = Object.keys(items)[index]; //获取到当前点击的表头名的索引值
            if(items[index] == "name")
            {
              this.sortKey = "pinyin";
            }
            else{
                this.sortKey = items[onKey];//当前排序值等于表头点击的那个值
              }

            this.reverse = (index == onKey) ? !this.reverse : false; //如果初始的sortKey==onKey,反转,否则返回false不响应

          },

          goSearch:function(){
           this.perpage = 'all';
           this.getData('all');
         },
         clearInput:function(){
           this.$$.input.value = '';
         }
       },

       computed:{
        pagers:{
          get:function(){
            var pagers = [];
              var current = this.$data["currentPage"]; //从API中获取当前页码
              var max = this.$data["lastPage"];
              var limited = current + this.pagersCount;
              var sidebar = Math.round((parseInt(this.pagersCount) -1) /2);  //为把当前页面放到页码指示器的中间，获取两侧数量
              if(current - sidebar <1){
                if( current + sidebar >= max){
                  for(var i = 1; i <= max ; i++){
                    pagers.push(i);
                  };
                }
                else{
                  for(var i = 1; i < limited ; i++){
                    pagers.push(i);
                  };
                }
              }


              else if ( current + sidebar > max ){
               if(max - this.pagersCount > 0){
                 for(var i = max - this.pagersCount; i < max+1; i++){
                   pagers.push(i);
                 }
               }
               else{
                 for(var i = 1; i <= current; i++){
                   pagers.push(i);
                 }
               }
             }

             else{
              for(var i = current; i < limited ; i++){
                var j = i- sidebar;
                pagers.push(j);
                j++;
              };
            }


            return pagers;
          }
        }
      }


    });

//# sourceMappingURL=employee.js.map