import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

// Vuetify domain =================================================
import "@mdi/font/css/materialdesignicons.css";
// vue-plyr
// import VuePlyr from "vue-plyr";
// import "vue-plyr/dist/vue-plyr.css";

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
import NavBar from "./components/Nav/NavigationBar.vue";
import SideBar from "./components/Nav/SideBar.vue";
app.component("navigation-bar", NavBar);
app.component("side-bar", SideBar);
app.use(vuetify).use(router).mount("#app");
