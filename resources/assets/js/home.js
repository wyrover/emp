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

        chageChart:function(str){
            var prop = str+"Data";
            this.setChartData(this[prop]);
        },


        setChartData:function(items){

            var labels = this.getItems(items,"name");
            var counts = this.getItems(items,"counts");

            this.chartData = {
                labels: labels,
                series: [             
                counts               
                ]
            };

            this.drawChart();
        },

        drawChart:function(){

            var chart = new Chartist.Bar('.ct-chart',this.chartData,{
                fullWidth:true,
                axisY: {
                    onlyInteger: true
                },
                axisX: {
                    showGrid: false
                },
                plugins:[
                Chartist.plugins.tooltip()
                ]
            });

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