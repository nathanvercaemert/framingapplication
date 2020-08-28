import Axios from "axios"

export default {
    data: {
        testVariable: 0,
        isSpecificOrders: 0,
        isDateRange: 1,
        addOrderNumber: null,
        isInvalid: 0,
        orderListCount: 0,

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
            this.addOrderNumber = null
            this.$refs.reportComponent.resetAddOrderModal()
        },
        removeOrder: function() {
            this.$refs.reportComponent.removeOrder()
        },
        addOrder: function() {
            Axios.get('/reports/add', {
                params: {
                    orderNumber: this.addOrderNumber
                }
            }).then(response =>
                this.addOrderCallback(response)
            )
        },
        addOrderCallback: function(response) {
            this.addOrderNumber = response.data.orderNumber
            if (response.data.isValid) {
                this.$refs.reportComponent.addOrder()
                $('#addOrder').modal('hide');
            } else {
                this.$refs.reportComponent.updateOrderNumberError()
                this.isInvalid = 1
            }
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
        submitFunction: function() {
            this.$refs.reportComponent.submitFunction()
        }
    }
}
