require('./bootstrap');

require('alpinejs');

import Vue from 'vue'
import App from './vue/App.vue'

const app = new Vue({
    el: '#app',
    component: { App },
    render: h => h(App)
});
