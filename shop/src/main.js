import Vue from 'vue'

import App from './App.vue'
import router from './router'
import store from './store'

import axios from 'axios'
import VueAxios from 'vue-axios'

import 'we-vue/lib/style.css'

import '@/assets/base.css';
import '@/assets/style.css';

import { Swipe, SwipeItem, Loadmore, InfiniteScroll, NumberSpinner   } from 'we-vue'

Vue.use(NumberSpinner)
Vue.use(InfiniteScroll)
Vue.use(Loadmore)
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

// 为 axios 添加一个拦截器
Vue.axios.interceptors.request.use(function (config) {
  // 在发送请求之前自动执行
  let token = localStorage.getItem('ACCESS_TOKEN')
  if(token)
  {
    config.headers['Authorization'] = "Bearer "+token
  }
  return config;
}, function (error) {
  // Do something with request error
  return Promise.reject(error);
});

// 先统一设置接口的基础地址
Vue.axios.defaults.baseURL = 'http://127.0.0.1:8001/api'


Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')