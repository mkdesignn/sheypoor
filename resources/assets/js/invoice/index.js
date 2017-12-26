import Vue from 'vue';
import VeeValidator from 'vee-validate';
import datagrid from './../components/datagrid.vue'

Vue.component("datagridview", datagrid);
Vue.use(VeeValidator);

var app = new Vue({
    el: '#wrapper',
    data: data
});
