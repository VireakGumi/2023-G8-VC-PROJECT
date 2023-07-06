import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
// vue-plyr
import VuePlyr from "vue-plyr";
import "vue-plyr/dist/vue-plyr.css";

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const vuetify = createVuetify({
  components,
  directives,
});
createApp(App).use(VuePlyr).use(vuetify).use(router).mount("#app");
