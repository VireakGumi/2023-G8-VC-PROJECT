<template>
  <SlideShow />
  <v-card color="#1b242e">
    <v-row class="d-flex justify-center w-100 pt-5">
      <video-card
        :onLoad="load"
        color="#1b242e"
        v-for="(video, index) in videoList"
        :key="index"
        :video="video"
        class="ma-3"
      />
    </v-row>
  </v-card>
</template>
<script>
import axios from "axios";
import VideoCard from "../components/Cards/VideoCard.vue";
import SlideShow from "../components/SlideShow/SlideShowComponent.vue";
export default {
  components: {
    VideoCard,
    SlideShow,
  },
  data() {
    return {
      videos: [],
      videoList: [],
    };
  },
  methods: {
    getVideoFromAPI() {
      axios
        .get("http://172.16.1.106:8000/api/videos")
        .then((response) => {
          // append new items to this.items
          this.videos.push(...response.data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    showVideo() {},
    mounted() {
      this.videoList = this.getVideoFromAPI();
    },
  },
};
</script>
<style scoped></style>
