import Axios from "axios"

export default {
    data: {
    },
    methods: {
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
