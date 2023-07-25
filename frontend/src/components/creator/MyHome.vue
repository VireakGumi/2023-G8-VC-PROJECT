<template>
  <v-app style="background-color: #252525; color: white">
    <a href="#" class="play"
      ><img
        src="../../assets/video-play.png"
        width="20"
        height="20"
        alt=""
      />Play all</a
    >
    <p class="video">Videos</p>
    <v-container class="card-container" fluid>
      <v-row class="my-card">
        <v-col v-for="video in linkVideos" :key="video.id">
          <v-card rounded="50" max-width="400px" style="background-color: #252525;" >
            <div
              style="width: 400px; height: 255px"
              @click="createHistory"
            >
              <img
                :src="video.thumbnail"
                alt=""
                style="
                  width: 100%;
                  height: 100%;
                  border-radius: 5px;
                  background-size: cover;
                "
                v-show="!showVideo"
              />
            </div>
            <v-container class="d-flex mt-5 pa-0">
              <v-container class="pt-0 ma-0 text-white" rounded="50">
                <v-list-item-title>
                  {{ truncatedDescription(video.title) }}
                </v-list-item-title>
                <v-list-item-subtitle class="mb-1">
                  {{ truncatedDescription(video.description) }}
                </v-list-item-subtitle>
                <v-list-item-subtitle
                  >{{ video.viewer }}
                  {{
                    video.viewer > 0 && video.viewer !== 1 ? "views" : "view"
                  }}
                  .
                  {{ durations(video.date_time) }}
                </v-list-item-subtitle>
              </v-container>
            </v-container>
          </v-card>
        </v-col>
          
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
  name: "App",
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
