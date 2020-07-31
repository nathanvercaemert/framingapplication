<template>
</template>

<script>
    export default {
        props: ['variable0', 'variable1',],
        mounted() {
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
        },
        methods: {
            testFunction2: function testFunction2() {
                alert('test');
            }
        }
    }
</script>
