"use strict";
Vue.http.headers.common["X-CSRF-TOKEN"] = document.querySelector("#token").getAttribute("value");
var baseURL =  'http://'+window.location.host ;
var id = window.location.href.split('#')[1];
if( typeof id === 'undefined'){
    id = 1;
}
var api = 'http://'+window.location.host + '/api/v1/locale/';
var vm = new Vue({
    el: "#app",
    data: {
        keyword: "",
        sortKey:"",
        reverse:false,
        records_show:10,
        pagersCount:5,//显示的pager数量
        perpage:15,
        disabled:true,
        current_office:id,
        currentChart:'positions',
        newLocale:'',
        offices:[],
        editable:true,
        remove_id:'',
        edit_id:'',
        current_employee:1,
        columns:[
            {
                'header':'姓名',
                'class':''
            },
            {
                'header':'岗位',
                'class':''
            },
            {
                'header':'单位',
                'class':''
            }

        ],
        ids:[
            "pinyin","position_id","company_id"
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
            addLoading();
            this.$http.get(baseURL+"/api/v1/locale?locale=" + this.current_office + "&page=" + page +"&perpage="+this.perpage,function(data){
                this.$set("user_level",data["user_level"]);
                this.$set("offices",data["offices"]);
                this.$set("positions",data["positions"]);
                this.$set("companies",data["companies"]);
                this.$set("data",data["data"]);
                this.$set("total",data["total"]);
                this.$set("from",data["from"]);
                this.$set("to",data["to"]);
                this.$set("perPage",data["per_page"]);
                this.$set("currentPage",data["current_page"]);
                this.$set("lastPage",data["last_page"]);
            }).success(function(data){
                removeLoading();
                this.setChartData(data[this.currentChart]);
            }).error(function (status) {
                $("#show-error").show();
            });
        },

        changeChart:function(str){
            var prop = str;
            this.setChartData(this[prop]);
        },

        setChartData:function(items){
            var data = [];
            for (var k in items) {
                //results[name] = items[k];
                data.push({
                    value : items[k],
                    label : k,
                    color: randomColor({hue:'green',luminosity: 'dark'}),
                    highlight: "#5AD3D1",
                })
            }
            this.chartData = data;
            this.drawChart();
        },

        resetCanvas:function(){
            $('#myChart').remove(); // this is my <canvas> element
            $('#chartBox').append('<canvas id="myChart"><canvas>');
        },


        drawChart:function(){
            this.resetCanvas();
            var ctx = $("#myChart").get(0).getContext("2d");
            var options = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke : true,

                //String - The colour of each segment stroke
                segmentStrokeColor : "#fff",

                //Number - The width of each segment stroke
                segmentStrokeWidth : 2,

                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout : 50, // This is 0 for Pie charts

                //Number - Amount of animation steps
                responsive: true,
                //String - Animation easing effect
                animationEasing : "easeOutElastic",

                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate : true,

                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale : false,

                //String - A legend template
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

            }
           var chart = new Chart(ctx).Doughnut(this.chartData,options);
            var data = this.chartData;
            legend(document.getElementById('legend'),data,chart, "<%=label%>: <%=value%>人");

        },

        changeLocale:function(e){
            this.current_office = e.target.id;
            this.getData();
        },

        changePerPage:function(param){
            this.perpage =  param;
            this.getData();
        },

        sortBy:function(e){
            var onKey = $(e.target).closest("th").attr('id');
            this.sortKey = onKey;
            this.reverse = (this.sortKey==onKey) ? !this.reverse : false; //如果初始的sortKey==onKey,反转,否则返回false不响应
        },

        goSearch:function(){
            this.perpage = 'all';
            this.getData('all');
        },
        clearInput:function(){
            this.$$.input.value = '';
        },
        editLocale:function(locale){
           this.removeLocale(locale);
            this.editable = false;
            $('#updateEle').fadeIn();
            $('#updateInput').val(locale.name);
            this.edit_id = locale.id;
        },
        updateLocale:function(){
            var input = $('#updateInput').val();
            var data = {
                name: input
            };

            if (input !==''){
                this.$http.put(api+this.edit_id,data,function(){
                    $('#updateEle').fadeOut();
                    this.getData();
                }).error(function(){
                    StarPop.show('操作不成功！请检查网络连接，或重新登录')
                });
            };
            this.editable = true;
        },
        addNew:function(){
            $('#addNewEle').fadeIn();
        },
        removeLocale:function(office){
            this.offices.$remove(office);
        },
        saveNew:function(){
            var input = {
                name:$('#addNew').val()
            };

            if (! this.validate()){
                this.$http.post(api,input,function(){
                    $('#addNewEle').fadeOut();
                    $('#addNew').val('');
                    this.getData();
                }).error(function(){
                    StarPop.show('操作不成功！请检查网络连接，或重新登录')
                });
            }
        },
       showCard:function(item,e){
            var popover = $(e.target);
           popover.attr("data-content",
               '<div class="list-unstyled">' +
               '<p>赴哈时间:'+item.reached_at+'</p>' +
               '<p>护照号码:'+item.passport+'</p>' +
               '<p>护照期限:'+item.passport_deadline+'</p>' +
               '<p>签证期限:'+item.visa_deadline+'</p>' +
               '</div>');
            popover.popover('show');
            popover.bind({
                mouseout:function(){
                    popover.popover('hide');
                }
            });
        },
        setRemoveId:function(e){
            var remove_id = $(e.target).closest("a").attr('data-id');
            $('#btn_delete').attr('data-id',remove_id); //把modal中的删除按钮赋值
        },
        removeData:function(e){
            addLoading();
            var remove_id = $(e.target).closest("a").attr('data-id');
            this.$http.delete(api+remove_id )
                .success(function(){
                    this.getData();
                    console.log(this.remove_id);
                    $("#modal").modal("hide");
                });
        },
        validate:function(){
            var has_err = false;
                if($('#addNew').val() == ''){
                    has_err = true;
                }
            return has_err;
        },

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

//# sourceMappingURL=locale.public.js.map
//# sourceMappingURL=locale.public.js.map