/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import 'element-ui/'
import ElementUI from 'element-ui';

import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'

// configurar lenguaje
locale.use(lang);
Vue.use(ElementUI);

Vue.component('admin', require('./components/admin/index.vue'));
Vue.component('supervisor', require('./components/supervisor/index.vue'));

const app = new Vue({
    el: '#app'
});
