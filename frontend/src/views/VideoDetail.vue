
<template>
  <v-layout class="" width="100%">
    <v-row class="mt-5">
      <v-col>
        <v-row>
          <video
            style="margin-left: 10px"
            width="760"
            height="415"
            :src="video.src"
            :type="video.videoType"
            controls
          ></video>
        </v-row>
        <v-row class="mt-5">
          <div>
            <div class="ml-2">
              <div width="760">
                <v-title style="margin-left: 10px"
                  >Title: {{ video.title }}
                </v-title>
                <div>
                  <img
                    :src="video.thumbnail"
                    style="
                      margin-top: 10px;
                      margin-left: 10px;
                      border-radius: 50%;
                    "
                    width="50"
                    height="50"
                  />
                </div>
                <div style="margin-left: 550px; margin-top:-90px">
                  <v-btn block rounded="xl" style="margin-left: 1px">
                    <v-btn
                      class="ma-1"
                      :class="{ 'blue--text': isClicked }"
                      variant="text"
                      @click="isClicked = !isClicked"
                      icon="mdi-thumb-up"
                    ></v-btn
                    >|
                    <v-btn
                      class="ma-1"
                      variant="text"
                      @click="dialog = true"
                      icon="mdi-share"
                    ></v-btn
                    >|
                    <v-btn
                      class="ma-1"
                      variant="text"
                      icon="mdi-download"
                    ></v-btn>
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
            </div>
            <div
              class="mt-15 bg-info ml-2 rounded-lg"
              width="740"
              style="
                padding: 7px;
                backgroundcolor: rgb(235, 235, 226);
                color: black;
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
            </div>
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
        </v-row>
      </v-col>
      <v-col>
        <v-row>
          <div>
            <v-card
              id="video"
              v-for="(video, index) in videos"
              :key="index"
              width="380"
              class="ml-2 mb-2"
            >
              <div
                @click="clickvideo(video.id)"
                class="d-flex flex ml-2 mt-1 mb-1 p-2"
              >
                <img :src="video.thumbnail" style="padding: 5px" width="190" />

                <div style="margin-left: -10px">
                  <v-card-text style="margin-top: -18px">
                    {{ video.title }}
                  </v-card-text>
                  <v-card-subtitle style="margin-top: -12px">{{
                    item
                  }}</v-card-subtitle>
                  <v-card-subtitle>ldfoiriui8yu</v-card-subtitle>
                </div>
              </div>
            </v-card>
          </div>
        </v-row>
      </v-col>
    </v-row>
  </v-layout>
</template>
<script>
import axios from "axios";
import router from "@/router";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  data: () => ({
    id: "",
    component: { MyCardVue },
    videos: "",
    video: {
      id: "",
      title: "",
      description: "",
      thumbnail: "",
      src: "",
      videoType: "",
      viewer: "",
      date_time: "",
    },
    isClicked: false,
    dialog: false,
    items: Array.from({ length: 10 }, (k, v) => v + 1),
  }),
  methods: {
    getVideos() {
      axios
        .get(`http://172.16.1.106:8000/api/videos`)
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    getVideosById: function () {
      axios
        .get(`http://172.16.1.106:8000/api/video/id/${this.$route.params.id}`)
        .then((response) => {
          const data = response.data.data;
          this.video = {
            id: data.id,
            title: data.title,
            description: data.description,
            thumbnail: data.thumbnail,
            src: data.src,
            videoType: data.videoType,
            viewer: data.viewer,
            date_time: data.date_time,
          };
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    clickvideo(id) {
      router.push({ name: "videodetail", params: { id: id } });
    },
  },
  watch: {
    $route: {
      handler: function () {
        this.getVideosById(); // call the getVideosById method to update the component data
      },
      deep: true,
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

/* .video-card {
  background-color: rgba(0, 0, 0, 0.009);
  color: rgba(255, 255, 255, 0.952);
} */

/* #video:hover {
  background: #ccc9c98f;
  padding: 5px;
  border-radius: 5px;
} */
.my-text-field {
  border-radius: 4px;
  padding: 2px;
}
</style>