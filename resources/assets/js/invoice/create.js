import datagridview from './../components/datagrid.vue';
import currency from './../components/currency_input.vue';
import VeeValidator from 'vee-validate';
import myDatepicker from 'vue-jalaali-datepicker'
import select2 from './../components/select2.vue'

Vue.component("datagridview", datagridview);
Vue.component("notification", require('./../components/notification.vue'));
Vue.component("currency", currency);
Vue.component("select2", select2);

Vue.use(VeeValidator);

new Vue({
    el: '#wrapper',
    data:data,
    components: {
        'date-picker': myDatepicker
    },
    mounted: function(){
        if( this.$children[0].date !== undefined )
            this.issue_date = this.$children[0].date.time;
    },
    watch:{
        //bag: function(bag){
        //
        //    if( bag === '' )
        //        this.bag = 0;
        //
        //    this.total_price = this.price_profit = this.discount_price = this.addComma(bag * this.total_weight * this.price);
        //},
        total_weight: function(total_weight){

            if( total_weight === '' )
                this.total_weight = 0;

            this.total_price = this.price_profit = this.discount_price = this.addComma(total_weight * this.price);
        },
        discount_price_percent: function(discount_price_percent){

            if( discount_price_percent === '' )
                this.discount_price_percent = 0;

            var discounted_price = (this.total_weight * this.price) * discount_price_percent / 100;
            this.discount_price = this.addComma( this.removeComma(this.discount_price) - discounted_price );
        },
        buying_type: function(buying_type){

            if( buying_type === "cash" ){
                this.breath_time = 0;
                this.time = 0;
                this.profit_percent = 0;
            } else {
                this.discount_price_percent = 0;
                this.comment = "";
            }
        },
        profit_percent: function(profit_percent){
            this.price_profit = this.addComma( Math.ceil( ( ( ( ( this.time - this.breath_time) / 30 ) * profit_percent ) * this.removeComma(this.total_price) / 100 ) + this.removeComma(this.total_price) ) );
        },
        time: function(time){
            this.price_profit = this.addComma( Math.ceil( ( ( ( ( time - this.breath_time) / 30 ) * this.profit_percent ) * this.removeComma(this.total_price) / 100 ) + this.removeComma(this.total_price) ) );
        },
        breath_time: function(breath_time){
            this.price_profit = this.addComma( Math.ceil( ( ( ( ( this.time - breath_time) / 30 ) * this.profit_percent ) * this.removeComma(this.total_price) / 100 ) + this.removeComma(this.total_price) ) );
        },
        fill_data: function(fill_data){
            console.log(fill_data);
        },
        // product_id: function(product_id){
        //     var id = "";
        //     this.formula_product_relation.forEach(function(value, key){
        //         if( product_id === value.product_id )
        //         {
        //             id = value.id;
        //             return false;
        //         }
        //     });
        //     this.formula_id = id;
        // }
    },
    methods:{

        changeProductId(product_id){

            var id = "";
            this.formula_product_relation.forEach(function(value, key){
                if( product_id === value.product_id )
                {
                    id = value.id;
                    return false;
                }
            });

            if( typeof product_id === "string" )
                this.product_id = product_id;

            this.formula_id = id;
        },
        getDate: function(date){
            this.issue_date = this.$children[0].date.time;
            //this.issue_date = date;
        },
        priceInput: function(data){
            this.price = data;
            this.total_price = this.price_profit = this.discount_price = this.addComma(this.total_weight * data);
        },
        registerAnArticle: function(event, request){

            event.preventDefault();
            var vm = this;
            this.$validator.validateAll().then((result) => {
                if (result) {

                    axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest';
                    axios.defaults.headers['X-CSRF-TOKEN'] = jQuery('meta[name="csrf-token"]').attr('content');
                    console.log(vm.product_id);
                    axios.post(request, {
                        invoice_id: vm.invoice_id,
                        product_id: vm.product_id,
                        formula_id: vm.formula_id,
                        total_bag: vm.bag,
                        total_weight: vm.total_weight,
                        price: vm.price,
                        discount_price_percent: vm.discount_price_percent,
                        profit_percent: vm.profit_percent,
                        time: vm.time,
                        breath_time: vm.breath_time,
                        total_price: vm.total_price

                    }).then(function(response){
                       vm.created_record = response.data;
                    });

                    return;
                }
            });

        },
        addComma: function(price){
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        removeComma: function(price){
            return parseInt(price.replace(/,/gi, ''));
        },
        preparePrintPages: function(page){

            window.open(page);
        }
    }
});



