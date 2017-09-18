
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
import CommitChart from './components/CommitChart';

const app = new Vue({
    el: '#wrapper',
    data: {
      view_count : 0,
      clicked_count: 0,
      purchased_count: 0,
    	is_desktop : true,
    	is_mobile: false,
      orders:[],
      stats: [],
      analytics: !1,
      analytics_type: "views",
      analytics_group: "month",
      analyticsData: null,
    	setting:{
    		active: true,
    		active_desktop: true,
    		active_mobile: true,
    		loop: true,
    		random: false,
    		pause: false,
    		link: true,
    		close:true,
  			desktop_text_color: '#000000',
  			desktop_background_color: '#ffffff',
  			desktop_date_color: '#000000',
  			desktop_border_color: '#cccccc',
  			desktop_product_color: '#000000',
  			mobile_text_color: '#000000',
  			mobile_background_color: '#ffffff',
  			mobile_date_color: '#000000',
  			mobile_product_color: '#000000',
  			notifications_per_page: 20,
  			round_corners: 3,
  			border_width: 0,
  			desktop_space: 20,
  			desktop_style: '1',
  			desktop_animation: 'fade-slide-vertical',
  			desktop_font_family: '',
  			desktop_placement: 'bottom-left',
  			mobile_space: 0,
  			mobile_style: '1',
  			mobile_animation: 'fade',
  			mobile_font_family: '',
  			mobile_placement: 'bottom',
  			initial_delay: true,
  			initial_delay_val: 5,
  			interval: true,
  			interval_val: 4,
  			display_time: 4,
        distance:false,
  			message: '{ name } in { city }, { country } purchased { product }'
    	}
    },
    components: {
      CommitChart
    },
    created() {
        this.refreshAnalytics();
    	  Echo.channel('stats')
            .listen('statPosted', (e) => {
                if(window.ShopifyApp.shopOrigin.split('://')[1] == e.stat.shop){
                this.stats.push(e.stat);
                if(e.stat.action == 1){this.clicked_count =  this.clicked_count + 1;}
                else if(e.stat.action == 2){this.purchased_count = this.purchased_count + 1;}
                else{this.view_count = this.view_count + 1;}
              }
            });
        axios.get('/stats-count').then(response => {
            this.view_count = response.data.view_count;
            this.clicked_count = response.data.clicked_count;
            this.purchased_count = response.data.purchased_count;
        });    
        axios.get('/settings').then(response => {
        	var settings = $.parseJSON(response.data.setting.settings);
        	//console.log(response);
            this.setting = settings;

            axios.get('/orders').then(response => {
          
                this.orders = response.data;
                if(this.is_mobile){
                    var m = {
                            name: this.orders[0].customer_name ? this.orders[0].customer_name : "Someone",
                            city: this.orders[0].customer_city,
                            state: this.orders[0].customer_province,
                            short_state: this.orders[0].customer_province,
                            country: this.orders[0].customer_country,
                            product: '<span class="r-product-title" style="color:'+this.setting.mobile_product_color+'">' + this.orders[0].product_name + "</span>",
                            product_url: this.orders[0].url,
                            distance: '5 miles'
                        };
                        
                  }else{
                    var m = {
                            name: this.orders[0].customer_name ? this.orders[0].customer_name : "Someone",
                            city: this.orders[0].customer_city,
                            state: this.orders[0].customer_province,
                            short_state: this.orders[0].customer_province,
                            country: this.orders[0].customer_country,
                            product: '<span class="r-product-title" style="color:'+this.setting.desktop_product_color+'">' + this.orders[0].product_name + "</span>",
                            product_url: this.orders[0].url,
                            distance: '5 miles'
                        };
                  }
                  var d = this.template(this.setting.message, m);
                  document.getElementsByClassName("r-message")[0].innerHTML = d;
                  var time = moment.unix(this.orders[0].created).format('YYYYMMDDHHmmss');
                  //console.log(time);
                  document.getElementsByClassName("r-time")[0].innerHTML = moment(time,'YYYYMMDDHHmmss').fromNow();
            });
        });

        
    },
    watch: {
      
      setting:  {
        handler: function(newValue) {
               if(this.is_mobile){
                document.getElementsByClassName("r-product-title")[0].style.color = newValue.mobile_product_color
               }else{
                document.getElementsByClassName("r-product-title")[0].style.color = newValue.desktop_product_color
               }
                
            },
            deep: true
      }
    },
    computed: {
           desktop_classes () {
           	   var classes = '';
           	   if(this.setting.active){
           	   	  classes +='r-show ';
           	   }
           	   if(this.setting.active_desktop){
           	   	  classes +='r-desktop ';
           	   }

           	   classes += 'r-corners-' + this.setting.round_corners+' ';
           	   classes += 'r-borders-' + this.setting.border_width+' ';
           	   classes += 'r-animation-' + this.setting.desktop_animation+' ';
           	   classes += 'r-style-' + this.setting.desktop_style+' ';
           	   classes += 'r-position-' + this.setting.desktop_placement+' ';
               return classes;
           },
           mobile_classes () {
           	   var classes = '';
           	   if(this.setting.active && this.setting.active_mobile){
           	   	  classes +='r-show ';
           	   }
           	   if(this.setting.active_mobile){
           	   	  classes +='r-mobile ';
           	   }

           	   
           	   classes += 'r-animation-' + this.setting.mobile_animation+' ';
           	   classes += 'r-style-' + this.setting.mobile_style+' ';
           	   classes += 'r-position-' + this.setting.mobile_placement+' ';
               return classes;
           }
       },
    methods: {
      reverseOrder: function(array){
        return array.slice().reverse()
      },
      moment: function (date) {
        return moment(date);
      },
    	updateColorModel : function(property,e){
    		if(property == 'desktop_background_color'){
	    		this.setting.desktop_background_color = '#'+e.target.value;
	    	}
    		if(property == 'desktop_text_color'){
	    		this.setting.desktop_text_color = '#'+e.target.value;
	    	}
	    	if(property == 'desktop_date_color'){
	    		this.setting.desktop_date_color = '#'+e.target.value;
	    	}
	    	if(property == 'desktop_border_color'){
	    		this.setting.desktop_border_color = '#'+e.target.value;
	    	}
	    	if(property == 'desktop_product_color'){
	    		this.setting.desktop_product_color = '#'+e.target.value;
	    	}

	    	if(property == 'mobile_background_color'){
	    		this.setting.mobile_background_color = '#'+e.target.value;
	    	}
    		if(property == 'mobile_text_color'){
	    		this.setting.mobile_text_color = '#'+e.target.value;
	    	}
	    	if(property == 'mobile_date_color'){
	    		this.setting.mobile_date_color = '#'+e.target.value;
	    	}
	    	if(property == 'mobile_product_color'){
	    		this.setting.mobile_product_color = '#'+e.target.value;
	    	}
  		},
  		onSubmitSetting : function(){

  			axios.post('/', this.setting).then(response => {
                  toastr.success('Settings saved successfully!');
              })
  		},
      messageHtml : function(){
        
        if(this.setting.distance == false && this.setting.message.indexOf('{ distance }') !== -1){
            alert('Please select distance search checkout to use { distance } on message');
            this.setting.message = this.setting.message.replace("{ distance }", "");
            return false;
        }
        if(this.is_mobile){
          var m = {
                  name: this.orders[0].customer_name ? this.orders[0].customer_name : "Someone",
                  city: this.orders[0].customer_city,
                  state: this.orders[0].customer_province,
                  short_state: this.orders[0].customer_province,
                  country: this.orders[0].customer_country,
                  product: '<span class="r-product-title" style="color:'+this.setting.mobile_product_color+'">' + this.orders[0].product_name + "</span>",
                  product_url: this.orders[0].url,
                  distance: '5 miles'
              };
              
        }else{
          var m = {
                  name: this.orders[0].customer_name ? this.orders[0].customer_name : "Someone",
                  city: this.orders[0].customer_city,
                  state: this.orders[0].customer_province,
                  short_state: this.orders[0].customer_province,
                  country: this.orders[0].customer_country,
                  product: '<span class="r-product-title" style="color:'+this.setting.desktop_product_color+'">' + this.orders[0].product_name + "</span>",
                  product_url: this.orders[0].url,
                  distance: '5 miles'
              };
        }
        var d = this.template(this.setting.message, m);

        document.getElementsByClassName("r-message")[0].innerHTML = d;
        
      },
      template : function(e, t) {
            do {
                var n = e,
                    i = (e = e.replace(/{([^}]+)}/g, function(e, n) {
                        var i = t[n.trim()];
                        return void 0 === i ? e : i
                    })) !== n
            } while (i);
            return e
        },
        refreshAnalytics : function(){
          axios.get('/analytics?type='+this.analytics_type+'&group='+this.analytics_group).then(response => {
             var labels = [];
             var data = [];
            response.data.map(function(value, key) {
                 labels.push(value.label_value);
                 data.push(value.value);
               });
              this.analyticsData = {
                labels: labels,
                datasets: [
                  {
                    label: this.analytics_type,
                    backgroundColor: '#f87979',
                    data: data
                  }
                ]
              }
          }); 
          
        }

    }
});
