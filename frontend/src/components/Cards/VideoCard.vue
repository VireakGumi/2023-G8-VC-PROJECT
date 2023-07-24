<template>
  <v-card rounded="50" width="400px">
    <div
      style="width: 400px; height: 255px"
      @mouseenter="startTimer"
      @mouseleave="clearTimer"
      @click="createHistory"
    >
      <img
        :src="video.thumbnail"
        alt=""
        style="width: 100%; height: 100%; border-radius: 5px"
        v-show="!showVideo"
      />
      <div style="width: 400px; height: 255px" v-show="showVideo">
        <vue-plyr :options="plyrOptions" width="100%" height="100%">
          <video
            controls
            :src="video.src"
            :type="video.videoType"
            autoplay
          ></video>
        </vue-plyr>
      </div>
    </div>
    <v-container class="d-flex mt-5 pa-0">
      <v-avatar rounded="50">
        <v-img
          cover
          src="https://images.alphacoders.com/131/1314427.jpeg"
        ></v-img>
      </v-avatar>
      <v-container class="pt-0 ma-0 text-white" rounded="50">
        <v-list-item-title> {{ truncatedDescription(video.title) }} </v-list-item-title>
        <v-list-item-subtitle class="mb-1"> {{ truncatedDescription(video.description) }} </v-list-item-subtitle>
        <v-list-item-subtitle>{{video.viewer }}
        {{
          video.viewer > 0 && video.viewer !== 1 ? "views" : "view"
        }}
        .
        {{durations(video.date_time)}} </v-list-item-subtitle>
      </v-container>
    </v-container>
  </v-card>
</template>
<script>
export default {
  props: ["video"],
  data() {
    return {
      showVideo: false,
      timer: null,
      plyrOptions: {
        controls: ["play", "progress", "mute"],
        quality: { default: "1080p" }
      },
    };
  },
  methods: {
    startTimer() {
      this.timer = setTimeout(() => {
        this.showVideo = true;
      }, 250);
    },
    clearTimer() {
      clearTimeout(this.timer);
      this.showVideo = false;
    },
    createHistory() {
      let token =
        this.$cookies.get("token") !== "undefined" &&
        this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";

      if (token !== null) {
        this.$http
          .post(
            "/history",
            {
              video_id: this.video.id,
              date_time: new Date()
                .toISOString()
                .replace(/T/, " ")
                .replace(/\..+/, ""),
            },
            { headers: { Authorization: `Bearer ${token}` } }
          )
          .then((response) => {
            console.log(response.data);
          })
          .catch((error) => {
            console.log(error.response);
          });
      }
    },
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
  },
};
</script>
<style scoped>
.group-pf {
  display: flex;
}
.v-card-title p {
  font-size: small;
}
.v-card {
  box-shadow: none;
}
img {
  opacity: 1;
  transition: filter 0.4s ease-in-out;
}

img:hover {
  filter: brightness(1%);
}
.vue-plyr{
  transition: filter 0.3s ease-in-out;
  filter: brightness(50%);
}

.vue-plyr video:hover {
  filter: brightness(250%);
}
</style>
