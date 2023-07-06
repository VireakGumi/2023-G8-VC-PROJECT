import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Vuetify domain =================================================
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
const vuetify = createVuetify({
  iconfont: "mdi",
  components,
  directives,
});
// components domain ==============================================

const app = createApp(App);

import NavBar from "./components/Nav/NavigationBar.vue";
import SideBar from "./components/Nav/SideBar.vue";
app.component("navigation-bar", NavBar);
app.component("side-bar", SideBar);
app.use(vuetify);
app.use(router).mount("#app");
