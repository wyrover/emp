var baseURL = "http://employee.dev/api/v1/employee";
module.exports = {
	template:  require('./employee.template.html'),
	data:function() {
		return {
			keyword: "",
			sortKey:"",
			reverse:false,
			records_show:10,
			pagersCount:5,//显示的pager数量
			perpage:15,
			disabled:true,
			data:{},
			total:'',
			from:'',
			to:'',
			perPage:'',
			currentPage:'',
			lastPage:'',
			pinyin:'',
			columns:[
			"姓名","岗位","单位","所在地","护照号","发照日期","护照有效期","签证类型","签证期限","落地签期限","办理预案","赴哈时间"
			]
		}
	},

	ready:function(){
		this.getData();
	},

	methods:{

		getData:function(page){
			this.$http.get(baseURL+"?page="+page+"&perpage="+this.perpage)
				.success(function(data){
					this.data = data["data"];
					this.total = data["total"];
					this.from = data["from"];
					this.to = data["to"];
					this.perPage = data["per_page"];
					this.currentPage = data["current_page"];
					this.lastPage = data["last_page"];
					this.pinyin = data["pinyin"];
				});
		},

		changePerPage:function(param){
			this.perpage = param;
			this.getData();
		},

		sortBy:function(index){
			var items = Object.keys(this.data[0]);//获取json对象各个节点(id,name,job...)
			var onKey = Object.keys(items)[index]; //获取到当前点击的表头名的索引值
			if (items[index] == 'name') {
				this.sortKey = 'pinyin';
			} else{
				this.sortKey = items[onKey];
			}

			this.reverse = (index == onKey) ? !this.reverse : false; //如果初始的sortKey==onKey,反转,否则返回false不响应

		}
	},

	computed:{
		pagers:{
			get:function(){
				var pagers = [];
				var current = this.$data['currentPage'];
				var max = this.$data['lastPage'];
				var limited = current + this.pagersCount;
				var sidebar = Math.round((parseInt(this.pagersCount) -1) /2);  //为把当前页面放到页码指示器的中间，获取两侧数量

				if (current - sidebar < 1)
				 {
					if (current + sidebar >= max)
					 {
						for(var i =1; i<=max; i++)
						{
							pagers.push(i);
						};
					} else{
						for(var i = 1; i<limited;i++)
						{
							pagers.push(i);
						}
					}
				}
				else if (current + sidebar > max)
				{
					if (max - this.pagersCount > 0) 
					{
						for(var i = max - this.pagersCount; i < max+1; i++)
						{
							pagers.push(i);
						}
					}else{
						for(var i = 1; i <= current; i++)
						{
							pagers.push(i);
						}
					}
				}

				else
				{
					for(var i = current; i < limited; i++)
					{
						var j = i - sidebar;
						pagers.push(j);
						j++;
					}
				}

				return pagers;
				
			}
		}
	}
};