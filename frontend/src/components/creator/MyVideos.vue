<template>
<v-app>
  <v-button class="population">
    <button class="btn">Latest</button>
    <button class="btn">Popular</button>
    <button class="btn">Oldest</button>
  </v-button>
    <v-container class="card-container" fluid>
      <v-row class="my-card">
        <v-col v-for="video in linkVideos" :key="video.id">
            <img
              width="330"
              height="230"
              :src="video.thumbnail"
              frameborder="0"
              allowfullscreen
            >
            <v-card-title>
              <p class="title">{{ video.title }}</p>
              <p class="text description">{{ video.description }}</p>
              <div class="viewer date">
                <p class="text view-viewer">{{ video.viewer }}</p>
                <p class="text view-date">{{ video.date_time }}</p>
              </div>
            </v-card-title>
          <br />
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  name: "App",
  data() {
    return {
<<<<<<< HEAD
      url: "http://172.16.1.106:8000/api/user/videos",
=======
      url: "http://127.0.0.1:8000/api/user/videos/1",
>>>>>>> homepage
      linkVideos: [],
    };
  },
  methods: {
    fetchVideo() {
      let token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
      axios.get(this.url, {headers: {'Authorization': `Bearer ${token}`}}).then((response) => {
        this.linkVideos = response.data.data;
      });
    },
  },
  mounted() {
    this.fetchVideo();
  },
};
</script>

<style scoped>
.population {
  margin-left: 3.5%;
}

.btn {
  width: 6%;
  padding: 6px;
  margin: 10px;
  border-radius: 10px;
  background: #15202b;
  color: white;
}

.card-container {
  margin-right: -3%;
}

.text {
  margin-left: -15px;
  font-size: 15px;
}

.title {
  margin-left: -15px;
}

.date {
  display: flex;
}

.view-date {
  margin-left: 10px;
}

.v-col{
  padding: 0;
  margin: 10px;
  width: 80%;
  flex-grow: 0;
}

iframe {
  border-radius: 10px;
  transition: transform 0.2s ease-in-out;
}

iframe:hover {
  transform: scale(1.05);
}

</style>
