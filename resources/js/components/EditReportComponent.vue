<template>
</template>

<script>
    export default {
        props: ['editorders', 'editreportorders', 'isdaterange', 'isspecificorders', 'daterangebegin', 'daterangeend', 'reportnumber'],
        mounted() {
            this.$root.editOrderListCount = 0;
            var isDateRange = this.isdaterange;
            this.$root.editIsDateRange = parseInt(isDateRange);
            this.$root.editIsSpecificOrders = parseInt(this.isspecificorders);
            var endDate = "";
            var beginDate = "";
            if (isDateRange) {
                endDate = new Date(this.daterangeend);
                endDate.setDate(endDate.getDate() - 1);
                var dd = String(endDate.getDate()).padStart(2, '0');
                var mm = String(endDate.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = endDate.getFullYear();
                endDate = mm + '/' + dd + '/' + yyyy;

                beginDate = new Date(this.daterangebegin);
                beginDate.setDate(beginDate.getDate());
                dd = String(beginDate.getDate()).padStart(2, '0');
                mm = String(beginDate.getMonth() + 1).padStart(2, '0'); //January is 0!
                yyyy = beginDate.getFullYear();
                beginDate = mm + '/' + dd + '/' + yyyy;
            }
            document.querySelector('#editEndDatepicker').value = endDate;
            document.querySelector('#editBeginDatepicker').value = beginDate;

            // Create the list of orders attached to the report.

            this.editorders.forEach(function (item) {
                let li = document.createElement('a');
                li.className += "list-group-item list-group-item-action d-flex justify-content-between align-items-center";
                let span = document.createElement('span');
                span.className += "badge badge-primary badge-pill";
                span.innerHTML += "View/Remove";
                li.setAttribute('data-toggle', "modal");
                li.setAttribute('data-target', "#editReportViewOrder");
                document.getElementById('editOrderList').appendChild(li);
                li.innerHTML += item;
                li.setAttribute('value', item);
                function some_func(otherFunc, ev) {
                    otherFunc(li.getAttribute('value'));
                }
                li.addEventListener ("click", some_func.bind(null, this.editLoadReportViewOrder), false);
                li.appendChild(span);
                this.$root.editOrderListCount++;
            }.bind(this));

            //Create the list of orders to be unreported
            document.getElementById('editUnreportCheckList').value = this.editorders;
        },
        methods: {
            editSubmitFunction: function editSubmitFunction() {
                let orderListSubmit = "";
                let orderList = document.getElementById('editOrderList').childNodes;
                orderList.forEach(function (childNode) {
                    orderListSubmit += childNode.getAttribute('value');
                    orderListSubmit += ",";
                });
                if (orderListSubmit[orderListSubmit.length - 1] == ',') {
                    orderListSubmit = orderListSubmit.substring(0, orderListSubmit.length - 1);
                }
                document.getElementById('editSubmitOrderList').value = orderListSubmit;
                document.getElementById('editIsDateRange').value = this.$root.editIsDateRange;
                document.getElementById('editIsSpecificOrders').value = this.$root.editIsSpecificOrders;
                if (this.$root.editIsDateRange) {
                    this.$root.editVerifyReportContainsOrder(this.reportnumber, document.getElementById('editBeginDatepicker').value, document.getElementById('editEndDatepicker').value);
                } else {
                    document.getElementById("editReportForm").submit();
                }
            },
            editVerificationList: function editVerificationList(orderNumbers) {
                $('#editReportContainsOrders').modal('show');
                orderNumbers.forEach(function (item) {
                    let li = document.createElement('a');
                    li.setAttribute('style', 'text-align:center;');
                    li.className += "list-group-item d-flex align-items-center";
                    li.setAttribute('value', item);
                    document.getElementById('editOrderNumberVerificationList').appendChild(li);
                    li.innerHTML += "Order number " + item + " already in different report.";
                });
            },
            editVerificationSubmit: function editVerificationSubmit() {
                document.getElementById("editReportForm").submit();
            },
            editRemoveOrder: function editRemoveOrder() {
                let list = document.getElementById('editOrderList').childNodes;
                let orderNumber = this.$root.editReportViewOrderNumber;
                list.forEach(function (childNode) {
                    if (childNode.getAttribute('value') == orderNumber) {
                        childNode.parentNode.removeChild(childNode);
                    }
                });
                this.$root.editOrderListCount -= 1;
            },
            checkEditAlreadyInOrderList: function checkEditAlreadyInOrderList() {
                let orderNumber = this.$root.editAddOrderNumber;
                let orderListToCheck = document.getElementById('editOrderList').childNodes;
                let returnValue = 0
                orderListToCheck.forEach(function(originalOrderNumber) {
                    if (originalOrderNumber.getAttribute('value') == orderNumber) {
                        returnValue = 1;
                    }
                });
                return returnValue;
            },
            checkEditSameReportPreviouslyRemoved: function checkEditSameReportPreviouslyRemoved() {
                let orderNumber = this.$root.editAddOrderNumber;
                let orderListToCheck = document.getElementById('editUnreportCheckList').value.split(",");
                let returnValue = 0;
                orderListToCheck.forEach(function(originalOrderNumber) {
                    if (originalOrderNumber == orderNumber) {
                        returnValue = 1;
                    }
                });
                return returnValue;
            },
            editAddOrder: function editAddOrder() {
                this.$root.editOrderListCount += 1;
                let li = document.createElement('a');
                li.className += "list-group-item list-group-item-action d-flex justify-content-between align-items-center";
                li.setAttribute('data-toggle', "modal");
                li.setAttribute('data-target', "#editReportViewOrder");
                li.setAttribute('value', this.$root.editAddOrderNumber);
                function some_func(otherFunc, ev) {
                    otherFunc(li.getAttribute('value'));
                }
                li.addEventListener ("click", some_func.bind(null, this.editLoadReportViewOrder), false);
                li.setAttribute('value', this.$root.editAddOrderNumber);
                let span = document.createElement('span');
                span.className += "badge badge-primary badge-pill";
                span.innerHTML += "View/Remove";
                document.getElementById('editOrderList').appendChild(li);
                li.innerHTML += this.$root.editAddOrderNumber;
                li.appendChild(span);
            },
            editUpdateOrderNumberError: function editUpdateOrderNumberError() {
                document.getElementById('editOrderNumberReportedError').innerHTML = this.$root.editAddOrderNumber;
                document.getElementById('editOrderNumberAlreadyError').innerHTML = this.$root.editAddOrderNumber;
                document.getElementById('editOrderNumberError').innerHTML = this.$root.editAddOrderNumber;
                document.getElementById('editOrderNumber').setAttribute('style', "border-color:red");
            },
            editResetAddOrderModal: function editResetAddOrderModal() {
                document.getElementById('editOrderNumber').setAttribute('style', '');
            },
            editLoadReportViewOrder: function editLoadReportViewOrder(orderNumber) {
                this.editResetViewOrderModal();
                this.$root.editLoadReportViewOrder(orderNumber);
            },
            editLoadReportViewOrderCallback: function editLoadReportViewOrderCallback(response) {
                let order = response.data;
                this.$root.editReportViewOrderIsFrame = 0;
                if (order.orderType == 'Frame') {
                    this.$root.editReportViewOrderIsFrame = 1;
                }
                this.$root.editReportViewOrderFirstMatNumber = 0;
                this.$root.editReportViewOrderSecondMatNumber = 0;
                this.$root.editReportViewOrderThirdMatNumber = 0;
                if (order.orderFirstMatNumber != -1) {
                    this.$root.editReportViewOrderFirstMatNumber = 1;
                    if (order.orderSecondMatNumber != -1) {
                        this.$root.editReportViewOrderSecondMatNumber = 1;
                        if (order.orderThirdMatNumber != -1) {
                            this.$root.editReportViewOrderThirdMatNumber = 1;
                        }
                    }
                }
                this.$root.editReportViewOrderNumber = order.orderNumber;
                document.getElementById('editReportViewOrderNumber').innerHTML = order.orderNumber;
                document.getElementById('editReportViewOrderFirstName').innerHTML = order.customerFirst;
                document.getElementById('editReportViewOrderLastName').innerHTML = order.customerLast;
                document.getElementById('editReportViewOrderEmail').innerHTML = order.customerEmail;
                document.getElementById('editReportViewOrderPhone1').innerHTML = order.customerPhoneArea;
                document.getElementById('editReportViewOrderPhone2').innerHTML = order.customerPhone3
                document.getElementById('editReportViewOrderPhone3').innerHTML = order.customerPhone4;
                document.getElementById('editReportViewOrderType').innerHTML = order.orderType;
                document.getElementById('editReportViewOrderMouldingNumber').innerHTML = order.orderMouldingNumber;
                document.getElementById('editReportViewOrderGlassType').innerHTML = order.orderGlassType;
                document.getElementById('editReportViewOrderFirstMatNumber').innerHTML = order.orderFirstMatNumber;
                document.getElementById('editReportViewOrderSecondMatNumber').innerHTML = order.orderSecondMatNumber;
                document.getElementById('editReportViewOrderThirdMatNumber').innerHTML = order.orderThirdMatNumber;
                document.getElementById('editReportViewOrderFoamcoreType').innerHTML = order.orderFoamcoreType;
                document.getElementById('editReportViewOrderWidth').innerHTML = order.orderWidth;
                document.getElementById('editReportViewOrderHeight').innerHTML = order.orderHeight;
                document.getElementById('editReportViewOrderNotes').innerHTML = order.orderNotes;
            },
            editResetViewOrderModal: function editResetViewOrderModal() {
                this.$root.editReportViewOrderIsFrame = null;
                this.$root.editReportViewOrderFirstMatNumber = null;
                this.$root.editReportViewOrderSecondMatNumber = null;
                this.$root.editReportViewOrderThirdMatNumber = null;
                this.$root.editReportViewOrderNumber = null,
                document.getElementById('editReportViewOrderFirstName').innerHTML = '';
                document.getElementById('editReportViewOrderLastName').innerHTML = '';
                document.getElementById('editReportViewOrderEmail').innerHTML = '';
                document.getElementById('editReportViewOrderPhone1').innerHTML = '';
                document.getElementById('editReportViewOrderPhone2').innerHTML = '';
                document.getElementById('editReportViewOrderPhone3').innerHTML = '';
                document.getElementById('editReportViewOrderType').innerHTML = '';
                document.getElementById('editReportViewOrderMouldingNumber').innerHTML = '';
                document.getElementById('editReportViewOrderGlassType').innerHTML = '';
                document.getElementById('editReportViewOrderFirstMatNumber').innerHTML = '';
                document.getElementById('editReportViewOrderSecondMatNumber').innerHTML = '';
                document.getElementById('editReportViewOrderThirdMatNumber').innerHTML = '';
                document.getElementById('editReportViewOrderFoamcoreType').innerHTML = '';
                document.getElementById('editReportViewOrderWidth').innerHTML = '';
                document.getElementById('editReportViewOrderHeight').innerHTML = '';
                document.getElementById('editReportViewOrderNotes').innerHTML = '';
            },
            populateEditDateRangeOrders: function populateEditDateRangeOrders() {
                var orderListNode = document.getElementById('editDateRangeOrdersList');
                while (orderListNode.firstChild) {
                    orderListNode.removeChild(orderListNode.lastChild);
                }
                this.$root.editGetDateRangeOrders(this.reportnumber, document.querySelector('#editBeginDatepicker').value, document.querySelector('#editEndDatepicker').value);
            },
            editGetDateRangeOrdersCallback: function editGetDateRangeOrdersCallback(response) {
                var orderListNode = document.getElementById('editDateRangeOrdersList');
                let orders = response.data.orders;
                orders.forEach(function (order) {
                    let li = document.createElement('a');
                    li.setAttribute('style', 'text-align:center;');
                    li.className += "list-group-item d-flex align-items-center";
                    li.setAttribute('value', order.orderNumber);
                    orderListNode.appendChild(li);
                    li.innerHTML += order.orderNumber;
                });
            }
        }
    }
</script>
