<template>
  <SlideShow />
  <v-card color="#1b242e" class="card-container">
    <v-row class="d-flex justify-center w-100 pt-5">
      <video-card
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
      videoList: [],
      nextPage: 1,
      totalPages: 0,
      isLoading: false,
    };
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.loadMore();
  },

  methods: {
    handleScroll() {
      if (
        window.innerHeight + window.scrollY >=
        document.documentElement.scrollHeight - 150
      ) {
        this.loadMore();
      }
    },
    async loadMore() {
      if (this.isLoading) {
        return;
      }
      this.isLoading = true;
      try {
        const response = await axios.get(
          "http://172.16.1.106:8000/api/videos",
          {
            params: {
              page: this.nextPage,
              limit: 3,
            },
          }
        );

        this.videoList = [...this.videoList, ...response.data.data];
        this.nextPage++;
      } catch (error) {
        console.error(error);
      }

      this.isLoading = false;
    },
  },
};
</script>
<style scoped>
.card-container {
  display: flex;
  justify-content: center;
  align-content: center;
}
</style>
