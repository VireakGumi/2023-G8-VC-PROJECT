import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import SearchPage from "../views/SearchPage.vue";
import CoverPage from "../views/ProfilePage/CoverPage.vue";
import FullVideos from "../components/creator/fullVideos/FullVideos.vue";
import ContentCreatorPage from "../components/creator/contentCreatorPage/ContentCreatorPage.vue";
function requireAuth(to, from, next) {
  const cookies = document.cookie.split('; ');
  let userRole = null;
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].split('=');
    if (cookie[0] === 'user_role') {
      userRole = cookie[1];
      break;
    }
  }
  if (userRole) {
    const { permission } = to.meta;
    switch (permission) {
      case 'admin':
        if (userRole === 'admin') {
          if (to.name === 'dashboard' || to.name === 'report' || to.name=== 'video' || to.name==='user-list') {
            next();
          } else {
            next('/user');
          }
        } else {
          next('/404');
        }
        break;
      default:
        next('/');
    }
  } else {
    next('/');
  }
}
const routes = [
  {
    path: "/user-list",
    name: "user-list",
    component: () => import("../views/AdminUser.vue"),
    beforeEnter: requireAuth,
    meta: {
      permission: 'admin',
    },
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: () => import("../views/AdminView.vue"),
  },
  {
    path: "/cover-user",
    name: "cover-user",
    component: CoverPage,

  },
  {
    path: "/creator",
    name: "content-creator",
    component: ContentCreatorPage,
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
  {
    path: "/search/:title",
    name: "search",
    component: SearchPage,
  },
  {
    path: "/history",
    name: "history",
    component: () => import("../views/HistoryView.vue"),
  },
  {
    path: "/userPlaylist",
    name: "userPlaylist",
    component: () => import("../views/UserPlaylists.vue"),
  },
  {
    path: "/upload",
    name: "upload",
    component: () => import("../views/UploadVideoView.vue"),
  },
  {
    path: "/report",
    name: "report",
    component: () => import("../views/ReportPage.vue"),
    beforeEnter: requireAuth,
    meta: {
      permission: 'admin',
    },
  },
  {
    path: "/viewPlaylist/:id",
    name: "viewPlaylist",
    component: () => import("../views/PlayList.vue"),
  },
  {
    path: "/videodetail/:id",
    name: "videodetail",
    component: () => import("../views/VideoDetail.vue"),
  },
  {
    path: "/404",
    name: "not-found",
    component: () => import("../views/404View.vue"),
    pathMatch: 'full',
  },
  {
    path: "/:catchAll(.*)",
    redirect: "/404",
  }
];

document.title = "Child_Realm";

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
