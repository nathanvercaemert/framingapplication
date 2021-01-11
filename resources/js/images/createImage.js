import Axios from "axios"

export default {
    data: {
        createImageTestVariable: null,

        canvasIsHidden: 1,
        isDrawingMode: 0,
        fabricCanvas: null
    },
    methods: {
        createImageTest() {
            console.log("test")
        },
        resetCreateCanvas() {
            this.canvasIsHidden = 1
            this.isDrawingMode = 0
            this.fabricCanvas = null
        }
    }
}
