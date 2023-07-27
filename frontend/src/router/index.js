import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import SearchPage from "../views/SearchPage.vue";
import CoverPage from "../views/ProfilePage/CoverPage.vue";
import FullVideos from "../components/creator/fullVideos/FullVideos.vue";
import ContentCreatorPage from "../components/creator/contentCreatorPage/ContentCreatorPage.vue";
import AdminUser from "../views/AdminUser.vue";
import AdminVideo from "../views/AdminVideo.vue";
function requireAuth(to, from, next) {
  const userRole = this.$cookie.get('user_role');
  if (userRole) {
    const { permission } = to.meta;
    switch (permission) {
      case 'user':
        if (userRole === 'user') {
          next();
        } else {
          next('/cafes');
        }
        break;
      case 'admin':
        if (userRole === 'admin') {
          next();
        } else {
          next('/cafes');
        }
        break;
      default:
        next('/cafes');
    }
  } else {
    next('/cafes');
  }
}
const routes = [
  {
    path: "/video",
    name: "video",
    component: AdminVideo
  },
  {
    path: "/user",
    name: "user",
    component: AdminUser,
    // beforeEnter: requireAuth,
    // meta: {
    //   permission: 'admin'
    // }
  },
  
  {
    path: "/dashboard",
    name: "dashboard",
    component: () => import("../views/AdminView.vue"),
    // beforeEnter: requireAuth,
    // meta: {
    //   permission: 'admin'
    // }
  },
  {
    path: "/cover-user",
    name: "cover-user",
    component: CoverPage,
    
  },
  {
    path: "/creator",
    name: "content-creator",
    component: ContentCreatorPage
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
    path: "/uerPlaylist",
    name: "uerPlaylist",
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
      permission: 'admin'
    }
  },
];

document.title = "Child_Realm";

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});


export default router;
