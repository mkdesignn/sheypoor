import Vue from 'vue';
import flle_preview from './../components/file-preview.vue';

Vue.component("file-preview", flle_preview);

var app = new Vue({
    el: '#wrapper',
    data: data
});
