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
          component: () => import('./views/Index/Cart.vue'),
          meta: {
            needLogin :true
          }
        },
        ,
        // 个人中心
        {
          path: 'profile',
          name: 'profile',
          component: () => import('./views/Index/Profile.vue'),
          // 放辅助用的自定义数据
          meta: {
            needLogin :true
          }
        },
      ]
    },
    // 注册
    {
      path: '/regist',
      name: 'regist',
      component: () => import('./views/Regist.vue')
    },
    // 登录
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/Login.vue')
    },
    // 搜索
    {
      path: '/search',
      name: 'search',
      component: () => import('./views/Search.vue')
    },
    // 商品详情页
    {
      path: '/goods',
      name: 'goods',
      component: () => import('./views/Goods.vue')
    },
    // 去下单
    {
      path: '/buy',
      name: 'buy',
      component: () => import('./views/Buy.vue'),
      meta: {
        needLogin :true
      }
    }

  ]
})
