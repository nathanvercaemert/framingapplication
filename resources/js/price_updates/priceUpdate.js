import Axios from "axios"

export default {
    data: {
        priceUpdateTestVariable: null,

        isCalculated: null,
        isEditing: null,
        price: null,
    },
    methods: {
        priceUpdateTest() {
            console.log("test")
        },
        priceUpdate: function(orderWidth, orderHeight, mouldingNumber, firstMat, secondMat, thirdMat, glass, foamcore) {
            if (this.isFrame) {
                if (!this.firstMatPresent) {
                    firstMat = null
                }
                if (!this.secondMatNumberIsVisible) {
                    secondMat = null
                }
                if (!this.thirdMatNumberIsVisible) {
                    thirdMat = null
                }
            } else {
                mouldingNumber = null
                firstMat = null
                secondMat = null
                thirdMat = null
                glass = null
            }
            Axios.get('/orders/price', {
                params: {
                    orderWidth: orderWidth,
                    orderHeight: orderHeight,
                    mouldingNumber: mouldingNumber,
                    firstMat: firstMat,
                    secondMat: secondMat,
                    thirdMat: thirdMat,
                    glass: glass,
                    foamcore: foamcore
                }
            }).then(response =>
                this.priceUpdateCallback(response)
            )
        },
        priceUpdateCallback(response) {
            if (this.$refs.priceUpdateComponent != undefined) {
                this.$refs.priceUpdateComponent.priceUpdateCallback(response)
            } else {
                this.$refs.editPriceUpdateComponent.editPriceUpdateCallback(response)
            }
        }
    }
}
