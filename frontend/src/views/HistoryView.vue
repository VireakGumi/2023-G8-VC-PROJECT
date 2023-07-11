<template>
  <div :style="{ maxWidth: '800px'}" class="container">
    <h1 class="ml-12">History</h1>
    <div class="row">
      <div
        class="d-flex flex-no-wrap mt-5 ml-12"
        v-for="(video, index) in linkVideos"
        :key="index"
      >
        <my-card-vue :data="video" />
      </div>
    </div>
    <div v-if="!linkVideos" class="history-container ml-12">
      <v-icon style="width: 100%; height: 100%; font-size: 200px"
        >mdi-history</v-icon
      >
      <h2>Keep track of what you watch</h2>
      <p color="black">Watch history isn't viewable when signed out.</p>
      <v-btn class="mr-6 ml-8 mr-2" rounded="pill" prepend-icon="mdi-account">
        Sign in
      </v-btn>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  components: { MyCardVue },
  data() {
    return { url: "http://172.16.1.106:8000/api/histories", linkVideos: null };
  },
  methods: {
    fetchVideo() {
      axios
        .get(this.url)
        .then((response) => {
          this.linkVideos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.fetchVideo();
  },
};
</script>
<style scoped>
.history-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.v-btn {
  margin-top: 5px;
  background-color: #5d5bd0;
  color: white;
}
p {
  color: black;
}
</style>
