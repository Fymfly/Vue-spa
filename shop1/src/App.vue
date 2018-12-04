<template>
  <!-- 加载子视图 -->
  <router-view></router-view>
</template>

<style>
  /* 引入全局样式 */
  @import './assets/base.css';
  @import './assets/style.css';
</style>

<script>
export default {
  created() {
    this.axios.get('http://127.0.0.1:8001/api/goods')
      .then((res)=>{
        // console.log( res.data )
      }).catch((err)=>{
        // console.log( err.response )
      })
  }
}
</script>
