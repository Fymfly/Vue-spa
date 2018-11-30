import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'

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