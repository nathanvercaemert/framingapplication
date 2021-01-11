<template>
</template>

<script>
    export default {
        props: ['oldsecondmatnumber', 'oldthirdmatnumber', 'oldfirstmatnumber', 'oldisframe', 'isreported', 'reportnumber', 'price'],
        mounted() {
            this.$root.firstMatPresent = this.oldfirstmatnumber;
            this.$root.secondMatNumberIsVisible = this.oldsecondmatnumber;
            this.$root.thirdMatNumberIsVisible = this.oldthirdmatnumber;
            this.$root.isFrame = this.oldisframe;
            this.$root.isReported = this.isreported;
            this.$root.reportNumber = this.reportnumber;
            if (this.reportnumber != -2) {
                this.$root.populateReportViewButton();
            }
            if (this.price) {
                document.getElementById("priceSpan").innerHTML = this.formatMoney(this.price, 2, '.', ',')
            }
        },
        methods: {
            removeFirstMat: function removeFirstMat() {
                document.querySelector('#firstMatNumber').value = null;
            },
            completionFunction: function completionFunction() {
                if (this.isreported == 0 || this.$root.isProcessed == 0) {
                    $('#completionError').modal('show');
                } else {
                    document.getElementById("completeOrderForm").submit();
                }
            },
            populateReportViewButtonCallback: function populateReportViewButtonCallback(response) {
                if (response.data == -1) {
                    this.$root.isProcessed = 0;
                } else {
                    let reportId = response.data[0].reportId;
                    this.$root.isProcessed = response.data[0].isProcessed;
                    $( "#reportViewButton" ).attr( 'href', '/reports/view/' + reportId );
                }
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
