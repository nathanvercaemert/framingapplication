<template>
</template>

<script>
    export default {
        props: ['oldsecondmatnumber', 'oldthirdmatnumber'],
        mounted() {
            this.$root.secondMatNumberIsVisible = this.oldsecondmatnumber;
            this.$root.thirdMatNumberIsVisible = this.oldthirdmatnumber;
        },
    }
</script>
