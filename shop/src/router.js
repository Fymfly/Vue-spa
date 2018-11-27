import Vue from 'vue'
import Router from 'vue-router'
import Index from './views/Index.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: Index,
      children: [
        // 首页
        {
          path: '',
          name: 'index',
          component: () => import('./views/Index/Index.vue')
        },
        // 分类
        {
          path: 'category',
          name: 'category',
          component: () => import('./views/Index/Category.vue')
        },
        // 购物车
        {
          path: 'cart',
          name: 'cart',
          component: () => import('./views/Index/Cart.vue')
        },
        ,
        // 个人中心
        {
          path: 'profile',
          name: 'profile',
          component: () => import('./views/Index/Profile.vue')
        },
      ]
    },
    {
      path: '/regist',
      name: 'regist',
      component: () => import('./views/Regist.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/Login.vue')
    },

  ]
})