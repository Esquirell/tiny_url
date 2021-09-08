require('./bootstrap');

import Vue from 'vue'
import vuetify from './plugins/vuetify'
import DatetimePicker from 'vuetify-datetime-picker'

window.Vue = require('vue').default;
Vue.use(DatetimePicker)

Vue.component('create-url-component', require('./components/create_url.vue').default);
Vue.component('index-component', require('./components/index_url.vue').default);


import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3200,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Swal = Swal;
window.Toast = Toast;


const app = new Vue({
    el: '#app',
    vuetify,
});
