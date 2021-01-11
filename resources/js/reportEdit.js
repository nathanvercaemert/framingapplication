import Axios from "axios"

export default {
    data: {
        testVariable: 0,
        editIsDateRange: 0,
        editIsSpecificOrders: 0,
        editOrderListCount: 0,
        editAddOrderNumber: null,
        editIsInvalid: 0,
        editIsReported: 0,
        editSameReportPreviouslyRemoved: 0,
        editAlreadyInOrderList: 0,
        empty: 'empty',


        editReportViewOrderIsFrame: null,
        editReportViewOrderFirstMatNumber: null,
        editReportViewOrderSecondMatNumber: null,
        editReportViewOrderThirdMatNumber: null,
        editReportViewOrderNumber: null,
        editReportOrder: null,
        editOrderList: null,
    },
    methods: {
        editResetOrderList() {
            this.editOrderListEmpty = 1;
            this.editOrderList = null;
        },
        testFunction3: function () {
            console.log('test')
        },
        editReportTypeChange: function () {
            if (document.querySelector('#editReportTypesDateRange').checked) {
                this.editIsDateRange = 1
                this.editIsSpecificOrders = 0
            } else {
                this.editIsSpecificOrders = 1
                this.editIsDateRange = 0
            }
        },
        editResetAddOrderModal: function() {
            this.editIsInvalid = 0
            this.editIsReported = 0
            this.editSameReportPreviouslyRemoved = 0
            this.editAlreadyInOrderList = 0
            this.editAddOrderNumber = null
            this.$refs.editReportComponent.editResetAddOrderModal()
        },
        editRemoveOrder: function() {
            this.$refs.editReportComponent.editRemoveOrder()
        },
        editAddOrder: function() {
            this.editSameReportPreviouslyRemoved = this.checkEditSameReportPreviouslyRemoved()
            this.editAlreadyInOrderList = this.checkEditAlreadyInOrderList()
            if (this.editAlreadyInOrderList) {
                this.$refs.editReportComponent.editUpdateOrderNumberError()
                this.editIsInvalid = 0
                this.editIsReported = 0
            } else if (this.editSameReportPreviouslyRemoved) {
                this.$refs.editReportComponent.editAddOrder()
                $('#editAddOrder').modal('hide');
            } else {
                Axios.get('/reports/add', {
                    params: {
                        orderNumber: this.editAddOrderNumber
                    }
                }).then(response =>
                    this.editAddOrderCallback(response)
                )
            }
        },
        editAddOrderCallback: function(response) {
            this.editAddOrderNumber = response.data.orderNumber
            if (response.data.isReported) {
                this.$refs.editReportComponent.editUpdateOrderNumberError()
                this.editAlreadyInOrderList = 0
                this.editIsInvalid = 0
                this.editIsReported = 1
            } else {
                if (response.data.isValid) {
                    this.$refs.editReportComponent.editAddOrder()
                    $('#editAddOrder').modal('hide');
                } else {
                    this.$refs.editReportComponent.editUpdateOrderNumberError()
                    this.editAlreadyInOrderList = 0
                    this.editIsReported = 0
                    this.editIsInvalid = 1
                }
            }
        },
        checkEditAlreadyInOrderList: function() {
            return this.$refs.editReportComponent.checkEditAlreadyInOrderList()
        },
        checkEditSameReportPreviouslyRemoved: function() {
            return this.$refs.editReportComponent.checkEditSameReportPreviouslyRemoved()
        },
        editLoadReportViewOrder: function(orderNumber) {
            Axios.get('/reports/load', {
                params: {
                    orderNumber: orderNumber
                }
            }).then(response =>
                this.$refs.editReportComponent.editLoadReportViewOrderCallback(response)
            )
        },
        editVerifyReportContainsOrder: function(reportNumber, beginDatepicker, endDatepicker) {
            Axios.get('/reports/verify', {
                params: {
                    reportNumber: reportNumber,
                    beginDatepicker: beginDatepicker,
                    endDatepicker: endDatepicker,
                }
            }).then(response =>
                this.editVerifyReportContainsOrderCallback(response)
            )
        },
        editVerifyReportContainsOrderCallback: function(response) {
            if (response.data.orderNumbers.length == 0) {
                this.$refs.editReportComponent.editVerificationSubmit();
            } else {
                this.$refs.editReportComponent.editVerificationList(response.data.orderNumbers);
            }
        },
        editVerificationSubmit: function() {
            this.$refs.editReportComponent.editVerificationSubmit();
        },
        editSubmitFunction: function() {
            this.$refs.editReportComponent.editSubmitFunction()
        },
        populateEditDateRangeOrders: function() {
            this.$refs.editReportComponent.populateEditDateRangeOrders()
        },
        editGetDateRangeOrders: function(reportNumber, beginDate, endDate) {
            Axios.get('/reports/daterangeorders', {
                params: {
                    reportNumber: reportNumber,
                    beginDate: beginDate,
                    endDate: endDate,
                }
            }).then(response =>
                this.editGetDateRangeOrdersCallback(response)
            )
        },
        editGetDateRangeOrdersCallback: function(response) {
            this.$refs.editReportComponent.editGetDateRangeOrdersCallback(response)
        }
    }
}
