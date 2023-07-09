<template>
  <v-layout>
    <v-app-bar app color="#15202B">
      <template v-slot:prepend>
        <img
          src="../../assets/menu.png"
          @click.stop="drawer = !drawer"
          class="ml-4 mr-6"
          width="35"
          alt=""
        />
      </template>
      <v-app-bar-logo>
        <img src="../../assets/logo.png" width="35" class="mr-16 mt-2" />
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
      >
        Sign in
      </v-btn>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      :width="190"
      temporary
      dark
      color="#15202B"
      class="sidebar-drawer"
    >
      <v-list>
        <v-list-item v-for="item in items" :key="item.title" link>
          <v-list-item-icon class="d-flex">
            <v-list-item-icon>
              <v-icon class="ms-2" color="white" x-large>{{
                item.icon
              }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="text-white ml-9">{{
                item.title
              }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item-icon>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-navigation-drawer
      color="#15202B"
      app
      class="d-flex flex-column"
      width="75px"
    >
      <v-list-item v-for="item in items" :key="item.title" link>
        <v-list-item-icon class="d-flex">
          <v-list-item-icon>
            <v-icon class="ma-2" color="white" x-large>{{ item.icon }}</v-icon>
          </v-list-item-icon>
        </v-list-item-icon>
      </v-list-item>
    </v-navigation-drawer>

    <v-row class="bg-purple-lighten-2">
      <side-bar />
    </v-row>
  </v-layout>
</template>
<script>
import axios from "axios";
import router from '@/router';
export default {
  data() {
    return {
      drawer: false,
      loading: false,
      listVideos: [],
      search: null,
      select: null,
      link: "",
      items: [
        { title: "Home", icon: "mdi-home" },
        { title: "Upload", icon: "mdi-video-plus" },
        { title: "History", icon: "mdi-history" },
        { title: "Message", icon: "mdi-email-outline" },
        { title: "Bookmark", icon: "mdi-bookmark-outline" },
        { title: "Playlist", icon: "mdi-playlist-play" },
        { title: "More", icon: "mdi-dots-horizontal-circle-outline" },
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
      router.push("/search");
    },
    querySelections() {
      axios
        .get(`http://127.0.0.1:8000/api/videos/${this.search}`)
        .then((response) => {
          this.loading = true;
          // set this.videos to the response data
          this.videos = response.data;
          this.listVideos = this.videos.filter((e) => {
            return e.title.toLowerCase().includes(this.search.toLowerCase());
          });
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
</style>
