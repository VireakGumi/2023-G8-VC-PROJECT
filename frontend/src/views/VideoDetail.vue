<template>
  <v-layout class="" width="100%">
    <v-row class="ml-10 mt-6" cols="12">
      <v-col cols="8">
        <v-row>
          <vue-plyr :options="options" width="100%">
            <video
              controls
              :src="video.src"
              :type="video.videoType"
              autoplay
            ></video>
          </vue-plyr>
        </v-row>
        <v-row class="mt-5">
          <div style="width: 100%">
            <div class="ml-2">
              <div>
                <v-title style="margin-left: 10px"
                  >Title: {{ video.title }}
                </v-title>
                <div class="d-flex flex" width="100%">
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
                  <v-title class="mt-3 ml-2"> {{ video.user }} </v-title>
                </div>
                <div class="like-container">
                  <div style="width: 165px; display: flex">
                    <v-btn
                      class="ma-1"
                      :class="{ 'blue--text': isClicked }"
                      variant="text"
                      @click="isClicked = !isClicked"
                      icon="mdi-thumb-up"
                    ></v-btn>

                    <v-btn
                      class="ma-1"
                      variant="text"
                      @click="dialog = true"
                      icon="mdi-share"
                    ></v-btn>
                    <v-btn
                      class="ma-1"
                      variant="text"
                      icon="mdi-download"
                      @click="download"
                    ></v-btn>
                  </div>
                  <v-dialog v-model="dialog" max-width="500">
                    <v-card>
                      <v-btn
                        icon="mdi-close"
                        class="ma-1"
                        variant="text"
                        @click="dialog = false"
                      ></v-btn>
                      <v-card-text>
                        <div class="d-flex flex">
                          <v-text-field :value="url" required></v-text-field>
                          <v-btn
                            class="ma-1"
                            variant="text"
                            @click="clickShare"
                            icon="mdi-content-copy"
                          ></v-btn>
                        </div>
                      </v-card-text>
                    </v-card>
                  </v-dialog>
                </div>
              </div>
            </div>
            <div
              class="mt-15 bg-info ml-2 rounded-lg"
              width="740"
              style="padding: 7px; color: black"
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
      <v-col cols="4">
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
                class="container-card d-flex flex ml-2 mt-1 mb-1 p-2"
              >
                <img
                  :src="video.thumbnail"
                  style="padding: 5px"
                  width="200"
                  height="140"
                />
                <div style="margin-left: -10px">
                  <v-card-text style="margin-top: -18px">
                    {{ video.title }}
                  </v-card-text>
                  <v-card-subtitle style="margin-top: -12px">{{
                    item
                  }}</v-card-subtitle>
                  <v-card-subtitle> {{ video.description }} </v-card-subtitle>
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
import router from "@/router";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  name: "VuePlyrVideo",
  data: () => ({
    options: { quality: { default: "1080p" } },
    id: "",
    components: { MyCardVue },
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
      user: "",
    },
    url: "",
    isClicked: false,
    dialog: false,
    items: Array.from({ length: 10 }, (k, v) => v + 1),
    srcvideo: "",
  }),
  methods: {
    download() {
      this.$http
        .get(`/video/id/${this.$route.params.id}`)
        .then((response) => {
          this.srcvideo = response.data.data.src;
          const link = document.createElement("a");
          link.href = this.srcvideo;
          link.download = "video.mp4";
          document.body.appendChild(link);
          link.click();
        })
        .catch((e) => {
          console.log(e.message);
        });
    },
    clickShare() {
      this.$http.get(`/video/id/${this.$route.params.id}`)
        .then(() => {
          const url = window.location.href;
          navigator.clipboard.writeText(url);
        })
        .catch((e) => {
          console.log(e.message);
        });
    },
    copylink() {
      this.url = window.location.href;
      return this.url;
    },
    getVideos() {
      this.$http.get(`/videos`)
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    getVideosById: function () {
      this.$http.get(`/video/id/${this.$route.params.id}`)
        .then((response) => {
          const data = response.data.data;
          console.log(data);
          this.video = {
            id: data.id,
            title: data.title,
            description: data.description,
            thumbnail: data.thumbnail,
            src: data.src,
            videoType: data.videoType,
            viewer: data.viewer,
            date_time: data.date_time,
            user: data.user.full_name,
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
        this.copylink();
      },
      deep: true,
    },
  },
  mounted() {
    this.getVideosById();
    this.getVideos();
    this.copylink();
  },
};
</script>

<style scoped>
.blue--text {
  color: rgba(0, 136, 255, 0.776);
}
.my-text-field {
  border-radius: 4px;
  padding: 2px;
}
.like-container {
  display: flex;
  flex-direction: row;
  padding: 0;
  margin: 0;
  justify-content: center;
  align-items: center;
  justify-content: flex-end;
  margin-top: -80px;
  width: 100%;
}
.like-container .v-btn {
  background-color: rgb(37, 37, 37);
}
.v-card {
  background-color: #1f262e00;
  color: white;
}
.v-card:hover {
  background-color: #1f262e49;
  cursor: pointer;
  transform: scale(1.02);
}

.v-card:active {
  transition: all 250ms ease-in-out;
  color: #1b242e;
}
</style>
