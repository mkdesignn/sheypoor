window.Vue = require('vue');
import VeeValidator from 'vee-validate';
import myDatepicker from 'vue-jalaali-datepicker'
Vue.use(VeeValidator);



new Vue({
    el: '#wrapper',
    data:data,
    components: {
        'date-picker': myDatepicker
    },
    mounted: function(){
        //this.myDate = this.$children[0].date.time
    },
    methods:{
        getDate: function(date){
            this.date = date;
        },
        submitForm: function(event){

            var vm = this;
            this.$validator.validateAll().then((result) => {
                if (result)
                    return true;
                else{
                    event.preventDefault();
                    return false;
                }
            });
        }
    }
});



