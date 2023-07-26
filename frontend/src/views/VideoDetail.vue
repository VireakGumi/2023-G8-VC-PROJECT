<template>
  <v-layout class="" width="100%">
    <v-row class="pa-7" cols="12">
  <v-col cols="12" md="8">
    <v-row>
      <div style="width: 100%">
        <vue-plyr :options="options" width="100%">
          <video
            width="100%"
            controls
            :src="video.src"
            :type="video.videoType"
            autoplay
          ></video>
        </vue-plyr>
      </div>
    </v-row>
    <v-row class="mt-5">
      <div style="width: 100%">
        <div class="ml-2">
          <div>
            <h3 style="margin-left: 10px">{{ video.title }}</h3>
            <v-row
              style="
                margin: 1px;
                display: flex;
                justify-content: space-between;
              "
            >
              <v-col class="d-flex flex align-center pa-0" width="100%">
                <img
                  :src="video.thumbnail"
                  style="border-radius: 50%"
                  width="40"
                  height="40"
                />
                <div class="ml-2">
                  <h4>{{ video.user }}</h4>
                  <p>100K follower</p>
                </div>
              </v-col>
              <v-col class="like-container pa-0">
                <v-btn
                  class="ma-1"
                  height="50px"
                  rounded
                  :class="{ 'blue--text': isClicked }"
                  variant="text"
                  @click="(isClicked = !isClicked), clickfollow()"
                >
                  {{ Followtext }}
                </v-btn>
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
                  class="ml-1"
                  variant="text"
                  icon="mdi-download"
                  @click="download"
                ></v-btn>

                <v-dialog
                  v-model="dialog"
                  max-width="500"
                  style="background-color: #00000094"
                >
                  <v-card style="background-color: #1b242e">
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
              </v-col>
            </v-row>
          </div>
        </div>
        <div
          class="mt-2 ml-2 rounded-lg"
          style="padding: 7px; background-color: rgb(43, 52, 65)"
        >
          <v-col>
            <v-row rows="4" sm="4" md="4"
              ><h4 class="mr-2">
                {{ video.viewer }}
                {{
                  video.viewer > 0 && video.viewer !== 1 ? "views" : "view"
                }}
              </h4>
            </v-row>
            <v-row rows="4" sm="4" md="4">
              <h4 class="mr-2">Description:</h4>
              <span class="d-flex flex-row"> {{ video.description }}</span>
            </v-row>
            <v-row rows="4" sm="4" md="4">
              <h4 class="mr-2">DateTime:</h4>
              <span class="d-flex flex-row"> {{ video.date_time }}</span>
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
  <v-col cols="12" md="4">
    <v-row >
      <CardDetail
        class="mb-3 ml-3"
        rounded="50"
        color="#1b242e"
        v-for="(video, index) in videos"
        :key="index"
        :video="video"
        @click="createHistory"
        @click.stop="clickvideo(video.id, video.categories_id)"
      />
    </v-row>
  </v-col>
</v-row>
  </v-layout>
</template>
<script>
import router from "@/router";

import CardDetail from "@/components/Cards/CardDetail.vue";
import MyCardVue from "@/components/Cards/MyCard.vue";
export default {
  name: "VuePlyrVideo",
  components: { CardDetail },
  data: () => ({
    options: { quality: { default: "1080p" } },
    id: "",
    components: { MyCardVue },
    videos: [],
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
    Followtext: "Follow",
    day: null,
    url: "",
    isClicked: false,
    dialog: false,
    items: Array.from({ length: 10 }, (k, v) => v + 1),
    srcvideo: "",
    Pages: 2,
    favorites: "",
  }),
  methods: {
    clickfollow() {
      if (this.isClicked == true) {
        this.Followtext = "Followed";
      } else {
        this.Followtext = "Follow";
      }
    },
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
      this.$http
        .get(`/video/id/${this.$route.params.id}`)
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
      this.$http
        .get(
          `/videos/recommendation/${this.$route.params.id}/${this.favorites}`
        )
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    getVideosById: function () {
      this.$http
        .get(`/video/id/${this.$route.params.id}`)
        .then((response) => {
          const data = response.data.data;
          const today = new Date();
          const diffInMilliseconds =
            today.getTime() - new Date(data.date_time).getTime();

          let duration;
          if (diffInMilliseconds < 24 * 3600 * 1000) {
            duration = Math.floor(diffInMilliseconds / (3600 * 1000)) + " hour";
          } else if (diffInMilliseconds < 7 * 24 * 3600 * 1000) {
            duration =
              Math.floor(diffInMilliseconds / (24 * 3600 * 1000)) + " day";
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

          this.video = {
            id: data.id,
            title: data.title,
            description: data.description,
            thumbnail: data.thumbnail,
            src: data.src,
            videoType: data.videoType,
            viewer: data.viewer,
            date_time: duration,
            user: data.user.full_name,
          };
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    handleScroll() {
      if (
        window.innerHeight + window.scrollY >=
        document.documentElement.scrollHeight - 150
      ) {
        this.loadMore();
      }
    },
    async loadMore() {
      if (this.isLoading) {
        return;
      }
      this.isLoading = true;
      try {
        let favorite = this.$cookies.get("favorites");
        const response = await this.$http.get(
          `/videos/recommendation/${this.$route.params.id}/${favorite}?page=${this.Pages}`
        );
        const data = response.data.data;
        for (const key in data) {
          this.videos.push(data[key]);
        }
        this.Pages++;
      } catch (error) {
        console.log(error.message);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
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
    async clickvideo(id, categories_id) {
      document.cookie = "favorites=" + categories_id;
      this.$http.get('videos/viewer/'+id).then((response) => {
        console.log(response.data);
      }).catch((error) => {
        console.log(error.message);
      });
      document.cookie = "favorites=" + categories_id;
      await router.push({ name: "videodetail", params: { id: id } });
      window.location.reload();
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
  created() {
    this.clickfollow();
    this.getVideosById();
    this.favorites = this.$cookies.get("favorites");
    this.getVideos();
    this.copylink();
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.loadMore();
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
  justify-content: center;
  align-items: center;
  justify-content: flex-end;
  width: 100%;
}
.like-container .v-btn {
  background-color: rgb(43, 52, 65);
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
