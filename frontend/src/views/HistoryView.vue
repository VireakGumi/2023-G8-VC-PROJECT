<template>
  <div class="container">
    <h1 class="ml-12 pt-5">History</h1>
    <div class="row" v-for="(videos, date) in videosByDay" :key="date">
      <h2 class="ml-12">{{ date }}</h2>
      <div
        class="d-flex flex-no-wrap mt-5 ml-12"
        v-for="(video, index) in videos"
        :key="index"
      >
        <my-card-vue :data="video" />
      </div>
    </div>
    <div v-if="!linkVideos" class="history-container ml-12 ">
      <v-icon style="width: 100%;  font-size: 200px; margin: 0; padding: 0;"
        >mdi-history</v-icon
      >
      <h2>Keep track of what you watch</h2>
      <p style="color:white;">Watch history isn't viewable when signed out.</p>
      <v-btn class="mr-6 ml-8 mr-2" rounded="pill" prepend-icon="mdi-account" @click.stop="loginForm = true">
        Sign in
      </v-btn>
    </div>
  </div>
  <login-component v-model="loginForm"></login-component>
</template>
<script>
import axios from "axios";
import LoginComponent from "@/components/LoginComponent.vue";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  components: { MyCardVue,LoginComponent },
  data() {
    return { 
      url: "http://localhost:8000/api/history", 
      linkVideos: null,
      loginForm: false,
    };
  },
  computed: {
    videosByDay() {
      const byDay = {};
      if (this.linkVideos) {
        for (const video of this.linkVideos) {
          const date = new Date(video.watched_at).toDateString();
          if (!byDay[date]) {
            byDay[date] = [];
          }
          byDay[date].push(video);
        }
      }
      return byDay;
    },
  },
  methods: {
    fetchVideo() {
      let token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
      axios
        .get(this.url, {headers: {'Authorization': `Bearer ${token}`}})
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
  height: 78.8vh
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
