import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from '@/plugins/router'
import App from './App.vue'

import 'vuetify/styles'
import vuetify from '@/plugins/vuetify'
import '@scss/settings.scss'
import '@mdi/font/css/materialdesignicons.css'

createApp(App)
    .use(createPinia())
    .use(router)
    .use(vuetify)
    .mount('#app')
