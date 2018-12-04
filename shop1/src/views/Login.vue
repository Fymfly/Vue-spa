<template>
    <div>

        <header class="top-header">
            <router-link to="/" class="text texta">取消</router-link> 
            <h3>登录</h3>
            <router-link to="regist" class="text">注册</router-link>
        </header>
        
        <div class="login">
            <form>
                <ul>
                    <li>
                        <img src="../assets/images/login.png"/>
                        <label>账号</label>
                        <input type="text" v-model="username" placeholder="请输入账号"/>
                    </li>
                    <li>
                        <img src="../assets/images/password.png"/>
                        <label>密码</label>
                        <input type="password" v-model="password" placeholder="请输入密码"/>
                    </li>
                </ul>
                <input @click.prevent="login" type="submit" value="登录"/>
            </form>
        </div>

    </div>
</template>

<script>

// 登录成功
import { Dialog } from 'we-vue'

// 登录失败
import { Toast } from 'we-vue'

export default {
    data() {
        return {
            username: '',
            password: ''
        }
    },
    methods: {
        login() {
            this.axios.post('/authorizations', {
                username:this.username,
                password:this.password
            }).then(res=>{
                if(res.data.status_code == 200) {
                     Dialog({
                        message: '让您久等了！',
                        skin: 'ios'
                    }).then(()=>{
                        
                        localStorage.setItem('ACCESS_TOKEN', res.data.data.ACCESS_TOKEN)
                        // 跳转到首页
                        this.$router.push('/')
                    })
                } else if(res.data.status_code == 400) {

                    Toast.fail({
                        duration: 2000,
                        message: '密码错误'
                    })
                } else if(res.data.status_code == 422) {

                    Toast.fail({
                        duration: 2000,
                        message: '用户名、密码格式不正确'
                    })
                } else if(res.data.status_code == 404) {

                    Toast.fail({
                        duration: 2000,
                        message: '账号不存在'
                    })
                }
            }) 
        }
    }
}
</script>

