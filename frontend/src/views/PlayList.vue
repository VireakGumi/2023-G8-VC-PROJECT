
<template>
  <div id="main">
    <div id="body" style="margin-top: -25px">
      <div class="d-flex flex">
        <video
          style="margin-top: 50px; margin-left: 10px"
          width="760"
          height="415"
          :src="video.src"
          :type="video.videoType"
          controls
        ></video>

        <div>
          <div id="video-card" class="ml-1 mt-12" width="150px">
            <div class="d-flex flex" width="350px">
              <v-card-title class="d-flex flex-wrap"
                >Mix - Girl In My Dream - 1NE</v-card-title
              >
              <v-icon
                width="350px"
                v-if="showCloseIcon"
                style="margin-left: 7px"
                @click="
                  showCloseIcon = false;
                  showMenuIcon = true;
                "
              >
                mdi-close
              </v-icon>
              <v-icon
                width="350px"
                v-if="showMenuIcon"
                style="margin-left: 7px"
                @click="
                  showMenuIcon = false;
                  showCloseIcon = true;
                "
              >
                mdi-menu-down
              </v-icon>
            </div>
            <v-card-subtitle class="pt-4" style="margin-top: -30px"
              >Mixes are playlists Youtube makes for you</v-card-subtitle
            >
          </div>
          <v-card
            width="350px"
            id="main-card"
            v-if="!showMenuIcon && showCloseIcon"
            class="ml-1"
            style="margin-top: -3px"
          >
            <v-container
              id="video-list"
              style="max-height: 362px; overflow-y: auto"
            >
              <v-scroll-x>
                <div
                  v-for="(video, i) in videos"
                  :key="i"
                  style="margin-left: -10px"
                  class="d-flex flex mt-1"
                >
                  <img :src="video.thumbnail" controls width="100" />
                  <div>
                    <v-card-text style="margin-top: -18px">
                      {{ video.title }}
                    </v-card-text>
                    <v-card-subtitle style="margin-top: -15px"
                      >Viewer: {{ video.viewer }}
                    </v-card-subtitle>
                  </div>
                </div>
              </v-scroll-x>
            </v-container>
          </v-card>
        </div>
      </div>
      <div class="d-flex flex">
        <div
          width="760"
          height="600"
          style="margin-left: 10px; margin-top: 10px"
        >
          <div class="d-flex flex ml-2 mt-1">
            <div width="600">
              <v-title style="margin-left: 10px"> {{ video.title }} </v-title>
              <div>
                <img
                  :src="video.thumbnail"
                  style="
                    margin-top: 10px;
                    margin-left: 10px;
                    border-radius: 50%;
                  "
                  width="40"
                  height="40"
                />
              </div>
            </div>
            <div style="margin-left: 460px">
              <v-btn block rounded="xl" style="margin-left: 1px">
                <v-btn
                  class="ma-1"
                  :class="{ 'blue--text': isClicked }"
                  variant="text"
                  @click="isClicked = !isClicked"
                  v-onClick="(rail = false)"
                  icon="mdi-thumb-up"
                ></v-btn
                >|
                <v-btn
                  class="ma-1"
                  variant="text"
                  @click="dialog = true"
                  icon="mdi-share"
                  click.stop="rail = !rail"
                ></v-btn
                >|
                <v-btn class="ma-1" variant="text" icon="mdi-download"></v-btn>
              </v-btn>
              <v-dialog v-model="dialog" max-width="500">
                <v-card>
                  <v-card-title>Share</v-card-title>
                  <v-card-text>
                    <v-text-field
                      :value="video.src"
                      required
                      append-icon="mdi-content-copy"
                    ></v-text-field>
                  </v-card-text>
                  <v-card-actions>
                    <v-btn color="primary" text @click="dialog = false"
                      >Close</v-btn
                    >
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </div>
          </div>
          <v-card
            class="mt-2 ml-2"
            width="740"
            style="
              padding: 7px;
              border-radius: 5px;
              background-color: lightgray;
            "
          >
            <v-col>
              <v-row rows="4" sm="4" md="4">
                <v-title>Viewer: {{ video.viewer }}</v-title>
              </v-row>
              <v-row rows="4" sm="4" md="4">
                <v-title>Description: {{ video.description }}</v-title>
              </v-row>
              <v-row rows="4" sm="4" md="4">
                <v-title>DateTime: {{ video.date_time }}</v-title>
              </v-row>
            </v-col>
          </v-card>
          <div class="ml-2 mt-2" width="720">
            <div>
              <div class="d-flex flex">
                <img
                  :src="video.thumbnail"
                  style="
                    margin-top: 10px;
                    margin-left: 10px;
                    margin-right: 2px;
                    border-radius: 50%;
                  "
                  width="45"
                  height="45"
                />
                <v-text-field
                  label="comment..."
                  class="my-text-field"
                ></v-text-field>
              </div>
            </div>
          </div>
        </div>
        <div :rail="rail" permanent>
          <v-card
            id="video"
            v-for="(video, index) in videos"
            :key="index"
            width="350px"
            height="auto"
            class="ml-5 mt-1"
          >
            <div class="d-flex flex" style="padding: 5px">
              <img
                :src="video.thumbnail"
                controls
                width="150"
                style="border-radius: 5px"
              />

              <div style="margin-left: -10px">
                <v-card-text style="margin-top: -18px">
                  Title: {{ video.title }}
                </v-card-text>
                <v-card-subtitle style="margin-top: -12px"
                  >Viewer: {{ video.viewer }}</v-card-subtitle
                >
              </div>
            </div>
          </v-card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  data: () => ({
    component: { MyCardVue },
    videos: "",
    video: "",
    isClicked: false,
    dialog: false,
    showCloseIcon: true,
    showMenuIcon: false,
    rail: true,
    items: Array.from({ length: 10 }, (k, v) => v + 1),
  }),
  methods: {
    getVideos() {
      axios
        .get("http://172.16.1.106:8000/api/videos")
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    getVideosById: function () {
      axios
        .get("http://172.16.1.106:8000/api/video/id/2")
        .then((response) => {
          this.video = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
  },
  mounted() {
    this.getVideosById();
    this.getVideos();
  },
};
</script>

<style scoped>
.blue--text {
  color: rgba(0, 136, 255, 0.776);
}
#video-card {
  background: white;
  color: black;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}
#main-card {
  background: white;
  color: black;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
}
/* #video:hover {
  background: #ccc9c98f;
  padding: 5px;
  border-radius: 5px;
} */
.my-text-field {
  border-radius: 4px;
  padding: 2px;
}
#body {
  margin-bottom: 100px;
}
/* Hide the default scrollbar */
#video-list::-webkit-scrollbar {
  /* display: none; */
  width: 8px;
}

/* Style the thumb */
#video-list::-webkit-scrollbar-thumb {
  background-color: rgba(201, 207, 212, 0.776);
  border-radius: 10px;
}

/* Style the track */
#video-list::-webkit-scrollbar-track {
  display: none;
}

#main {
  background-color: white;
  color: black;
}
</style>