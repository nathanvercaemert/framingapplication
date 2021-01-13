import Axios from "axios"

export default {
    data: {
        createImageTestVariable: null,

        canvasJSON: null,

        canvasIsHidden: 1,
        isDrawingMode: 0,
        fabricCanvas: null
    },
    methods: {
        createImageTest() {
            console.log("test")
        },
        resetCanvas() {
            this.canvasJSON = null
            this.canvasIsHidden = 1
            this.isDrawingMode = 0
            this.fabricCanvas = null
        },
        updateCanvasJSON() {
            this.$refs.createImageComponent.updateCanvasJSON()
        },
        getCanvasJSON(orderNumber) {
            Axios.get('/image', {
                params: {
                    orderNumber: orderNumber
                }
            }).then(response =>
                this.$refs.createImageComponent.getCanvasJSONCallback(response)
            )
        }
    }
}
