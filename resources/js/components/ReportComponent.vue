<template>
</template>

<script>
    export default {
        props: ['variable0', 'variable1', 'orders', 'reportorders'],
        mounted() {
            // Get the date pickers up and running
            var date = new Date();
            var dd = String(date.getDate()).padStart(2, '0');
            var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = date.getFullYear();
            var today = mm + '/' + dd + '/' + yyyy;

            document.querySelector('#endDatepicker').value = today;

            date.setDate(date.getDate() - 7);
            dd = String(date.getDate()).padStart(2, '0');
            mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
            yyyy = date.getFullYear();
            var oneWeekAgo = mm + '/' + dd + '/' + yyyy;

            document.querySelector('#beginDatepicker').value = oneWeekAgo;

            // Create the list of orders attached to the report.

            this.orders.forEach(function (item) {
                //Redundant and (I think) unused code, but I'm leaving it so I don't break anything.
                //I think it should just create an empty array.
                let li = document.createElement('a');
                li.className += "list-group-item list-group-item-action d-flex justify-content-between align-items-center";
                let span = document.createElement('span');
                span.className += "badge badge-primary badge-pill";
                span.innerHTML += "View";
                document.getElementById('orderList').appendChild(li);
                li.innerHTML += item;
                li.appendChild(span);
            });
        },
        methods: {
            submitFunction: function submitFunction() {
                let orderListSubmit = "";
                let orderList = document.getElementById('orderList').childNodes;
                orderList.forEach(function (childNode) {
                    orderListSubmit += childNode.getAttribute('value');
                    orderListSubmit += ",";
                });
                if (orderListSubmit[orderListSubmit.length - 1] == ',') {
                    orderListSubmit = orderListSubmit.substring(0, orderListSubmit.length - 1);
                }
                document.getElementById('submitOrderList').value = orderListSubmit;
                document.getElementById('isDateRange').value = this.$root.isDateRange;
                document.getElementById('isSpecificOrders').value = this.$root.isSpecificOrders;
                if (this.$root.isDateRange) {
                    this.$root.verifyReportContainsOrder(document.getElementById('beginDatepicker').value, document.getElementById('endDatepicker').value);
                } else {
                    document.getElementById("reportForm").submit();
                }
            },
            verificationList: function verificationList(orderNumbers) {
                $('#reportContainsOrders').modal('show');
                orderNumbers.forEach(function (item) {
                    let li = document.createElement('a');
                    li.setAttribute('style', 'text-align:center;');
                    li.className += "list-group-item d-flex align-items-center";
                    li.setAttribute('value', item);
                    document.getElementById('orderNumberVerificationList').appendChild(li);
                    li.innerHTML += "Order number " + item + " has already been reported.";
                });
            },
            verificationSubmit: function verificationSubmit() {
                document.getElementById("reportForm").submit();
            },
            removeOrder: function removeOrder() {
                let list = document.getElementById('orderList').childNodes;
                let orderNumber = this.$root.reportViewOrderNumber;
                list.forEach(function (childNode) {
                    if (childNode.getAttribute('value') == orderNumber) {
                        childNode.parentNode.removeChild(childNode);
                    }
                });
                this.$root.orderListCount -= 1;
            },
            addOrder: function addOrder() {
                this.$root.orderListCount += 1;
                let li = document.createElement('a');
                li.className += "list-group-item list-group-item-action d-flex justify-content-between align-items-center";
                li.setAttribute('data-toggle', "modal");
                li.setAttribute('data-target', "#reportViewOrder");
                li.setAttribute('value', this.$root.addOrderNumber);
                function some_func(otherFunc, ev) {
                    otherFunc(li.getAttribute('value'));
                }
                li.addEventListener ("click", some_func.bind(null, this.loadReportViewOrder), false);
                li.setAttribute('value', this.$root.addOrderNumber);
                let span = document.createElement('span');
                span.className += "badge badge-primary badge-pill";
                span.innerHTML += "View/Remove";
                document.getElementById('orderList').appendChild(li);
                li.innerHTML += this.$root.addOrderNumber;
                li.appendChild(span);
            },
            checkAlreadyInOrderList: function checkAlreadyInOrderList() {
                let orderNumber = this.$root.addOrderNumber;
                let orderListToCheck = document.getElementById('orderList').childNodes;
                let returnValue = 0
                orderListToCheck.forEach(function(originalOrderNumber) {
                    if (originalOrderNumber.getAttribute('value') == orderNumber) {
                        returnValue = 1;
                    }
                });
                return returnValue;
            },
            updateOrderNumberError: function updateOrderNumberError() {
                document.getElementById('orderNumberReportedError').innerHTML = this.$root.addOrderNumber;
                document.getElementById('orderNumberError').innerHTML = this.$root.addOrderNumber;
                document.getElementById('orderNumberAlreadyError').innerHTML = this.$root.addOrderNumber;
                document.getElementById('orderNumber').setAttribute('style', "border-color:red");
            },
            resetAddOrderModal: function resetAddOrderModal() {
                document.getElementById('orderNumber').setAttribute('style', '');
            },
            loadReportViewOrder: function loadReportViewOrder(orderNumber) {
                this.resetViewOrderModal();
                this.$root.loadReportViewOrder(orderNumber);
            },
            loadReportViewOrderCallback: function loadReportViewOrderCallback(response) {
                let order = response.data;
                this.$root.reportViewOrderIsFrame = 0;
                if (order.orderType == 'Frame') {
                    this.$root.reportViewOrderIsFrame = 1;
                }
                this.$root.reportViewOrderFirstMatNumber = 0;
                this.$root.reportViewOrderSecondMatNumber = 0;
                this.$root.reportViewOrderThirdMatNumber = 0;
                if (order.orderFirstMatNumber != -1) {
                    this.$root.reportViewOrderFirstMatNumber = 1;
                    if (order.orderSecondMatNumber != -1) {
                        this.$root.reportViewOrderSecondMatNumber = 1;
                        if (order.orderThirdMatNumber != -1) {
                            this.$root.reportViewOrderThirdMatNumber = 1;
                        }
                    }
                }
                this.$root.reportViewOrderNumber = order.orderNumber;
                document.getElementById('reportViewOrderNumber').innerHTML = order.orderNumber;
                document.getElementById('reportViewOrderFirstName').innerHTML = order.customerFirst;
                document.getElementById('reportViewOrderLastName').innerHTML = order.customerLast;
                document.getElementById('reportViewOrderEmail').innerHTML = order.customerEmail;
                document.getElementById('reportViewOrderPhone1').innerHTML = order.customerPhoneArea;
                document.getElementById('reportViewOrderPhone2').innerHTML = order.customerPhone3
                document.getElementById('reportViewOrderPhone3').innerHTML = order.customerPhone4;
                document.getElementById('reportViewOrderType').innerHTML = order.orderType;
                document.getElementById('reportViewOrderMouldingNumber').innerHTML = order.orderMouldingNumber;
                document.getElementById('reportViewOrderGlassType').innerHTML = order.orderGlassType;
                document.getElementById('reportViewOrderFirstMatNumber').innerHTML = order.orderFirstMatNumber;
                document.getElementById('reportViewOrderSecondMatNumber').innerHTML = order.orderSecondMatNumber;
                document.getElementById('reportViewOrderThirdMatNumber').innerHTML = order.orderThirdMatNumber;
                document.getElementById('reportViewOrderFoamcoreType').innerHTML = order.orderFoamcoreType;
                document.getElementById('reportViewOrderWidth').innerHTML = order.orderWidth;
                document.getElementById('reportViewOrderHeight').innerHTML = order.orderHeight;
                document.getElementById('reportViewOrderNotes').innerHTML = order.orderNotes;
            },
            resetViewOrderModal: function resetViewOrderModal() {
                this.$root.reportViewOrderIsFrame = null;
                this.$root.reportViewOrderFirstMatNumber = null;
                this.$root.reportViewOrderSecondMatNumber = null;
                this.$root.reportViewOrderThirdMatNumber = null;
                this.$root.reportViewOrderNumber = null,
                document.getElementById('reportViewOrderFirstName').innerHTML = '';
                document.getElementById('reportViewOrderLastName').innerHTML = '';
                document.getElementById('reportViewOrderEmail').innerHTML = '';
                document.getElementById('reportViewOrderPhone1').innerHTML = '';
                document.getElementById('reportViewOrderPhone2').innerHTML = '';
                document.getElementById('reportViewOrderPhone3').innerHTML = '';
                document.getElementById('reportViewOrderType').innerHTML = '';
                document.getElementById('reportViewOrderMouldingNumber').innerHTML = '';
                document.getElementById('reportViewOrderGlassType').innerHTML = '';
                document.getElementById('reportViewOrderFirstMatNumber').innerHTML = '';
                document.getElementById('reportViewOrderSecondMatNumber').innerHTML = '';
                document.getElementById('reportViewOrderThirdMatNumber').innerHTML = '';
                document.getElementById('reportViewOrderFoamcoreType').innerHTML = '';
                document.getElementById('reportViewOrderWidth').innerHTML = '';
                document.getElementById('reportViewOrderHeight').innerHTML = '';
                document.getElementById('reportViewOrderNotes').innerHTML = '';
            },
            populateDateRangeOrders: function populateDateRangeOrders() {
                var orderListNode = document.getElementById('dateRangeOrdersList');
                while (orderListNode.firstChild) {
                    orderListNode.removeChild(orderListNode.lastChild);
                }
                this.$root.getDateRangeOrders(document.querySelector('#beginDatepicker').value, document.querySelector('#endDatepicker').value);
            },
            getDateRangeOrdersCallback: function getDateRangeOrdersCallback(response) {
                var orderListNode = document.getElementById('dateRangeOrdersList');
                let orders = response.data.orders;
                orders.forEach(function (order) {
                    let li = document.createElement('a');
                    li.setAttribute('style', 'text-align:center;');
                    li.className += "list-group-item d-flex align-items-center";
                    li.setAttribute('value', order);
                    orderListNode.appendChild(li);
                    li.innerHTML += order;
                });
            }
        }
    }
</script>
