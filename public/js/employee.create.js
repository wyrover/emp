'use strict';

Vue.http.headers.common["X-CSRF-TOKEN"] = document.querySelector("#token").getAttribute("value");
var chart ;

var api = 'http://'+window.location.host + '/api/v1/employee';
var pinyin_api = 'http://'+window.location.host + '/api/v1/pinyin';


var vm = new Vue({

    el:"#app",

    data:{
        companyData:'',
        officeData:'',
        data:[],
        items:{},
        selected_company:1,
        selected_job:1,
        selected_office:1,
        selected_visa:1,
        selected_handle:1,
        pinyin:'',
        memo:''
    },

    ready:function(){
       this.fetchAPI();
   },

   methods:{
       fetchAPI: function(){
         this.$http.get(api+'/create',function(data){
           this.$set("data",data);
       }).success(function(){
             removeLoading();
         });
     },

       submit:function(){
           this.fetchForm();
           if (! this.validate()){
               this.$http.post(api,this.items).success(
                   function(data,status,request){
                       removeLoading();
                       window.location.href = window.location.origin+'/employee/show/'+request['response'];
                   }
               );;
           }

       },

       fetchForm:function(){
          var name = $('#name').val();
           var company_id = $( "#company option:selected" ).val();
           var position_id = $( "#position option:selected" ).val();
           var office_id = $( "#office option:selected" ).val();
           var reached_at = $("#reached_at").val();
           var passport = $("#passport").val();
           var passport_date = $("#passport_date").val();
           var passport_deadline = $("#passport_deadline").val();
           var visa_type_id = $("#visa_type_id").val();
           var visa_deadline = $("#visa_deadline").val();
           var land_deadline = $("#land_deadline").val();
           var visa_handle_id = $("#visa_handle_id").val();
           var pinyin =  $("#pinyin").val();
           var memo =  $("#memo").val();

           this.items = {
               name:name,
               company_id:company_id,
               position_id:position_id,
               office_id:office_id,
               reached_at:reached_at,
               passport:passport,
               passport_date:passport_date,
               passport_deadline:passport_deadline,
               visa_type_id:visa_type_id,
               visa_deadline:visa_deadline,
               land_deadline:land_deadline,
               visa_handle_id:visa_handle_id,
               pinyin:pinyin,
               memo:memo
           }
       },

       validate:function(){
                var has_err = false;
               $('#form input').each(function(){
               if($(this).val() == ''){
                   $(this).closest('.form-group').addClass('has-error');
                   has_err = true;
               }else{
                   $(this).closest('.form-group').removeClass('has-error');
               }
           });
           return has_err;
       },

       touchPinyin:function(){
           var pinyin = {
               name:$("#name").val()
           };
           if(pinyin==''){
               this.pinyin = '';
           }else {
               this.$http.post(pinyin_api, pinyin, function (data) {
                   this.$set('pinyin', data['pinyin']);
               });
           }
       },
       genPinyin:function(){
          this.touchPinyin();
       }



}

    //computed:{
    //    jobs:{
    //        get:function(){
    //            this.$http.get(api,function(data){
    //                 this.$set('jobs',data["position"]);
    //            });

                //var lists = [
                //    {"name":"sss","value":11},{"text":"vvvv","value":12}
                //];
                //return lists;
    //        }
    //    }
    //}

});




//# sourceMappingURL=employee.create.js.map