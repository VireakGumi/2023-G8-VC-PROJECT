<template>
  <v-app>
    <p class="text playlist">created playlists</p>
    <v-container class="card-container" fluid>
      <v-row class="my-card">
        <v-col v-for="video in linkVideos" :key="video.id">
          <div class="video-card">
            <div class="video-wrapper">
              <img               
                width="330"
                height="230"
                :src="video.image"
                frameborder="0"
                allowfullscreen alt="">
              <div class="video-count">{{ video.video_play_lists.length }} videos</div>
            </div>
              <p class="title">{{ video.title }}</p>
              <router-link class="my-btn" style="font-weight: bold;" color="primary" to="/full" dark>View full videos</router-link>
          </div>
          <router-view></router-view>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      url: "http://172.16.1.106:8000/api/playlist",
      linkVideos: [],
    };
  },
  methods: {
    fetchVideo() {
      let token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
      console.log(token);
      axios.get(this.url, {headers: {'Authorization': `Bearer ${token}`}}).then((response) => {
        this.linkVideos = response.data;
        console.log(this.linkVideos);
      }).catch((error) => {console.log(error.response);});
    },
  },
  mounted() {
    this.fetchVideo();
  },
};
</script>



<style scoped>
.video-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px;
  margin-left: 3%;
  border-radius: 5px;
  max-width: 400px;
}

.card-container {
  margin-right: -3%;
}

.text {
  margin-left: -18px;
  font-size: 15px;
}

.v-col{
  padding: 0;
  width: 80%;
  flex-grow: 0;
}

.video-count {
  color: white;
  width: 100%;
  margin-top: -9%;
  background-size: cover;
  backdrop-filter: blur(5px);
  padding: 4px;
  text-align: end;
}

img {
  margin-right: 72%;
}

.video-info {
  padding: 10px;
  margin-left: 3%;
  text-align: start;
}

.view {
  font-size: small;
}

.my-btn {
  text-decoration: none;
  color: black;
  margin-right: 67%;
  margin-top: 1%;
  font-size: small;
  
}

.text{
  margin-left: 4%;
  margin-top: 15px;
  margin-bottom: 10px;
}

.title {
  margin-top: 15px;
  margin-left: -85%;
  text-align: start;
}
</style>


