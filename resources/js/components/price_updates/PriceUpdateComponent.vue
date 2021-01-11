<template>
</template>

<script>
    export default {
        props: ['priceupdatetest', 'isediting', 'price'],
        mounted() {
            this.$root.isEditing = this.isediting;
            this.$root.isCalculated = this.$root.isEditing;
            if (this.$root.isCalculated) {
                document.getElementById("priceSpan").innerHTML = this.price
            } else {
                document.getElementById("priceSpan").innerHTML = 'N/A'
            }
            document.getElementById("orderType").addEventListener("change", this.priceUpdate, false)
            document.getElementById("orderWidth").addEventListener("change", this.priceUpdate, false)
            document.getElementById("orderHeight").addEventListener("change", this.priceUpdate, false)
            document.getElementById("firstMatNumber").addEventListener("change", this.priceUpdate, false)
            document.getElementById("secondMatNumber").addEventListener("change", this.priceUpdate, false)
            document.getElementById("thirdMatNumber").addEventListener("change", this.priceUpdate, false)
            document.getElementById("orderGlassType").addEventListener("change", this.priceUpdate, false)
            document.getElementById("orderFoamcoreType").addEventListener("change", this.priceUpdate, false)
            document.getElementById("orderMouldingNumber").addEventListener("change", this.priceUpdate, false)

            this.priceUpdate();
        },
        methods: {
            priceUpdate: function priceUpdate() {
                let orderWidth = document.getElementById("orderWidth").value
                let orderHeight = document.getElementById("orderHeight").value
                let firstMat = document.getElementById("firstMatNumber").value
                let secondMat = document.getElementById("secondMatNumber").value
                let thirdMat = document.getElementById("thirdMatNumber").value
                let glass = document.getElementById("orderGlassType").value
                let foamcore = document.getElementById("orderFoamcoreType").value
                let mouldingNumber = document.getElementById("orderMouldingNumber").value
                this.$root.priceUpdate(orderWidth, orderHeight, mouldingNumber, firstMat, secondMat, thirdMat, glass, foamcore)
            },
            priceUpdateCallback: function priceUpdateCallback(response) {
                const cost = response.data
                let costFormatted = this.formatMoney(cost, 2, '.', ',')
                document.getElementById("priceSpan").innerHTML = costFormatted;
            },
            formatMoney(number, decPlaces, decSep, thouSep) {
                decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSep = typeof decSep === "undefined" ? "." : decSep;
                thouSep = typeof thouSep === "undefined" ? "," : thouSep;
                var sign = number < 0 ? "-" : "";
                var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
                var j = (j = i.length) > 3 ? j % 3 : 0;

                return sign +
                    (j ? i.substr(0, j) + thouSep : "") +
                    i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                    (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
            }

        }
    }
</script>
