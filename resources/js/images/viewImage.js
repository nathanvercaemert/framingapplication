import Axios from "axios"

export default {
    data: {
    },
    methods: {
        viewGetCanvasJSON(orderNumber) {
            Axios.get('/image', {
                params: {
                    orderNumber: orderNumber
                }
            }).then(response =>
                this.$refs.viewImageComponent.viewGetCanvasJSONCallback(response)
            )
        },
    }
}
