<template>
  <div max-width="600" class="ml-16" style="margin-top: 100px">
    <h3 class="ml-12">Search Reasult</h3>
    <div cols="12">
      <div
        class="d-flex flex-no-wrap mt-5 ml-12"
        v-for="(video, index) in getVideo()"
        :key="index"
      >
        <p>{{ testFunction() }}</p>
        <video
          @click="searchView(video.id)"
          style="width: 30%; height: 30%"
          :src="video.src"
          v-show="video.id"
          :type="video.videoType"
          controls
        ></video>
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
          <v-card-title class="ml-3">User_id: {{ video.user_id }}</v-card-title>
          <v-card-subtitle
            >Description: {{ video.description }}
          </v-card-subtitle>
          <v-card-subtitle style="margin-right: 90px"
            >Viewer: {{ video.viewer }}
          </v-card-subtitle>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import router from "@/router";
export default {
  data() {
    return {
      id: "",
      linkVideos: [],
    };
  },
  methods: {
    getVideo() {
      axios
        .get(`http://127.0.0.1:8000/api/videos/${this.$route.params.title}`)
        .then((response) => {
          this.linkVideos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
      return this.linkVideos;
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

<style scoped>
</style>