<template>
  <v-sheet class="w-100 d-flex justify-center" color="#1b242e" scroll-x>
    <v-tabs
      v-model="tab"
      class="text-white"
      show-arrows
      slider-color="teal-lighten-3"
      @click="isClicked"
    >
      <v-tab
        rounded="pill"
        v-for="category in categories"
        :key="category"
        :value="category.id"
        outlined
        @click="getVideos(category.id)"
      >
        {{ category.category_name }}
      </v-tab>
    </v-tabs>
  </v-sheet>
  <v-window v-if="clicked" v-model="tab">
    <v-window-item 
      class="fill-height"
      v-for="category in categories"
      :key="category"
      :value="category.id"
    >
      <v-card v-if="videos != ''" color="#1b242e" class="card-container">
        <v-row class="d-flex justify-center w-100 pt-5">
          <VideoCard
            color="#1b242e"
            v-for="(video, index) in videos"
            :key="index"
            :valve="video.id"
            :video="video"
            class="ma-3"
            @click="playVideo(video.id)"
          ></VideoCard>
        </v-row>
      </v-card>
      <v-container v-else class="fill-height d-flex justify-center"
        ><h1>{{ message }}</h1></v-container
      >
    </v-window-item>
  </v-window>
</template>
<script>
import VideoCard from "../Cards/VideoCard.vue";
import router from "@/router";
export default {
  components: {
    VideoCard,
  },
  props: ["clicked"],
  data() {
    return {
      tab: null,
      categories: [],
      videos: [],
      message: "",
    };
  },
  async mounted() {
    try {
      const response = await this.$http.get("/categories");
      this.categories = response.data.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    playVideo(id) {
      router.push("/videodetail/" + id);
    },
    isClicked() {
      this.isClick = true;
      this.$emit("isShow", this.isClick);
    },
    async getVideos(categoryId) {
      try {
        const response = await this.$http.get("/category/" + categoryId);
        if (response.data.data != null) {
          this.videos = response.data.data;
        } else {
          this.message = response.data.message;
          this.videos = [];
        }
      } catch (error) {
        this.videos = [];
      }
    },
  },
  emits: ["isShow"], // <-- add this line
};
</script>

<style scoped></style>
