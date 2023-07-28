<template>
  <v-app style="background-color: #252525; color: white">
    <a href="#" class="play"><img src="../../assets/video-play.png" width="20" height="20" alt="" />Play all</a>
    <p class="video">Videos</p>
    <v-container fluid>
      <v-row>
        <v-col class="mx-8">
          <v-card v-if="!isClick" class="card-container ">
            <v-row class="d-flex justify-center w-100 pt-5">
              <VideoCard color="#252525" v-for="(video, index) in linkVideos" :key="index" :video="video" class="ma-3"
                @click="playVideo(video.id, video.categories_id)" />
            </v-row>
          </v-card>
        </v-col>

      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import VideoCard from "../Cards/VideoCard.vue"
export default {
  name: "App",
  components: { VideoCard },
  data() {
    return {
      url: "/user/videos",
      linkVideos: [],
      timer: null,
    };
  },
  methods: {
    truncatedDescription(character) {
      const maxChars = 100;
      if (character.length > maxChars) {
        return character.substring(0, maxChars) + "...";
      } else {
        return character;
      }
    },
    durations(dateTimeString) {
      const now = new Date();
      const dateTime = new Date(dateTimeString);
      const diffInMilliseconds = now.getTime() - dateTime.getTime();
      console.log(diffInMilliseconds)
      let duration;
      if (diffInMilliseconds < 60 * 1000) {
        duration = Math.floor(diffInMilliseconds / 1000) + " second";
      } else if (diffInMilliseconds < 60 * 60 * 1000) {
        duration = Math.floor(diffInMilliseconds / (60 * 1000)) + " minute";
      } else if (diffInMilliseconds < 24 * 3600 * 1000) {
        duration = Math.floor(diffInMilliseconds / (3600 * 1000)) + " hour";
      } else if (diffInMilliseconds < 7 * 24 * 3600 * 1000) {
        duration = Math.floor(diffInMilliseconds / (24 * 3600 * 1000)) + " day";
      } else if (diffInMilliseconds < 4 * 7 * 24 * 3600 * 1000) {
        duration =
          Math.floor(diffInMilliseconds / (7 * 24 * 3600 * 1000)) + " week";
      } else if (diffInMilliseconds < 12 * 4 * 7 * 24 * 3600 * 1000) {
        duration =
          Math.floor(diffInMilliseconds / (4 * 7 * 24 * 3600 * 1000)) +
          " month";
      } else {
        duration =
          Math.floor(diffInMilliseconds / (12 * 4 * 7 * 24 * 3600 * 1000)) +
          " year";
      }
      duration += duration === "1 second" ? "" : "s ago";
      return duration;
    },
    fetchVideo() {
      let token =
        this.$cookies.get("token") !== "undefined" &&
          this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      this.$http
        .get(this.url, { headers: { Authorization: `Bearer ${token}` } })
        .then((response) => {
          this.linkVideos = response.data.data;
        }).catch((error) => {
          console.error(error.message);
        });
    },
  },
  mounted() {
    this.fetchVideo();
  },
};
</script>

<style scoped>
.card-container {
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 0;
  background-color: #252525;
}

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

.text {
  margin-left: -15px;
  font-size: 15px;
}

.date {
  display: flex;
}

.view-date {
  margin-left: 10px;
  margin-bottom: 3%;
}

.play {
  margin-top: 1.5%;
  margin-left: 10%;
  color: black;
}

.video {
  margin-left: 4%;
  margin-top: -1.5%;
}

.title {
  margin-left: -5%;
}

.v-col {
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
