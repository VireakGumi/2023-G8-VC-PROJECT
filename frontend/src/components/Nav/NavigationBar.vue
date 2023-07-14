<!-- navigation-bar.vue -->
<template>
  <v-app-bar app color="#15202B">
    <template v-slot:prepend>
      <img src="../../assets/menu.png" @click.stop="drawer" @click="rail = !rail" class="ml-4 mr-6" width="35" alt=""
        id="menu" />
    </template>
    <v-app-bar-logo>
      <img src="../../assets/logo.png" width="35" class="mr-16 mt-2" to="/" />
    </v-app-bar-logo>
    <v-container>
      <v-autocomplete v-model="select" v-model:search="search" :items="listVideos" rounded="pill" density="compact"
        variant="solo" @keydown.enter="navigateToPage" label="Search Videos" append-inner-icon="mdi-magnify" single-line
        hide-no-data hide-details></v-autocomplete>
    </v-container>

    <DropDown v-if="getReady" :user="user" @logout="logout"></DropDown>

    <v-btn v-else class="mr-6 ml-8 mr-2 bg-white" rounded="pill" prepend-icon="mdi-account"
      @click.stop="loginForm = true">
      Sign in
    </v-btn>
  </v-app-bar>
  <LoginForm v-model="loginForm" @show="handOver" @isShow="handOverIsShowLogin" />
  <RegisterForm v-model="registerForm" @show="handOver" @isShow="handOverIsShowRegister" />
  <v-navigation-drawer color="#15202B" app class="d-flex flex-column" width="75px" :rail="rail">
    <v-list density="compact" nav width="180px">
      <v-list-item v-for="item in items" :key="item.title" :to="item.to">
        <v-list-item style="color: white" :prepend-icon="item.icon" :title="item.title" :value="item.title"></v-list-item>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
  <div class="temporary" v-if="!rail" @click="rail = !rail"></div>
</template>
<script>
import axios from "axios";
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
      listVideos: "",
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
        { title: "More", icon: "mdi-dots-horizontal-circle-outline", to: "/about" },
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
      console.log(this.user);
      if (this.user.token != "" && this.user.full_name != "" && this.user.user_id != "" && this.user.email) {
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
      axios
        .get(`http://172.16.1.106:8000/api/videos/${this.select}`)
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
        axios
          .post(`http://172.16.1.106:8000/api/logout`, null, {
            headers: { Authorization: `Bearer ${this.user.token}` },
          })
          .then((response) => {
            this.deleteCookie();
            this.user = {
              token: "",
              full_name: "",
              email: "",
              user_id: "",
            }
            console.log(response.data);
            console.log(this.user);
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
</style>