import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import App from '~/components/App'
import i18n from '~/plugins/i18n'

import "~/plugins/i18n";
import "~/plugins/axios";
import '~/plugins/vue-bootstrap'
import '~/plugins/vue-awesome-swiper'

import '~/services/components.service';
import ApiService from '~/services/api.service';

ApiService.init('/api', {
  proxyHeaders: false,
  credentials: false
})

Vue.prototype.$axios = ApiService
Vue.config.productionTip = false

new Vue({
  i18n,
  store,
  router,
  ...App
})
