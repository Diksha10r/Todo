import VueSessionStorage from 'vue-sessionstorage'
Vue.use(VueSessionStorage)

import { createApp } from 'vue'
import App from './App.vue'
import './index.css'

createApp(App).mount('#app')