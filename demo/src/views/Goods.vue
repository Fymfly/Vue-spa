<template>
    <div>
        商品的ID = {{id}}
    </div>
</template>


<style>


</style>


<script>
export default {
    created() {
        
        // 接收参数
        this.id = this.$route.params.id
    },
    data() {
        return {
            id:1
        }
    }
}
</script>
