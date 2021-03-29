import Axios from "axios"

export default {
    data: {
        testVariable: 0,
        isSpecificOrders: 0,
        isDateRange: 1,
        addOrderNumber: null,
        isInvalid: 0,
        orderListCount: 0,
        isReported: 0,
        alreadyInOrderList: 0,
        dateRangeOrderList: null,

        reportViewOrderIsFrame: null,
        reportViewOrderFirstMatNumber: null,
        reportViewOrderSecondMatNumber: null,
        reportViewOrderThirdMatNumber: null,
        reportViewOrderNumber: null,
        reportOrder: null,
        orderList: null,
    },
    methods: {
        resetOrderList() {
            this.orderListEmpty = 1;
            this.orderList = null;
        },
        testFunction3: function () {
            console.log('test')
        },
        reportTypeChange: function () {
            if (document.querySelector('#reportTypesDateRange').checked) {
                this.isDateRange = 1
                this.isSpecificOrders = 0
            } else {
                this.isSpecificOrders = 1
                this.isDateRange = 0
            }
        },
        resetAddOrderModal: function() {
            this.isInvalid = 0
            this.isReported = 0
            this.addOrderNumber = null
            this.alreadyInOrderList = 0
            this.$refs.reportComponent.resetAddOrderModal()
        },
        removeOrder: function() {
            this.$refs.reportComponent.removeOrder()
        },
        addOrder: function() {
            this.alreadyInOrderList = this.checkAlreadyInOrderList()
            if (this.alreadyInOrderList) {
                this.isInvalid = 0
                this.isReported = 0
                this.$refs.reportComponent.updateOrderNumberError()
            } else {
                Axios.get('/reports/add', {
                    params: {
                        orderNumber: this.addOrderNumber
                    }
                }).then(response =>
                    this.addOrderCallback(response)
                )
            }
        },
        addOrderCallback: function(response) {
            this.addOrderNumber = response.data.orderNumber
            if (response.data.isReported) {
                this.$refs.reportComponent.updateOrderNumberError()
                this.alreadyInOrderList = 0
                this.isInvalid = 0
                this.isReported = 1
            } else {
                if (response.data.isValid) {
                    this.$refs.reportComponent.addOrder()
                    $('#addOrder').modal('hide');
                } else {
                    this.$refs.reportComponent.updateOrderNumberError()
                    this.alreadyInOrderList = 0
                    this.isReported = 0
                    this.isInvalid = 1
                }
            }
        },
        checkAlreadyInOrderList: function() {
            return this.$refs.reportComponent.checkAlreadyInOrderList()
        },
        loadReportViewOrder: function(orderNumber) {
            Axios.get('/reports/load', {
                params: {
                    orderNumber: orderNumber
                }
            }).then(response =>
                this.$refs.reportComponent.loadReportViewOrderCallback(response)
            )
        },
        verifyReportContainsOrder: function(beginDatepicker, endDatepicker) {
            Axios.get('/reports/verify', {
                params: {
                    beginDatepicker: beginDatepicker,
                    endDatepicker: endDatepicker,
                }
            }).then(response =>
                this.verifyReportContainsOrderCallback(response)
            )
        },
        verifyReportContainsOrderCallback: function(response) {
            if (response.data.orderNumbers.length == 0) {
                this.$refs.reportComponent.verificationSubmit();
            } else {
                this.$refs.reportComponent.verificationList(response.data.orderNumbers);
            }
        },
        verificationSubmit: function() {
            this.$refs.reportComponent.verificationSubmit();
        },
        submitFunction: function() {
            this.$refs.reportComponent.submitFunction()
        },
        populateDateRangeOrders: function() {
            this.$refs.reportComponent.populateDateRangeOrders()
        },
        getDateRangeOrders: function(beginDate, endDate) {
            Axios.get('/reports/daterangeorders', {
                params: {
                    beginDate: beginDate,
                    endDate: endDate,
                }
            }).then(response =>
                this.getDateRangeOrdersCallback(response)
            )
        },
        getDateRangeOrdersCallback: function(response) {
            this.$refs.reportComponent.getDateRangeOrdersCallback(response)
        }
    }
}
