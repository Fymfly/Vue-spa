import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({

  // 要管理的公共的(数据)
  state: {
    isShow: true,
    isLogin: false
  },

  // 定义修改这个数据的方法
  mutations: {
    chagneShow() {
      this.state.isShow = !this.state.isShow
    },
    setLogin(state, value) {
      state.isLogin = value
    }
  },
  actions: {

  }
})
