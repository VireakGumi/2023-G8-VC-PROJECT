<template>
  <div class="ml-5" style="max-width: 600px; margin-top: 30px">
    <h1 class="ml-10">Search Result</h1>
    <div style="width: 400px">
      <div
        class="d-flex flex-no-wrap mt-5 ml-12"
        v-for="video in videos"
        :key="video.id"
        style="height: 200px"
      >
        <v-img
          @click="searchView(video.id)"
          style="width: 300px"
          :src="video.thumbnail"
          v-if="video.id"
          controls
        ></v-img>
        <div>
          <v-card-title class="mr-16">Title: {{ video.title }}</v-card-title>
          <div class="d-flex">
            <img
              width="40"
              height="40"
              style="border-radius: 50%; margin-left: 15px"
              :src="video.Channel_profile"
            />
            <h4  class="mt-2"> {{ video.Channel_name }} </h4>
          </div>
          <v-card-subtitle
            >Description: {{ video.description }}</v-card-subtitle
          >
          <v-card-subtitle style="margin-right: 90px"
            >Viewer: {{ video.viewer }}</v-card-subtitle
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import router from "@/router";

export default {
  data() {
    return {
      videos: [],
      page: 1,
      isLoading: false,
    };
  },
  mounted() {
    this.getVideos();
    window.addEventListener("scroll", this.handleScroll);
  },
  methods: {
    getVideos() {
      this.$http
        .get(`/allVideos/${this.$route.params.title}`)
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
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
        const response = await this.$http.get(
          `/videos/${this.$route.params.title}/?page=${this.page + 1}`
        );
        const data = response.data.data;
        for (const key in data) {
          this.videos.push(data[key]);
        }
        this.page++;
      } catch (error) {
        console.log(error.message);
      } finally {
        this.isLoading = false;
      }
    },
    searchView(id) {
      router.push({ name: "videodetail", params: { id: id } });
    },
  },
  watch: {
    $route: {
      handler: function () {
        this.getVideos();
      },
      deep: true,
    },
  },
};
</script>

<style scoped>
.card-container {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0;
  background-color: #252525;
}
</style>