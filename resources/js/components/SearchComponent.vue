<template>
    <div>
        <div class="form-row text-right mb-2">
            <label class="col w-50 col-form-label" for="customerEmail">Email</label>
            <div class="col w-50">
                <input type="text" class="form-control" name="customerEmail" id="customerEmail" placeholder="johndoe@gmail.com">
            </div>
        </div>
        <div class="form-row text-right mb-2">
            <label class="col w-50 col-form-label" for="customerPhoneArea">Phone</label>
            <div class="col w-50">
                <div class="row" style="margin: auto">
                    <div style="width:30%">
                        <input type="text" class="form-control" name="customerPhoneArea" id="customerPhoneArea" placeholder="123">
                    </div>
                    <div style="width:30%">
                        <input type="text" class="form-control" name="customerPhone3" id="customerPhone3" placeholder="456">
                    </div>
                    <div style="width:40%">
                        <input type="text" class="form-control" name="customerPhone4" id="customerPhone4" placeholder="7890">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" v-on:click="searchSubmitFunction" style="width:100%">Search</button>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Order Number</th>
                <th scope="col">Created</th>
                <th scope="col">Completed</th>
                <th scope="col">View</th>
                </tr>
            </thead>
            <tbody id="table">
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: [],
        mounted() {
            // this.$root.resetSearch()
        },
        methods: {
            searchSubmitFunction: function searchSubmitFunction() {
                let customerEmail = document.getElementById('customerEmail').value
                let customerPhoneArea = document.getElementById('customerPhoneArea').value
                let customerPhone3 = document.getElementById('customerPhone3').value
                let customerPhone4 = document.getElementById('customerPhone4').value
                this.$root.searchSubmitFunction(customerEmail, customerPhoneArea, customerPhone3, customerPhone4)
            },
            searchSubmitFunctionCallback: function searchSubmitFunctionCallback(response) {
                response.data.forEach(this.loadOrder)
            },
            loadOrder: function loadOrder(order) {
                var table = document.getElementById('table');
                while (table.firstChild) {
                    table.removeChild(table.lastChild);
                }
                let row = document.createElement('tr');
                let header = document.createElement('th');
                header.scope = "row";
                header.innerHTML += order.orderNumber;
                row.appendChild(header);
                let created = document.createElement('td');
                created.innerHTML += order.created_at.substring(0,10);
                row.appendChild(created);
                let completed = document.createElement('td');
                completed.innerHTML += order.completed_at.substring(0,10);
                row.appendChild(completed)
                let view = document.createElement('td');
                let viewLink = document.createElement('a');
                viewLink.href = "/orders/view/" + order.id;
                viewLink.class = "btn btn-primary";
                viewLink.role = "button";
                viewLink.style = "width:100%";
                viewLink.innerHTML += "View";
                view.appendChild(viewLink);
                row.appendChild(view);
                table.appendChild(row)
            }
        }
    }
</script>
