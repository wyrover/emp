"use strict";
Vue.http.headers.common["X-CSRF-TOKEN"] = document.querySelector("#token").getAttribute("value");
var baseURL =  'http://'+window.location.host ;
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
        current_office:'1',
        currentChart:'positions',
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
                    color: randomColor({hue:'random',luminosity: 'dark'}),
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
           var chart = new Chart(ctx).Doughnut(this.chartData);
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

//# sourceMappingURL=locale.public.js.map
//# sourceMappingURL=locale.public.js.map