
<template>
  <div class="ml-5 mt-5">
    <v-layout class="ml-5 mt-5" width="100%">
      <v-col class="ml-5 mx-5" style="width: 70%">
        <v-row>
          <vue-plyr :options="options">
            <video controls size="1080" :src="video.src" :type="video.videoType" autoplay></video>
          </vue-plyr>
        </v-row>
        <v-row class="mt-5">
          <div>
            <div class="ml-2">
              <div width="760">
                <v-title style="margin-left: 10px">Title: {{ video.title }}
                </v-title>
                <div>
                  <img :src="video.thumbnail" style="
                      margin-top: 10px;
                      margin-left: 10px;
                      border-radius: 50%;
                    " width="50" height="50" />
                </div>
                <div style="margin-left: 550px; margin-top: -90px">
                  <v-btn block rounded="xl" style="margin-left: 1px">
                    <v-btn class="ma-1" :class="{ 'blue--text': isClicked }" variant="text"
                      @click="isClicked = !isClicked" icon="mdi-thumb-up"></v-btn>|
                    <v-btn class="ma-1" variant="text" @click="dialog = true" icon="mdi-share"></v-btn>|
                    <v-btn class="ma-1" variant="text" icon="mdi-download"></v-btn>
                  </v-btn>
                  <v-dialog v-model="dialog" max-width="500">
                    <v-card>
                      <v-card-title>Share</v-card-title>
                      <v-card-text>
                        <v-text-field :value="video.src" required append-icon="mdi-content-copy"></v-text-field>
                      </v-card-text>
                      <v-card-actions>
                        <v-btn color="primary" text @click="dialog = false">Close</v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </div>
              </div>
            </div>
            <div class="mt-15 bg-info ml-2 rounded-lg" width="740" @click="clickvideo(video.id)" style="
                padding: 7px;
                backgroundcolor: rgb(235, 235, 226);
                color: black;
              ">
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
                  <img :src="video.thumbnail" style="
                      margin-top: 10px;
                      margin-left: 10px;
                      margin-right: 2px;
                      border-radius: 50%;
                    " width="45" height="45" />
                  <v-text-field label="comment..." class="my-text-field"></v-text-field>
                </div>
              </div>
            </div>
          </div>
        </v-row>
      </v-col>
      <v-col class="ml=5" style="width: 30%">
        <v-row>
          <v-card id="video-card" class="ml-2" width="400px">
            <div class="d-flex flex">
              <v-card-title class="d-flex flex-wrap">Mix: {{ playlist.title }}</v-card-title>
              <v-icon width="350px" v-if="showCloseIcon" style="margin: 12px"
                @click="showCloseIcon = false; showMenuIcon = true;">
                mdi-close
              </v-icon>
              <v-icon width="350px" v-if="showMenuIcon" style="margin: 12px"
                @click="showMenuIcon = false; showCloseIcon = true;">
                mdi-menu-down
              </v-icon>
            </div>
            <v-card-subtitle class="pt-4" style="margin-top: -30px">Mixes are playlists ChildRealm for you
              you</v-card-subtitle>
          </v-card>
          <v-card width="400px" id="main-card" v-if="!showMenuIcon && showCloseIcon" class="ml-2"
            style="margin-top: -3px">
            <v-container id="video-list" style="max-height: 362px; overflow-y: auto; ">
              <v-scroll-x>
                <div v-for="(video, i) in videos" :key="i" style="margin-left: -10px" class="d-flex flex mt-1"
                  @click="clickvideo(video.id)">
                  <img :src="video.video.thumbnail" width="180" />
                  <div>
                    <v-card-text style="margin-top: -18px">
                      {{ video.video.title }}
                    </v-card-text>
                    <v-card-subtitle style="margin-top: -15px">Viewer: {{ video.video.viewer }}
                    </v-card-subtitle>
                  </div>
                </div>
              </v-scroll-x>
            </v-container>
          </v-card>
        </v-row>
        <v-row>
          <div>
            <v-card id="video" v-for="(video, index) in allVideos" :key="index" width="400" class="ml-2 mt-2 mb-2">
              <div @click="clickvideo(video.id)" class="d-flex flex ml-2 mt-1 mb-1 p-2">
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
    </v-layout>
  </div>
</template>
<script>
import router from "@/router";
import MyCardVue from "../components/Cards/MyCard.vue";
export default {
  data: () => ({
    id: "",
    component: { MyCardVue },
    videos: [],
    playlist: [],
    showCloseIcon: true,
    showMenuIcon: false,
    allVideos: [],
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
      let token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
      if (token) {
        this.$http.get(`/playlistByID/${this.$route.params.id}`, { headers: { 'Authorization': `Bearer ${token}` } })
          .then((response) => {
            this.playlist = response.data.data;
            this.getTheFirstVideo();
            this.getOtherVideos();
          })
          .catch((error) => {
            console.log(error.message);
          });
      }
    },
    getTheFirstVideo() {
      this.videos = this.playlist.video_play_lists
      if (this.videos.length) {
        let data = this.videos[0].video
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
      }
    },
    getOtherVideos: function () {
      this.$http.get(`/categoryOfVideo/${this.video.id}`).then((response) => {
        this.allVideos = response.data.data;
        this.getAllVideos();
      }).catch((error) => {
        console.log(error.message);
      });

    },
    getAllVideos() {
      this.$http.get(`/videos`).then((response) => {
        let videos = response.data.data;
        this.allVideos = [...this.allVideos, ...videos];
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
        this.getOtherVideos(); // call the getVideosById method to update the component data
      },
      deep: true,
    },
  },
  mounted() {
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