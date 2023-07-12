import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import SearchPage from "../views/SearchPage.vue";
import CoverPage from "../views/ProfilePage/CoverPage.vue";
import FullVideos from "../components/creator/fullVideos/FullVideos.vue";

const routes = [
  { path: "/cover-user", 
  name: "cover-user",
  component: CoverPage
 },

  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/full",
    name: "full-videos",
    component: FullVideos,
  },
  // {
  //   path: "/about",
  //   name: "about",
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () =>
  //     import(/* webpackChunkName: "about" */ "../views/AboutView.vue"),
  // },
  {
    path: "/search",
    name: "search",
    component: SearchPage,
  },
  {
    path: "/register",
    name: "register",
    component: () =>
    import("../views/Register.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
