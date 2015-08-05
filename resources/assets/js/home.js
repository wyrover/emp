'use strict';

Vue.http.headers.common["X-CSRF-TOKEN"] = document.querySelector("#token").getAttribute("value");
var chart ;



var api = 'http://'+window.location.host + '/api/v1/home';

var vm = new Vue({

    el:"#app",

    data:function(){
        return {
            chartData:{},
            employeeCount:'',
            ourEmployees:'',
            officeCount:'',
            companyCount:'',
            latestPassport:[],
            latestVisa:[],
            currentChart:'position',
            positionData:[],
            companyData:[],
            officeData:[]

        }
    },

    ready:function(){
        this.getData();
    },

    methods:{

        getData:function(){
            this.$http.get(api)
            .success(function(data){
                    removeLoading();
                this.employeeCount = data["employeeCount"],
                this.ourEmployees = data["ourEmployees"],
                this.officeCount = data["officeCount"],
                this.companyCount = data["companyCount"],
                this.latestPassport = data["latestPassport"],
                this.latestVisa = data["latestVisa"],
                this.positionData = data["position"],
                this.companyData = data["company"],
                this.officeData = data["office"]
                // this.getItems(this.position,"name")
                this.setChartData(data[this.currentChart])
            })
        },

        changeChart:function(str){
            var prop = str+"Data";
            this.setChartData(this[prop]);
        },


        setChartData:function(items){

            var labels = this.getItems(items,"name");
            var counts = this.getItems(items,"counts");

            this.chartData = {
                labels: labels,
                series: counts
            };

            this.drawChart();
        },

        resetCanvas:function(){
            $('#myChart').remove(); // this is my <canvas> element
            $('#chartBox').append('<canvas id="myChart"><canvas>');
        },

        drawChart:function(){

            this.resetCanvas();
            var ctx = $("#myChart").get(0).getContext("2d");

            var data = {
                labels: this.chartData.labels,
                datasets: [
                    {
                        fillColor: "rgba(151,187,205,0.5)",
                        strokeColor: "rgba(151,187,205,0.8)",
                        highlightFill: "rgba(151,187,205,0.75)",
                        highlightStroke: "rgba(151,187,205,1)",
                        data: this.chartData.series
                    }
                ]
            };
            var myBarChart = new Chart(ctx).Bar(data);

        },

        //该方法遍历给定对象，生成指定键名的所有记录
        getItems:function(items,field){
            var collection = items;
            var labelArr = [];

            for (var i = 0; i < collection.length; i++) {
                labelArr.push(collection[i][field]); 
            };       

            return labelArr;        

        }

    }

});



//# sourceMappingURL=home.js.map