"use strict";
Vue.http.headers.common["X-CSRF-TOKEN"] = document.querySelector("#token").getAttribute("value");
var baseURL =  'http://'+window.location.host;
var url = window.location.href;
var id = url.substring(url.lastIndexOf('/') + 1);
var vm = new Vue({
  el: "#employee",
      ready:function(){
       this.getData();
     //this.makePagers();
   },

   methods:{

        //从API获取相应数据
        getData: function(page){
          this.$http.get(baseURL+"/api/v1/employee/"+id,function(data){
              this.$set("name",data["name"]);
              this.$set("id",data["id"]);
              this.$set("pinyin",data["pinyin"]);
              this.$set("company",data["company"]);
              this.$set("position",data["position"]);
              this.$set("office",data["office"]);
              this.$set("reached_at",data["reached_at"]);
              this.$set("passport",data["passport"]);
              this.$set("passport_date",data["passport_date"]);
              this.$set("passport_deadline",data["passport_deadline"]);
              this.$set("passport_deadline_diff",data["passport_deadline_diff"]);
              this.$set("visa_type",data["visa_type"]);
              this.$set("visa_deadline",data["visa_deadline"]);
              this.$set("visa_deadline_diff",data["visa_deadline_diff"]);
              this.$set("land_deadline",data["land_deadline"]);
              this.$set("land_deadline_diff",data["land_deadline_diff"]);
              this.$set("visa_handle",data["visa_handle"]);
              this.$set("memo",data["memo"]);
          }).success(function(){
              removeLoading();
            $("#checkAll").prop("checked",false);
          }).error(function (status) {
            $("#show-error").show();
          });
        }
       },
        computed: {
            edit_url: function () {
                return window.location.origin+'/admin/employee/'+this.id+'/edit';
            }
        }

    });

//# sourceMappingURL=employee.show.js.map