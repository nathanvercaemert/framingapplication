import Axios from "axios"

export default {
    data: {
        testVariable: 0,
        viewIsDateRange: 0,
    },
    methods: {
        testFunction3: function () {
            console.log('test')
        },
        populateReportOrdersListGroup: function() {
            this.$refs.reportViewComponent.populateReportOrdersListGroup()
        },
    }
}
