import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";

import MyHome from "./components/creator/MyHome.vue";
import MyVideo from "./components/creator/MyVideos.vue";
import MyPlaylist from "./components/creator/MyPlaylist.vue";
import MyCommunity from "./components/creator/MyCommunity.vue";
import MyChannel from "./components/creator/MyChannel.vue";
import MyAbout from "./components/creator/MyAbout.vue";
import FullVideos from "./components/creator/fullVideos/FullVideos.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: MyHome },
    { path: "/videos", component: MyVideo },
    { path: "/playlist", component: MyPlaylist },
    { path: "/community", component: MyCommunity},
    { path: "/channel", component: MyChannel},
    { path: "/about", component: MyAbout},
    { path: "/full", component: FullVideos},
  ],
});

const app = createApp(App);
app.use(router);
app.mount("#app");
