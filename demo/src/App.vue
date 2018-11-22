<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/hello">Hello</router-link> |
      <router-link to="/goods/100">商品页</router-link> |

      <template v-if="$store.state.isLogin">
        <input @click="logout" type="button" value="退出">
      </template>
      <template v-else>
        <router-link to="/login">登录</router-link> 
      </template>
      
    </div>
    <router-view/>
  </div>
</template>

<script>
export default {
  created() {
    if(localStorage.getItem('token'))
      this.$store.commit('setLogin', true)
  },
  methods:{
    logout() {
      localStorage.removeItem('token')
      this.$store.commit('setLogin', false)

      console.log( this.$store.state.isLogin)
    }
  }
}
</script>


<style>
 
a {
  border: 1px solid #f00;
}

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
