<template>
  <v-app class="mb-4">
    <v-app-bar app theme="dark">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>ADMIN</v-toolbar-title>
      <router-link to="/" width="100" height="100"
        ><img
          src="../../assets/my-logo.png"
          width="100"
          height="100"
          style="border-radius: 25px; margin-top: 10px"
          alt=""
      /></router-link>
      <v-spacer></v-spacer>
      <v-text-field
        class="w-50"
        :item="filteredVideos"
        density="compact"
        variant="solo"
        label="Search here"
        append-inner-icon="mdi-magnify"
        v-model="searchQuery"
        @keyup.enter="searchVideos"
        single-line
        hide-details
        rounded="pill"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn class="text-none" @click="dialog = !dialog" icon>
        <v-badge :content="notifications.length" color="error">
          <v-icon>mdi-bell-outline</v-icon>
        </v-badge>
        <notification-dialog v-if="dialog"></notification-dialog>
      </v-btn>

      <v-menu
        transition="slide-x-transition"
        bottom
        right
        :open-on-click="true"
      >
        <template v-slot:activator="{ props }">
          <v-btn v-bind="props" icon>
            <v-icon size="x-large">mdi-account</v-icon>
          </v-btn>
        </template>

        <v-list width="300px">
          <v-list-item>
            <v-avatar
              class="mr-5"
              :image="profilePictureUrl"
              size="40"
            ></v-avatar>
            <v-item-title>{{ user.full_name }} </v-item-title>
          </v-list-item>
          <v-divider :thickness="3"></v-divider>

          <v-list-item
            :prepend-icon="profiles[0].icon"
            :title="profiles[0].title"
            :value="profiles[0].title"
          ></v-list-item>
          <v-list-item
            :prepend-icon="profiles[1].icon"
            :title="profiles[1].title"
            :value="profiles[1].title"
          ></v-list-item>
          <v-list-item
            :prepend-icon="profiles[2].icon"
            :title="profiles[2].title"
            :value="profiles[2].title"
          ></v-list-item>
          <v-list-item
            :prepend-icon="profiles[3].icon"
            :title="profiles[3].title"
            :value="profiles[3].title"
            @click="logout"
          ></v-list-item>
          <v-divider :thickness="1"></v-divider>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-navigation-drawer app theme="dark" v-model="drawer" width="200">
      <v-list>
        <v-list-item
          v-for="icon of icons"
          :key="icon.title"
          class="ml-2"
          @click="drawer = !drawer"
          :prepend-icon="icon.icon"
          :title="icon.title"
          :to="icon.to"
        >
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>
<script>
import NotificationDialog from "../Dialog/NotificationDialog.vue";
export default {
  components: {
    NotificationDialog,
  },
  data() {
    return {
      user: {
        token: "",
        full_name: "",
        email: "",
        user_id: "",
      },
      drawer: true,
      listVideos: [],
      videosAll: "",
      searchQuery: "",
      filteredVideos: [],
      dialog: false,
      profiles: [
        {
          title: "Switch Account",
          icon: "mdi-account-reactivate-outline",
          to: "",
        },
        { title: "Theme", icon: "mdi-theme-light-dark", to: "" },
        { title: "Feedback", icon: "mdi-message-alert", to: "" },
        { title: "Sign Out", icon: "mdi-login-variant" },
      ],
      icons: [
        { title: "Home", icon: "mdi-home", to: "/" },
        { title: "Board", icon: "mdi-view-dashboard", to: "/dashboard" },
        { title: "User", icon: "mdi-account", to: "/user-list" },
        { title: "Video", icon: "mdi-video", to: "/video" },
        { title: "Video Report", icon: "mdi-video-off", to: "/report" },
      ],
      profilePictureUrl: require("@/assets/users.jpg"),
      notifications: [],
    };
  },
  methods: {
    getVideos: function () {
      this.$http.get(`/allVideos`).then((response) => {
        this.listVideos = response.data;
      });
    },
    getNotifications() {
      this.$http
        .get("/notification", {
          headers: { Authorization: `Bearer ${this.user.token}` },
        })
        .then((response) => {
          this.notifications = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    logout() {
      this.$http
        .post(`/logout`, null, {
          headers: { Authorization: `Bearer ${this.user.token}` },
        })
        .then((response) => {
          this.deleteCookie();
          this.user = {
            token: "",
            full_name: "",
            email: "",
            user_id: "",
          };
          console.log(response.data);
          console.log(this.user);
          window.location.reload();
        }, 200)
        .catch((error) => {
          console.log(error.message);
        });
    },
    getDataFromCookies() {
      this.user.user_id =
        this.$cookies.get("user_id") !== "undefined" &&
        this.$cookies.get("user_id") !== null
          ? this.$cookies.get("user_id")
          : "";
      this.user.full_name =
        this.$cookies.get("full_name") !== "full_name" &&
        this.$cookies.get("full_name") !== null
          ? this.$cookies.get("full_name")
          : "";
      this.user.email =
        this.$cookies.get("email") !== "email" &&
        this.$cookies.get("email") !== null
          ? this.$cookies.get("email")
          : "";
      this.user.token =
        this.$cookies.get("token") !== "undefined" &&
        this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
    },
    deleteCookie() {
      this.$cookies.remove("user_id");
      this.$cookies.remove("full_name");
      this.$cookies.remove("email");
      this.$cookies.remove("token");
      this.$cookies.remove("user_role");
      this.$cookies.remove("channel_id");
    },
    searchVideos() {
      this.filteredVideos = [];
      const videos = this.listVideos;
      videos.forEach((video) => {
        if (
          video.title.toLowerCase().includes(this.searchQuery.toLowerCase())
        ) {
          this.filteredVideos.push(video);
        }
      });
      if (this.filteredVideos.length > 0) {
        this.$router.push({
          name: "search",
          params: {
            title: this.searchQuery,
          },
        });
      }
    },
  },
  mounted() {
    this.getVideos();
    this.$http.get(`/allVideos`).then((response) => {
      this.listVideos = response.data;
    });
  },
  created() {
    this.getDataFromCookies();
    this.getNotifications();
  },
};
</script>
<style scoped>
.v-main {
  background-color: #252525;
  color: white;
}
</style>
