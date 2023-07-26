<template>
  <div>
    <SlideShow />
    <Category :clicked="isClick" @isShow="handOver" />
    <v-card v-if="!isClick"  class="card-container">
      <v-row class="d-flex justify-center w-100 pt-5">
        <VideoCard
          color="#252525"
          v-for="(video, index) in videos"
          :key="index"
          :video="video"
          class="ma-3"
          @click="playVideo(video.id, video.categories_id)"
        />
      </v-row>
    </v-card>
  </div>
</template>

<script>
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
      videos: null,
      Pages: 2,
      isLoading: false,
      isClick: false,
      favorite: '',
    };
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.loadMore();
  },
  methods: {
    playVideo(id, categories_id) {
      router.push("/videodetail/" + id);
      this.$http.get('videos/viewer/'+id).then((response) => {
        console.log(response.data);
      }).catch((error) => {
        console.log(error.message);
      });
      document.cookie = "favorites=" + categories_id;
    },
    getVideo() {
      if (!this.favorite) {
        this.$http
          .get("/videos")
          .then((response) => {
            this.videos = response.data.data;
          })
          .catch((error) => {
            console.log(error.message);
          });
      } else {
        this.$http
          .get(`/videos/recommendationHomePage/${this.favorite}`)
          .then((response) => {
            this.videos = response.data.data;
          })
          .catch((error) => {
            console.log(error.message);
          });
      }
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
        const url = this.favorite ? '/videos/recommendationHomePage/${this.favorite}' : '/videos';
        const response = await this.$http.get(`${url}/?page=${this.Pages}`);
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
    handOver(item) {
      this.isClick = item;
    },
  },
  created() {
    this.favorite = this.$cookies.get("favorites");
    this.getVideo();
  },
};
</script>

<style scoped>
.card-container {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0;
  background-color:#252525;
}
</style>
