<template>
</template>

<script>
    export default {
        props: ['oldsecondmatnumber', 'oldthirdmatnumber', 'oldisframe'],
        mounted() {
            this.$root.secondMatNumberIsVisible = this.oldsecondmatnumber;
            this.$root.thirdMatNumberIsVisible = this.oldthirdmatnumber;
            this.$root.isFrame = this.oldisframe;
        },
        methods: {
            removeFirstMat: function removeFirstMat() {
            document.querySelector('#firstMatNumber').value = null;
            }
        }
    }
</script>
