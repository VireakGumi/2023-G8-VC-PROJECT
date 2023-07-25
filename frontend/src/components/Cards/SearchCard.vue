<template>
    <div
      class="container-card d-flex flex ml-12 mt-1 mb-1 p-2"
      @mouseenter="startTimer"
      @mouseleave="clearTimer"
      rounded="50"
    >
      <img
        :src="video.thumbnail"
        style="width: 350px; height: 200px; border-radius: 5px"
        v-show="!showVideo"
      />
      <div style="width: 350px; height: 200px" v-show="showVideo">
        <vue-plyr
          :options="plyrOptions"
          style="padding: 2px; width: 350px; height: 200px"
        >
          <video
            controls
            :src="video.src"
            :type="video.videoType"
            autoplay
          ></video>
        </vue-plyr>
      </div>
      <div style="margin-left: 5px">
        <v-card-title>
          {{ truncatedDescription(video.title) }}
        </v-card-title>
        <div class="d-flex align-center">
          <img
            width="40"
            height="40"
            style="border-radius: 50%; margin-left: 15px"
            :src="video.thumbnail"
          />
          <v-card-subtitle class="ml-4">{{
            truncatedDescription(video.description)
          }}</v-card-subtitle>
        </div>
        <v-card-subtitle class="ml-4 mt-3">{{
          truncatedDescription(video.description)
        }}</v-card-subtitle>
        <v-card-subtitle class="ml-4">
          {{ video.viewer }}
          {{
            video.viewer > 0 && video.viewer !== 1 ? "views" : "view"
          }}
          .
          {{durations(video.date_time)}}
        </v-card-subtitle>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      video: Object,
    },
    data() {
      return {
        isClicked: false,
        showVideo: false,
        timer: null,
        currentTime: null,
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
      truncatedDescription(character) {
        const maxChars = 40;
        if (character.length > maxChars) {
          return character.substring(0, maxChars) + "...";
        } else {
          return character;
        }
      },
      durations(time) {
        const today = new Date();
        const diffInMilliseconds =
          today.getTime() - new Date(time).getTime();
  
        let duration;
        if (diffInMilliseconds < 24 * 3600 * 1000) {
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
  
        duration += duration === "1" ? "" : "s ago";
        return duration;
      },
    },
  };
  </script>
  
  <style scoped>
  img {
    opacity: 1;
    transition: filter 0.4s ease-in-out;
  }
  
  img:hover {
    filter: brightness(1%);
  }
  .vue-plyr {
    transition: filter 0.3s ease-in-out;
    filter: brightness(50%);
  }
  
  .vue-plyr video:hover {
    filter: brightness(250%);
  }
  .v-card-text,
  .v-card-subtitle {
    padding: 0;
    margin: 0;
  }
  </style>
  