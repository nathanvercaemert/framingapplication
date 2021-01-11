<template>
</template>

<script>
    export default {
        props: ['reportorders', 'isdaterange', 'daterangeend', 'reportordersnonid', 'reportviewid'],
        mounted() {
            var isDateRange = this.isdaterange;
            this.$root.viewIsDateRange = isDateRange;
            this.$root.reportViewId = this.reportviewid;
            var endDate = "";
            if (isDateRange) {
                endDate = new Date(this.daterangeend);
                endDate.setDate(endDate.getDate() - 1);
                var dd = String(endDate.getDate()).padStart(2, '0');
                var mm = String(endDate.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = endDate.getFullYear();
                endDate = yyyy + '-' + mm + '-' + dd;
            }
            document.getElementById('viewDateRangeEnd').innerHTML = endDate;
        },
        methods: {
            populateReportOrdersListGroup: function populateReportOrdersListGroup() {
                var orderNumbers = this.reportordersnonid.split(",");
                var orderListNode = document.getElementById('reportOrderListGroup');
                while (orderListNode.firstChild) {
                    orderListNode.removeChild(orderListNode.lastChild);
                }
                orderNumbers.forEach(function (item) {
                    let li = document.createElement('a');
                    li.setAttribute('style', 'text-align:center;');
                    li.className += "list-group-item d-flex align-items-center";
                    li.setAttribute('value', item);
                    orderListNode.appendChild(li);
                    li.innerHTML += item;
                });
            },
        }
    }
</script>
