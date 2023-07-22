<template>
  <div
    class="container-card d-flex flex ml-2 mt-1 mb-1 p-2"
    @mouseenter="startTimer"
    @mouseleave="clearTimer"
  >
    <img
      :src="video.thumbnail"
      style="padding: 2px; width: 220px; height: 140px; border-radius: 5px;"
      v-show="!showVideo"
    />
    <div style="width: 220px; height: 140px; padding: 2px" v-show="showVideo">
      <vue-plyr :options="plyrOptions" style="width: 220px; height: 140px">
        <video
          controls
          :src="video.src"
          :type="video.videoType"
          autoplay
        ></video>
      </vue-plyr>
    </div>
    <div style="margin-left: 5px">
      <v-card-text>
        {{ truncatedDescription(video.title) }}
      </v-card-text>
      <v-card-subtitle>{{
        truncatedDescription(video.description)
      }}</v-card-subtitle>
      <v-card-subtitle>
        {{ video.viewer }}
        {{ video.viewer > 0 && video.viewer !== 1 ? "views" : "view" }}
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
  },
};
</script>

<style>
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
