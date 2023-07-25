<!-- navigation-bar.vue -->
<!-- <template>
  <v-app-bar app color="#15202B">
    <template v-slot:prepend>
      <v-icon
        @click.stop="drawer = !drawer"
        @click.prevent="rail = !rail"
        class="ml-1 mr-6"
      >
        mdi-menu
      </v-icon>
    </template>

    <img src="../../assets/logo.png" width="35" class="mr-16 mt-2" to="/" />

    <v-container>
      <v-autocomplete
        v-model="select"
        v-model:search="search"
        :items="listVideos"
        rounded="pill"
        density="compact"
        variant="solo"
        @keydown.enter="navigateToPage"
        label="Search Videos"
        append-inner-icon="mdi-magnify"
        single-line
        hide-no-data
        hide-details
      ></v-autocomplete>
    </v-container>

    <DropDown v-if="getReady" :user="user" @logout="logout"></DropDown>

    <v-btn
      v-else
      class="mr-6 ml-8 mr-2 bg-white"
      rounded="pill"
      prepend-icon="mdi-account"
      @click.stop="loginForm = true"
    >
      Sign in
    </v-btn>
  </v-app-bar>
  <LoginForm
    v-model="loginForm"
    @show="handOver"
    @isShow="handOverIsShowLogin"
    
  />
  <RegisterForm
    v-model="registerForm"
    @show="handOver"
    @isShow="handOverIsShowRegister"
  />
  <v-navigation-drawer
    color="#15202B"
    app
    class="d-flex flex-column"
    width="75px"
    :rail="rail"
  >
    <v-list nav width="200px">
      <v-list-item
        class="mt-3 mb-3"
        v-for="item in items"
        :key="item.title"
        :to="item.to"
        :prepend-icon="item.icon"
        :title="item.title"
        :value="item.title"
      >
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
  <div class="temporary" v-if="!rail" @click="rail = !rail"></div>
</template>
<script>
import router from "@/router";
import LoginForm from "../LoginComponent.vue";
import RegisterForm from "../RegisterComponent.vue";
import DropDown from "./DropDown.vue";
export default {
  components: {
    LoginForm,
    RegisterForm,
    DropDown,
  },
  data() {
    return {
      user: {
        token: "",
        full_name: "",
        email: "",
        user_id: "",
      },
      drawer: false,
      rail: true,
      loading: false,
      listVideos: [],
      search: null,
      select: null,
      link: "",
      loginForm: false,
      registerForm: false,
      items: [
        { title: "Home", icon: "mdi-home", to: "/" },
        { title: "Upload", icon: "mdi-video-plus", to: "/upload" },
        { title: "History", icon: "mdi-history", to: "/history" },
        { title: "Message", icon: "mdi-email-outline", to: "/messages" },
        { title: "Bookmark", icon: "mdi-bookmark-outline", to: "/bookmark" },
        { title: "Playlist", icon: "mdi-playlist-play", to: "/uerPlaylist" },
        {
          title: "More",
          icon: "mdi-dots-horizontal-circle-outline",
          to: "/about",
        },
      ],
    };
  },
  watch: {
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
  },
  computed: {
    getReady() {
      if (
        this.user.token != "" &&
        this.user.full_name != "" &&
        this.user.user_id != "" &&
        this.user.email
      ) {
        return true;
      }
      return false;
    },
  },
  methods: {
    navigateToPage() {
      router.push(`/search/${this.search}`);
    },
    querySelections() {
      this.$http
        .get(`/videos/${this.select}`)
        .then((response) => {
          this.loading = true;
          // set this.videos to the response data
          this.videos = response.data.data;
          this.listVideos = this.videos.filter((e) => {
            return e.title.toLowerCase().includes(this.search.toLowerCase());
          });
          this.loading = false;
        }, 500)
        .catch((error) => {
          console.log(error.message);
        });
    },
    handOverIsShowLogin(item) {
      this.getDataFromCookies();
      this.loginForm = item;
      console.log(this.loginForm)
    },
    handOverIsShowRegister(item) {
      this.getDataFromCookies();
      this.registerForm = item;
    },
    handOver(item) {
      this.loginForm = item.login;
      this.registerForm = item.register;
    },
    handOverToken(user) {
      this.user = user;
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
    },
    logout(isLog) {
      if (isLog) {
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
            location.loading;
          }, 200)
          .catch((error) => {
            console.log(error.message);
          });
      }
    },
  },
  mounted() {
    this.getDataFromCookies();
    this.querySelections();
  },
};
</script>
<style scoped>
.my-btn {
  background: #ffffff;
}

#menu {
  cursor: pointer;
}

.temporary {
  background-color: rgba(0, 0, 0, 0.815);
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  z-index: 100;
  position: fixed;
  overflow-y: auto;
}

.v-navigation-drawer {
  overflow-y: hidden;
}
.v-list-item {
  font-size: 22px;
  color: white;
  background-color: none;
}
.v-icon {
  font-size: xx-large;
  color: white;
}
</style> -->
<template>
  <v-app>
    <v-app-bar app theme="dark">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <!-- <v-toolbar-title>ADMIN</v-toolbar-title> -->
      <v-spacer></v-spacer>
      <v-text-field
        class="w-50"
        density="compact"
        variant="solo"
        label="Search here"
        append-inner-icon="mdi-magnify"
        single-line
        hide-details
        rounded="pill"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn
        v-if="user.token == ''"
        class="mr-6 ml-8 mr-2 bg-white"
        rounded="pill"
        prepend-icon="mdi-account"
        @click="loginForm = true"
      >
        Sign in
      </v-btn>
      <v-btn class="text-none" to="/notifications" icon v-if="user.token != ''">
        <v-badge content="2" color="error">
          <v-icon>mdi-bell-outline</v-icon>
        </v-badge>
      </v-btn>

      <v-menu
        v-if="user.token != ''"
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
              image="https://image.lexica.art/full_jpg/19f280a2-2b97-4be2-b782-1fd5c70b84f4"
              size="40"
            ></v-avatar>
            <v-item-title> Hirito </v-item-title>
          </v-list-item>
          <v-divider :thickness="3"></v-divider>
          <v-list-item>
            <v-list-item
              :prepend-icon="profiles[0].icon"
              :title="profiles[0].title"
              :value="profiles[0].title"
              :to="profiles[0].to"
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
            ></v-list-item>
            <v-list-item
              :prepend-icon="profiles[4].icon"
              :title="profiles[4].title"
              :value="profiles[4].title"
              @click="logout"
            ></v-list-item>
            <v-divider :thickness="1"></v-divider>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-navigation-drawer app theme="dark" v-model="drawer" width="200">
      <v-list>
        <v-list-item-group>
          <v-list-item
            v-for="icon of icons"
            :key="icon.title"
            class="ml-2"
            @click="drawer = !drawer"
            :prepend-icon="icon.icon"
            :title="icon.title"
            :to="icon.to"
          ></v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-main style="background-color: #252525; color: white"
      ><LoginForm
        v-model="loginForm"
        @show="handOver"
        @isShow="handOverIsShowLogin"
      />
      <RegisterForm
        v-model="registerForm"
        @show="handOver"
        @isShow="handOverIsShowRegister"
      />
      <router-view
        style="background-color: #252525; color: white"
      ></router-view>
    </v-main>
  </v-app>
</template>
<script>
// import router from "@/router";
import LoginForm from "../LoginComponent.vue";
import RegisterForm from "../RegisterComponent.vue";
export default {
  components: { LoginForm, RegisterForm },
  data() {
    return {
      user: {
        token: "",
        full_name: "",
        email: "",
        user_id: "",
      },
      drawer: false,
      profiles: [
        { title: "Your Channel", icon: "mdi-laptop-account", to: "/cover-user" },
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
        { title: "Upload", icon: "mdi-video-plus", to: "/upload" },
        { title: "History", icon: "mdi-history", to: "/history" },
        { title: "Message", icon: "mdi-email-outline", to: "/messages" },
        { title: "Bookmark", icon: "mdi-bookmark-outline", to: "/bookmark" },
        { title: "Playlist", icon: "mdi-playlist-play", to: "/uerPlaylist" },
        {
          title: "More",
          icon: "mdi-dots-horizontal-circle-outline",
          to: "/about",
        },
      ],
      loginForm: false,
      registerForm: false,
    };
  },
  watch: {
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
  },
  computed: {
    getReady() {
      if (
        this.user.token != "" &&
        this.user.full_name != "" &&
        this.user.user_id != "" &&
        this.user.email
      ) {
        return true;
      }
      return false;
    },
  },
  methods: {
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
            location.loading;
          }, 200)
          .catch((error) => {
            console.log(error.message);
          });
    },
    querySelections() {
      this.$http
        .get(`/videos/${this.select}`)
        .then((response) => {
          this.loading = true;
          // set this.videos to the response data
          this.videos = response.data.data;
          this.listVideos = this.videos.filter((e) => {
            return e.title.toLowerCase().includes(this.search.toLowerCase());
          });
          this.loading = false;
        }, 500)
        .catch((error) => {
          console.log(error.message);
        });
    },
    handOverIsShowLogin(item) {
      this.getDataFromCookies();
      this.loginForm = item;
      console.log(this.loginForm);
    },
    handOverIsShowRegister(item) {
      this.getDataFromCookies();
      this.registerForm = item;
    },
    handOver(item) {
      this.loginForm = item.login;
      this.registerForm = item.register;
    },
    handOverToken(user) {
      this.user = user;
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
    },
  },
  mounted() {
    this.getDataFromCookies();
    this.querySelections();
  },
};
</script>
