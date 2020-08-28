/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { includes } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('report-component', require('./components/ReportComponent.vue').default);
Vue.component('order-component', require('./components/OrderComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ReportMixin from './reports.js';

let data = {
    isFrame: 1,
    isMount: 0,
    glassTypeIsDisabled: 0,
    mouldingNumberIsDisabled: 0,
    matNumbersAreDisabled: 0,
    secondMatNumberIsVisible: 0,
    thirdMatNumberIsVisible: 0,
    firstMatPresent: 0,
    orderType: '',
};

const app = new Vue({
    mixins: [ReportMixin],

    el: '#app',

    data: data,

    methods: {
        resetCreateOrder() {
            this.isFrame = 1;
            this.isMount = 0;
            this.secondMatNumberIsVisible = 0;
            this.thirdMatNumberIsVisible = 0;
        },
        orderTypeChange() {
            this.orderType = document.querySelector('#orderType').value;
            if ( this.orderType == 'Frame' ) {
                this.isFrame = 1;
                this.isMount = 0;
            } else {
                this.isMount = 1;
                this.isFrame = 0;
            }
        },
        showSecondMatNumber() {
            this.secondMatNumberIsVisible = 1;
        },
        hideSecondMatNumber() {
            this.secondMatNumberIsVisible = 0;
        },
        showThirdMatNumber() {
            this.thirdMatNumberIsVisible = 1;
        },
        hideThirdMatNumber() {
            this.thirdMatNumberIsVisible = 0;
        },
        removeFirstMat() {
            this.firstMatPresent = 0;
            this.$refs.orderComponent.removeFirstMat();
        },
        addFirstMat() {
            this.firstMatPresent = 1;
        },
        testFunction() {
            console.log("test");
        }
    },
});
