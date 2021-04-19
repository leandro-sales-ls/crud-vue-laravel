import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import '@babel/polyfill'
import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'

Vue.config.productionTip = false

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')

Vue.use(VueToast)