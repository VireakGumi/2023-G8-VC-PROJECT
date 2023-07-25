import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import VueCookies from 'vue-cookies'
import http from './axios-http.js';
// Vuetify domain =================================================
import "@mdi/font/css/materialdesignicons.css";
// vue-plyr
import VuePlyr from 'vue-plyr';
import 'vue-plyr/dist/vue-plyr.css';

// icon
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiCog } from '@mdi/js'

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import "vuetify/dist/vuetify.min.css";

const vuetify = createVuetify({
  
  iconfont: "mdi",
  components,
  directives,
});
// components domain ==============================================

const app = createApp(App);
app.config.globalProperties.$http = http;
import NavBar from "./components/Nav/NavigationBar.vue";
app.component("navigation-bar", NavBar);
app.use(vuetify).use(router).use(VuePlyr).use(VueCookies).use(SvgIcon).use(mdiCog).mount("#app");
