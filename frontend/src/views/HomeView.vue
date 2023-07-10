<template>
    <v-card color="#1b242e">
      <v-row  class="d-flex justify-center w-100 mt-16 ma-5 pa-2">
        <video-card color="#1b242e"
          v-for="(video, index) of videos"
          :key="index"
          :video="video"
          class="ma-1"
        />
      </v-row>
    </v-card>
  </template>
  <script>
  import VideoCard from "..//components/card/VideoCard.vue";
  import axios from "axios";
  export default {
    components: {
      VideoCard,
    },
    data() {
      return {
        videos: [],
      };
    },
    mounted() {
      axios
        .get("http://172.16.1.106:8000/api/videos")
        .then((response) => {
          this.videos = response.data.data;
  
          console.log(this.videos);
        })
        .catch((error) => (this.error = error));
    },
  };
  </script>
  <style scoped></style>
  
