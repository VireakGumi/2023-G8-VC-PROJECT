<template>
  <div
        class="d-flex flex-no-wrap mt-4 ml-10"
        v-for="(video, index) in linkVideos"
        :key="index"
      >
        <video
          style="width: 30%; height: 30%"
          :src="video.src"
          :type="video.type"
          controls
        ></video>
        <div>
          <v-card-title class="mr-16">Title: {{ video.title }} </v-card-title>
          <div class="d-flex">
            <img
              width="40"
              height="40"
              style="border-radius: 50%; margin-left: 15px"
              src="../assets/logo.png"
            />
            <div>
              <p class="ml-3">User_id: {{ video.user_id }}</p>
            </div>
          </div>
          <v-card-subtitle
            >Description: {{ video.description }}
          </v-card-subtitle>
          <v-card-subtitle style="margin-right: 90px"
            >Viewer: {{ video.viewer }}
          </v-card-subtitle>
        </div>
      </div>
</template>

<script>
import axios from "axios";
export default {
data() {
    return {
      url: "http://172.16.1.106:8000/api/videos",
      linkVideos: "",
    };
  },
  methods: {
    fetchVideo() {
      axios.get(this.url).then((response) => {
        this.linkVideos = response.data.data;
      });
    },
  },
  mounted() {
    this.fetchVideo();
  },
}
</script>

<style>

</style>