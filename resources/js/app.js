/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import Swal from 'sweetalert2';
window.Swal = Swal;
// window.moment = require('moment');
// window.moment = moment;
import moment from 'moment';
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})


import Profile from './components/Profile.vue'
import Home from './components/Home.vue'
import AddFriends from './components/Addfriend.vue'
import AddPost from './components/AddPost.vue'
import EditProfile from './components/EditProfile.vue'
import PostShow from './components/ShowPost.vue'
const Bar = {
    template: '<div>Haseeb</div>'
}
const routes = [{
        path: '/profiles/:id',
        component: Profile,


    },
    {
        path: '/',
        component: Home
    },
    {
        path: '/addfriends',
        component: AddFriends
    },
    {
        path: '/addpost',
        component: AddPost
    },
    {
        path: '/editprofile/:id',
        component: EditProfile
    },
    {
        path: '/post/:id',
        component: PostShow
    },
]
const router = new VueRouter({
   
    routes // short for `routes: routes`
})
Vue.filter('mytime', function (created) {

    // return moment(created).startOf('day').fromNow();
    return moment(created).fromNow();
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('home', require('./components/ExampleComponent.vue').default);
Vue.component('home', Home);
Vue.component('post', AddPost);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    created() {
        const auth = $('meta[name="userid"]').attr('content');
        // console.log(moment().format())
    }
}).$mount('#app')
// const app = new Vue({
//     el: '#app',
// });
