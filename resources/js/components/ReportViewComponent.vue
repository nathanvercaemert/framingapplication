<template>
    <div>
        <div class="row">
            <div class="col w-50 text-right">
                <h5>Date Created:</h5>
            </div>
            <div class="col w-50 text-left">
                <a>{{createdate}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col w-50 text-right">
                <h5>Report Type:</h5>
            </div>
            <div class="col w-50 text-left">
                <a>{{reporttype}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col w-50 text-right">
                <h5>Orders:</h5>
            </div>
            <div class="col w-50 text-left">
                <button type="button" class="btn btn-primary" v-on:click="populateReportOrdersListGroup" data-toggle="modal" data-target="#reportOrderListModal" style="width:100%">View Orders</button>
            </div>
        </div>
        <div :hidden="this.$root.viewIsDateRange == 0" class="row">
            <div class="col w-50 text-right">
                <h5>Date Range Start:</h5>
            </div>
            <div class="col w-50 text-left">
                <a>{{daterangestart}}</a>
            </div>
        </div>
        <div :hidden="this.$root.viewIsDateRange == 0" class="row">
            <div class="col w-50 text-right">
                <h5>Date Range End:</h5>
            </div>
            <div class="col w-50 text-left">
                <a id="viewDateRangeEnd" name="viewDateRangeEnd"></a>
            </div>
        </div>
        <div class="row">
            <div class="col w-50 text-right">
                <h5>Notes:</h5>
            </div>
            <div class="col w-50 text-left">
                <a>{{reportnotes}}</a>
            </div>
        </div>
        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col">Vendor</th>
                <th scope="col">Material</th>
                <th scope="col">Identifier</th>
                <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody name="reportTable" id="reportTable">
                <!-- @foreach(json_decode(vendors) as $vendor=>$materialTypes)
                    <tr>
                        <th scope="row">{{$vendor}}</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($materialTypes as $materialType=>$materials)
                        <tr>
                            <th scope="row"></th>
                            <td>{{ucfirst($materialType)}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach($materials as $material=>$quantity)
                            <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td>{{ strlen($material) > 9 && substr($material, 0, 9) === "matNumber" || strlen($material) > 14 && substr($material, 0, 14) === "mouldingNumber" ? strlen($material) > 14 ? substr($material, 14) : substr($material, 9) : $material}}</td>
                                <td class="border">{{$quantity}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach -->
            </tbody>
        </table>
        <p >
            <button :disabled="reportisprocessed == 1" type="button" class="btn btn-primary text-white" role="button" data-toggle="modal" data-target="#processReport" style="width:100%">Process Report</button>
        </p>
        <p>
            <a class="btn btn-primary text-white" role="button" style="width:100%" name="editButton" id="editButton">Edit Report</a>
        </p>
        <a href="/reports" class="btn btn-primary text-white" role="button" style="width:100%">Return</a>
    </div>
</template>

<script>
    export default {
        props: [
            'reportorders',
            'isdaterange',
            'daterangeend',
            'reportordersnonid',
            'reportviewid',

            'createdate',
            'reporttype',
            'daterangestart',
            'reportnotes',
            'reportisprocessed',

            'vendors',
        ],
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
            var editButtonLink = "/reports/edit/".concat(this.reportviewid);
            document.getElementById('editButton').setAttribute('href', editButtonLink);
            this.loadTable(this.vendors);
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
            loadTable: function loadTable(json) {
                var vendors = JSON.parse(json);
            }
        }
    }
</script>
