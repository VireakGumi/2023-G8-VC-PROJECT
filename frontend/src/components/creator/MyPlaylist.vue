<template>
  <v-app>
    <p class="text playlist">created playlists</p>
    <div class="video-card">
      <div class="video-wrapper">
        <iframe :src="video.img" frameborder="0" allowfullscreen></iframe>
      </div>
        <p class="video-count"><img src="../../assets/menu.png" width="20" height="20" alt=""> 4videos</p>
    </div>
    <div class="video-info">
      <p>{{ video.title }}</p>
      <p>{{ video.texttitle }}</p>
      <p class="view">{{ video.viewer }}</p>
    </div>
    <router-link class="btn" color="primary" to="/full" dark>View full videos</router-link>
    <router-view></router-view>
  </v-app>
</template>

<style scoped>
.video-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
  max-width: 400px;
}

.video-wrapper {
  position: relative;
  width: 100%;
  padding-bottom: 56.25%; /* 16:9 aspect ratio */
}

.video-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.video-count {
  color: white;
  width: 98%;
  margin-top: -6%;
  background-size: cover;
  backdrop-filter: blur(5px);
  padding: 4px;
}

img {
  margin-right: 72%;
}

.video-info {
  padding: 10px;
  margin-left: 10px;
  text-align: start;
}

p {
  margin: 5px;
}

.view {
  font-size: small;
}

.btn {
  text-decoration: none;
  color: black;
  margin-left: 1.7%;
  font-size: small;
}

.text {
  margin-left: 20px;
  margin-bottom: 10px;
}
</style>

<script>

export default {
  data() {
    return {
      video: {
        id: 1,
        img: "https://www.youtube.com/embed/_bUTaGSLQsM",
        title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 51 រដូវកាលទី៥",
        texttitle: " | សម្រាយរឿង Anime Recap",
        viewer: "135K views  3 days ago",
      },
    };
  },
};
</script>
