window.Vue = require('vue');

import Vue from 'vue';
import App from './views/App';
import router from './router';

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
