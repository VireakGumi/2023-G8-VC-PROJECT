<template>
  <SlideShow />
  <Category :clicked="isClick" @isShow="handOver" />
  <v-card v-if="isClick == false" color="#1b242e" class="card-container">
    <v-row class="d-flex justify-center w-100 pt-5">
      <video-card color="#1b242e" v-for="(video, index) in videoList" :key="index" :video="video" class="ma-3"
        @click="playVideo(video.id)" />
    </v-row>
  </v-card>
</template>
<script>
// import axios from "axios";
import router from "@/router";
import VideoCard from "../components/Cards/VideoCard.vue";
import Category from "../components/Category/CategoryComponent.vue";
import SlideShow from "../components/SlideShow/SlideShowComponent.vue";
export default {
  components: {
    VideoCard,
    SlideShow,
    Category,
  },
  data() {
    return {
      videoList: [],
      nextPage: 1,
      totalPages: 0,
      isLoading: false,
      isClick: false,
    };
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.loadMore();
  },

  methods: {
    playVideo(id) {
      router.push("/videodetail/" + id);
    },
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
        const response = await this.$http.get("/videos",{params: {page: this.nextPage,limit: 3,},});
        this.videoList = [...this.videoList, ...response.data.data];
        this.nextPage++;
      } catch (error) {
        console.error(error);
      }

      this.isLoading = false;
    },
    handOver(item) {
      this.isClick = item
    }
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
