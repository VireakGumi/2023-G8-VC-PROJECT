<template>
  <div max-width="600" class="ml-16" style="margin-top: 100px">
    <h3 class="ml-12">Search Reasult</h3>
    <div cols="12">
      <div
        class="d-flex flex-no-wrap mt-5 ml-12"
        v-for="(video, index) in getVideo()"
        :key="index"
      >
      <p> {{testFunction()}} </p>
        <video
          style="width: 30%; height: 30%"
          :src="video.src"
          :type="video.videoType"
          controls
        ></video>
        <my-card-vue :data="video" />
      </div>
    </div>
  </div>
</template>

<script>
// import Navbar from "../components/Nav/NavigationBar.vue";
import axios from "axios";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  components: {
    MyCardVue,
  },
  data() {
    return {
      // url: ,
      linkVideos: [],
    };
  },
  methods: {
    getVideo() {
      axios
        .get(`http://172.16.1.106:8000/api/videos/${this.$route.params.title}`)
        .then((response) => {
          this.linkVideos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
      return this.linkVideos;
    },
    testFunction (){
      console.log(this.getVideo());
    }
  },
};
</script>

<style>
</style>