<!-- navigation-bar.vue -->
<template>
  <v-app-bar app color="#15202B">
    <template v-slot:prepend>
      <img
        src="../../assets/menu.png"
        @click.stop="drawer"
        @click="rail = !rail"
        class="ml-4 mr-6"
        width="35"
        alt=""
        id="menu"
      />
    </template>
    <v-app-bar-logo>
      <img src="../../assets/logo.png" width="35" class="mr-16 mt-2" to="/"/>
    </v-app-bar-logo>
    <v-container>
      <v-autocomplete
        v-model="select"
        v-model:search="search"
        :loading="loading"
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
    <v-btn
      class="my-btn mr-6 ml-8 mr-2"
      prepend-icon="account"
      rounded="pill"
    ></v-btn>

    <v-btn
      class="mr-6 ml-8 mr-2 bg-white"
      rounded="pill"
      prepend-icon="mdi-account"
      @click.stop="loginForm = true"
    >
      Sign in
    </v-btn>
  </v-app-bar>
  <LoginForm v-model="loginForm" />
  <v-navigation-drawer

    color="#15202B"
    app
    class="d-flex flex-column"
    width="75px"
    :rail="rail"
  >
    <v-list density="compact" nav width="180px">
      <v-list-item v-for="item in items" :key="item.title" :to="item.to">
        <v-list-item
          style="color: white"
          :prepend-icon="item.icon"
          :title="item.title"
          :value="item.title"
        ></v-list-item>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
  <div class="temporary" v-if="!rail" @click="rail=!rail"></div>
</template>
<script>
import axios from "axios";
import router from "@/router";
import LoginForm from "../LoginComponent.vue";
export default {
  components: {
    LoginForm,
  },
  data() {
    return {
      drawer: false,
      rail: true,
      loading: false,
      listVideos: "",
      search: null,
      select: null,
      link: "",
      loginForm: false,
      items: [
        { title: "Home", icon: "mdi-home", to: "/" },
        { title: "Upload", icon: "mdi-video-plus", to: "/upload" },
        { title: "History", icon: "mdi-history", to: "/history" },
        { title: "Message", icon: "mdi-email-outline", to: "/messages" },
        { title: "Bookmark", icon: "mdi-bookmark-outline", to: "/bookmark" },
        { title: "Playlist", icon: "mdi-playlist-play", to: "playlist" },
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
          console.log(1);
          this.loading = false;
        }, 500)
        .catch((error) => {
          console.log(error.message);
        });
    },
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