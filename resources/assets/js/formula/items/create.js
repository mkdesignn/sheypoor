window.Vue = require('vue');
require('vue-resource');
import VeeValidator from 'vee-validate';
Vue.use(VeeValidator);

new Vue({
    el: '#wrapper',
    data:data,
    methods:{
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