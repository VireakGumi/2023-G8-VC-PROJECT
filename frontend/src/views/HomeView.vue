<template>
  <SlideShow />
  <v-card color="#1b242e" class="card-container">
    <v-row class="d-flex justify-center w-100 pt-5">
      <video-card
        color="#1b242e"
        v-for="(video, index) of videos"
        :key="index"
        :video="video"
        class="ma-1"
      />
    </v-row>
  </v-card>
</template>
<script>
import VideoCard from "../components/Cards/VideoCard.vue";
import SlideShow from "../components/SlideShow/SlideShowComponent.vue";
import axios from "axios";
export default {
  components: {
    VideoCard,
    SlideShow,
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
<style scoped>
.card-container{
  display: flex;
  justify-content: center;
  align-content: center;
}
</style>
