<template>
</template>

<script>
    export default {
        props: ['olddata', 'oldfirstmatpresent', 'secondmatnumberisvisible', 'thirdmatnumberisvisible', ],
        mounted() {
            if (this.olddata && !this.secondmatnumberisvisible) {
                let second = document.getElementById('secondMatNumber')
                second.value = ""
                second.placeholder = "1234"
                this.$root.secondMatNumberIsVisible = 0
            }
            if (this.olddata && !this.thirdmatnumberisvisible) {
                let third = document.getElementById('thirdMatNumber')
                third.value = ""
                third.placeholder = "1234"
                this.$root.thirdMatNumberIsVisible = 0
            }
            if (this.olddata && !this.oldfirstmatpresent) {
                let first = document.getElementById('firstMatNumber')
                first.value = ""
                first.placeholder = "1234"
                this.$root.firstMatPresent = 0
            }
        },
        methods: {
            testFunction: function testFunction() {
                console("test")
            },
        }
    }
</script>
