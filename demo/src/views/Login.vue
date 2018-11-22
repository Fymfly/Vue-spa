<template>
    <div>
        <input type="text" v-model="username">
        <input type="password" v-model="password">
        <input @click="login" type="button" value="登录">
    </div>
</template>


<script>
export default {
    data() {
        return {
            username: '',
            password: ''
        }
    },
    methods: {
        login() {
            if(this.username = 'abc' && this.password == 'abc') {
                localStorage.setItem('token','sdagsdgasdgw234srdgsdg')
                
                // 修改登录状态
                this.$store.commit('setLogin', true)

                // 跳转到首页
                this.$router.push('/')
            }
        }
    }
}
</script>


<style>

</style>
