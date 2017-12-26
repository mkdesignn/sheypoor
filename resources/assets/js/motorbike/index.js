import Vue from 'vue';
import VeeValidator from 'vee-validate';
import datagrid from './../components/datagrid.vue'
import flle_preview from './../components/file-preview.vue';

Vue.component("datagridview", datagrid);
Vue.component("file-preview", flle_preview);
Vue.use(VeeValidator);

var app = new Vue({
    el: '#wrapper',
    data: data
});
