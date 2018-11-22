import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

// 为路由绑定一个跳转时的钩子函数
router.beforeEach((to, from, next) => {

  // 将要跳转到的那个路由是否需要登录
  if( to.meta.isLogin ) {

    // 判断有没有登录
    if( localStorage.getItem('token') ) {

      // 先设置标题
      document.title = to.meta.title

      next()
    } else {

      // 没有登录跳到首页
      next('/login')
    }
  } else {

    // 先设置标题
    document.title = to.meta.title

    // 直接跳转
    next()
  }

  // next(false)
})


Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
