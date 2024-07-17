import { createApp } from 'vue'

import store from '@/store'

import App from './App.vue'

import '@/assets/main.css'

import '@flaticon/flaticon-uicons/css/all/all.css'

import router from './router'

import keyframes from './assets/animations/keyframes'
import animations from './assets/animations/animations'

console.log({keyframes, animation: animations})

const app = createApp(App)

app.use(router)
app.use(store)

app.mount('#app')
