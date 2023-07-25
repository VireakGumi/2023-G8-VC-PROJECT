<template>
  <div max-width="600" class="ml-16" style="margin-top: 100px">
    <h3 class="ml-12">Search Reasult</h3>
    <div style="width: 400px">
      <div
        class="d-flex flex-no-wrap mt-5 ml-12"
        v-for="(video, index) in getVideo()"
        :key="index"
        style="height: 200px"
      >
        <p>{{ testFunction() }}</p>
        <v-img
          @click="searchView(video.id)"
          style="width: 300px"
          :src="video.thumbnail"
          v-show="video.id"
          controls
        ></v-img>
        <div>
          <v-card-title class="mr-16">Title: {{ video.title }} </v-card-title>
          <div class="d-flex">
            <img
              width="40"
              height="40"
              style="border-radius: 50%; margin-left: 15px"
              :src="video.thumbnail"
            />
          </div>
          <v-card-subtitle
            >Description: {{ video.description }}
          </v-card-subtitle>
          <v-card-subtitle style="margin-right: 90px"
            >Viewer: {{ video.viewer }}
          </v-card-subtitle>
        </div>
      </div>
      <!-- <div>
        <HistoryCard
          color="#1b242e"
          v-for="(video, index) in videos"
          :key="index"
          :video="video"
          class="ma-3"
          @click.stop="searchView(video.id)"
          @click="playVideo(video.id, video.categories_id)"
        />
      </div> -->
    </div>
  </div>
</template>

<script>
import router from "@/router";
// import HistoryCard from '@/components/Cards/HistoryCard.vue';
export default {
  // components: { HistoryCard },
  data() {
    return {
      id: "",
      videos: [],
      Pages: 2,
      isLoading: false,
    };
  },
  methods: {
    mounted() {
      window.addEventListener("scroll", this.handleScroll);
      this.loadMore();
    },
    getVideo() {
      this.$http
        .get(`/videos/${this.$route.params.title}`)
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
          `/videos/${this.$route.params.title}/?page=${this.Pages}`
        );
        const data = response.data.data;
        for (const key in data) {
          this.videos.push(data[key]);
        }
        this.Pages++;
      } catch (error) {
        console.log(error.message);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    testFunction() {
      this.getVideo();
    },
    searchView(id) {
      router.push({ name: "videodetail", params: { id: id } });
    },
  },
};
</script>

<style scoped></style>
