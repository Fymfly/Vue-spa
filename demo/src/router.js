import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',  // 路径
      name: 'home',  // 路由名字
      meta: {
        title: '首页'
      },      // 这个跌幅的辅助数据
      component: Home  // 要切换的组件
    },
    {
      path: '/about',
      name: 'about',
      meta: {
        title: '关于我们'
      },
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    },
    {
      path: '/hello',
      name: 'hello',
      meta: {
        title: '您好',
        // 这个路由必须登录才能访问
        isLogin: true
      },
      component: () => import('./views/Hello.vue'),
      children: [
        {
          path: 'tom', //    hello/tom
          name: 'hello-tom',
          meta: {
            title: 'tom子页面',
            isLogin: true
          },
          component: () => import('./views/HelloTom.vue')
        },
        {
          path: 'jack', //    hello/tom
          name: 'hello-jack',
          meta: {
            title: 'jack',
            isLogin: true
          },
          component: () => import('./views/HelloJack.vue')
        }
      ]
    },
    {
      path: '/goods/:id(\\d+)',
      name: 'goods',
      meta: {
        title: '商品详情页',
        isLogin: true
      },
      component: () => import('./views/Goods.vue')
    },
    {
      path: '/login',
      name: 'login',
      meta: {
        title: '登录页',
        isLogin: false
      },
      component: () => import('./views/Login.vue')
    }
  ]
})
