<template>

  <div>

    <header class="top-header">
		  <router-link to="/" class="text texta">取消</router-link> 
		  <h3>注册</h3>
		  <router-link to="login" class="text">登录</router-link>
    </header>
    
    <div class="login">
      <form action="" method="post">
        
        <ul>
          <li>
            <img src="../assets/images/login.png"/>
            <label>账号</label>
            <input type="text" v-model="form.username" placeholder="请输入账号"/>
          </li>
          <li>
            <img src="../assets/images/password.png"/>
            <label>密码</label>
            <input type="password" v-model="form.password" placeholder="请输入密码"/>
          </li>
          <li>
            <img src="../assets/images/password.png"/>
            <label>密码</label>
            <input type="password" v-model="form.password_confirmation" placeholder="请确认密码"/>
          </li>
        </ul>
        <!-- .prevent 只触发点击事件，不提交表单 -->
        <input @click.prevent="submit" type="submit" value="立即注册"/>
      </form>
    </div>

    </div>
  
</template>


<script>
export default {
    data() {
      return {
        form:{
          username: '',
          password: '',
          password_confirmation: ''
        }
      }
    },
    methods: {
      submit() {
        this.axios.post('/members', this.form)
            .then(res=>{
              if( res.data.status_code == 200) {
                this.$router.push('/login')
              } else {

                alert('失败')
              }
            })
      }
    }
}
</script>
