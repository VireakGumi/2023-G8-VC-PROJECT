import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// Icons 
import "@mdi/font/css/materialdesignicons.css";
import "@fortawesome/fontawesome-free/css/all.css";
// import icons 
import { mdi } from 'vuetify/iconsets/mdi'
import { aliases, fa } from 'vuetify/iconsets/fa'

// import Register from './views/Register.vue'
import RegisterComponent from './components/RegisterComponent.vue'
import LoginComponent from './components/LoginComponent.vue'

// Create the router instance
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/register', component: RegisterComponent},
    { path: '/login', component: LoginComponent}
  ]
})

// Create the Vuetify instance
const vuetify = createVuetify({
  components,
  directives,
  icons:{
    defaultSet:'mdi',
    aliases,
    sets:{
        fa,
        mdi,
    }
},
})

// Create the Vue app instance
const app = createApp(App)

// Mount the app and router
app.use(router).use(vuetify).mount('#app')
