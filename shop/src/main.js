import Vue from 'vue'

import App from './App.vue'
import router from './router'
import store from './store'

import axios from 'axios'
import VueAxios from 'vue-axios'

import 'we-vue/lib/style.css'

import { Swipe, SwipeItem } from 'we-vue'

Vue.use(Swipe).use(SwipeItem)

// 注册导航守卫（没次加载一个页面就会被自动被执行）
router.beforeEach((to, form, next) => {
  
  if(to.meta.needLogin) {

    let ACCESS_TOKEN = localStorage.getItem('ACCESS_TOKEN')
    if(ACCESS_TOKEN) 
      next()
    else 

      // 重定向到登录页面
      next('/login')
  }
  else 
    // 直接加载页面
    next()
})

Vue.prototype.axios = axios
Vue.use(VueAxios, axios)


// 先统一设置接口的基础地址
Vue.axios.defaults.baseURL = 'http://127.0.0.1:8001/api'


Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')