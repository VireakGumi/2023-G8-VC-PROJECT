import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
<<<<<<< HEAD

// Vuetify domain =================================================
import "@mdi/font/css/materialdesignicons.css";
=======
// vue-plyr
import VuePlyr from "vue-plyr";
import "vue-plyr/dist/vue-plyr.css";

// Vuetify
>>>>>>> fa982bdd1d6e545ae6ed980b7401218dbe820532
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
<<<<<<< HEAD
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
=======

const vuetify = createVuetify({
  components,
  directives,
});
createApp(App).use(VuePlyr).use(vuetify).use(router).mount("#app");
>>>>>>> fa982bdd1d6e545ae6ed980b7401218dbe820532
