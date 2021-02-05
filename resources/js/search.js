import Axios from "axios"

export default {
    data: {
        // searchCustomerEmail: null,
        // searchCustomerPhoneArea: null,
        // searchCustomerPhone3: null,
        // searchCustomerPhone4: null,
    },
    methods: {
        // resetSearch() {
        //     this.searchCustomerEmail = null
        //     this.searchCustomerPhoneArea = null
        //     this.searchCustomerPhone3 = null
        //     this.searchCustomerPhone4 = null
        // },
        searchSubmitFunction(customerEmail, customerPhoneArea, customerPhone3, customerPhone4) {
            Axios.get('/orders/search', {
                params: {
                    customerEmail: customerEmail,
                    customerPhoneArea: customerPhoneArea,
                    customerPhone3: customerPhone3,
                    customerPhone4: customerPhone4,
                }
            }).then(response =>
                this.$refs.searchComponent.searchSubmitFunctionCallback(response)
            )
        }
    }
}
