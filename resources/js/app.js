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

Vue.component('edit-report-component', require('./components/EditReportComponent.vue').default);
Vue.component('report-view-component', require('./components/ReportViewComponent.vue').default);
Vue.component('report-component', require('./components/ReportComponent.vue').default);
Vue.component('order-component', require('./components/OrderComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//price updating componenet
Vue.component('price-update-component', require('./components/price_updates/PriceUpdateComponent.vue').default);
Vue.component('edit-price-update-component', require('./components/price_updates/EditPriceUpdateComponent.vue').default);

//fixing issues with mats in order editing
Vue.component('edit-order-fix-component', require('./components/EditOrderFixComponent.vue').default);

//fabric components
Vue.component('create-image-component', require('./components/images/CreateImageComponent.vue').default);
Vue.component('view-image-component', require('./components/images/ViewImageComponent.vue').default);

//search component
Vue.component('search-component', require('./components/SearchComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ReportMixin from './reports.js';
import ReportViewMixin from './reportView.js';
import ReportEditMixin from './reportEdit.js';
import PriceUpdateMixin from './price_updates/priceUpdate.js';

import CreateImageMixin from './images/createImage.js';
import ViewImageMixin from './images/viewImage.js';

import SearchMixin from './search.js';

import Axios from "axios";

import { fabric } from 'fabric'
import { hammer } from 'hammerjs'

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

    isReported: null,
    reportNumber: null,
    isProcessed: null,
    reportViewId: null,
};

const app = new Vue({
    mixins: [ReportMixin, ReportViewMixin, ReportEditMixin, PriceUpdateMixin, CreateImageMixin, ViewImageMixin, SearchMixin],

    el: '#app',

    data: data,

    methods: {
        populateReportViewButton() {
            Axios.get('/reports/getbynumber', {
                params: {
                    reportNumber: this.reportNumber
                }
            }).then(response =>
                this.$refs.orderComponent.populateReportViewButtonCallback(response)
            )
        },
        completionFunction() {
            this.$refs.orderComponent.completionFunction();
        },
        resetCreateOrder() {
            this.isFrame = 1;
            this.isMount = 0;
            this.secondMatNumberIsVisible = 0;
            this.thirdMatNumberIsVisible = 0;
            this.firstMatPresent = 0;
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
            if (this.$refs.priceUpdateComponent != undefined) {
                this.$refs.priceUpdateComponent.priceUpdate();
            } else {
                this.$refs.editPriceUpdateComponent.editPriceUpdate();
            }
        },
        hideSecondMatNumber() {
            this.secondMatNumberIsVisible = 0;
            if (this.$refs.priceUpdateComponent != undefined) {
                this.$refs.priceUpdateComponent.priceUpdate();
            } else {
                this.$refs.editPriceUpdateComponent.editPriceUpdate();
            }
        },
        showThirdMatNumber() {
            this.thirdMatNumberIsVisible = 1;
            if (this.$refs.priceUpdateComponent != undefined) {
                this.$refs.priceUpdateComponent.priceUpdate();
            } else {
                this.$refs.editPriceUpdateComponent.editPriceUpdate();
            }
        },
        hideThirdMatNumber() {
            this.thirdMatNumberIsVisible = 0;
            if (this.$refs.priceUpdateComponent != undefined) {
                this.$refs.priceUpdateComponent.priceUpdate();
            } else {
                this.$refs.editPriceUpdateComponent.editPriceUpdate();
            }
        },
        removeFirstMat() {
            this.firstMatPresent = 0;
            this.$refs.orderComponent.removeFirstMat();
            if (this.$refs.priceUpdateComponent != undefined) {
                this.$refs.priceUpdateComponent.priceUpdate();
            } else {
                this.$refs.editPriceUpdateComponent.editPriceUpdate();
            }
        },
        firstMatChange() {
            this.$refs.orderComponent.firstMatChange()
        },
        testFunction() {
            console.log("test");
        }
    },
});
