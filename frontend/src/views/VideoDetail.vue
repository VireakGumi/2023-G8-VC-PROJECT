<template>
  <v-layout class="" width="100%">
    <v-row class="pa-7" cols="12">
      <v-col cols="12" md="8">
        <v-row>
          <div style="width: 100%">
            <vue-plyr :options="options" width="100%">
              <video width="100%" controls :src="video.src" :type="video.videoType" autoplay></video>
            </vue-plyr>
          </div>
        </v-row>
        <v-row class="mt-5">
          <div style="width: 100%">
            <div class="ml-2">
              <div>
                <h3 style="margin-left: 10px">{{ video.title }}</h3>
                <v-row style="
                    margin: 1px;
                    display: flex;
                    justify-content: space-between;
                  ">
                  <v-col class="d-flex flex align-center pa-0" width="100%">
                    <img :src="video.Channel_profile" style="border-radius: 50%" width="40" height="40" />
                    <div class="ml-2">
                      <h4>{{ video.Channel_name }}</h4>
                      <p>{{ this.allFollowers.length }} follower</p>
                    </div>
                  </v-col>

                  <v-col class="like-container pa-0">
                    <v-btn class="ma-1" height="50px" rounded :class="{ 'blue--text': isClicked }" variant="text"
                      @click="clickfollow()" v-if="video.channel_id != this.channel_id">
                      {{ Followtext }}
                    </v-btn>
                    <div class="d-flex align-center mx-2">
                      <v-btn class="ma-1" :class="{ 'blue--text': isLiked }" variant="text" @click="addLike"
                        icon="mdi-thumb-up"></v-btn>
                      <p class="">{{ likes.length }}</p>
                    </div>


                    <v-btn class="ma-1" variant="text" @click="dialog = true" icon="mdi-share"></v-btn>
                    <v-btn class="ml-1" variant="text" icon="mdi-download" @click="download"></v-btn>

                    <v-btn class="ml-2 text-white" dark large @click="showReport" icon="mdi-flag-outline"></v-btn>
                    <report-dialog v-if="showDialog" @show="handOver"></report-dialog>

                    <v-dialog v-model="dialog" max-width="500" style="background-color: #00000094">
                      <v-card style="background-color: #1b242e">
                        <v-btn icon="mdi-close" class="ma-1" variant="text" @click="dialog = false"></v-btn>
                        <div style="
                            width: 500px;
                            display: flex;
                            justify-content: center;
                          ">
                          <div>
                            <img @click="shareFacebook" class="ma-3" width="50" :src="require('@/assets/facebook.png')"
                              alt="" />
                          </div>
                          <div>
                            <img @click="shareTelegram" class="ma-3" width="50" :src="require('@/assets/Telegram.png')"
                              alt="" />
                          </div>
                          <div>
                            <img @click="shareInstagram" class="ma-3" width="50" :src="require('@/assets/instagrame.png')"
                              alt="" />
                          </div>
                          <div>
                            <img @click="shareTwitter" class="ma-3" width="50" :src="require('@/assets/twitter1.png')"
                              alt="" />
                          </div>
                        </div>
                        <v-card-text>
                          <div class="d-flex flex">
                            <v-card-text>
                              <div class="d-flex flex">
                                <v-text-field :value="url" required></v-text-field>
                                <v-btn class="ma-1" variant="text" @click="clickShare" icon="mdi-content-copy"></v-btn>
                              </div>
                            </v-card-text>
                          </div>
                        </v-card-text>
                      </v-card>
                    </v-dialog>
                  </v-col>
                </v-row>
              </div>
            </div>
            <div class="mt-2 ml-2 rounded-lg" style="padding: 7px; background-color: rgb(43, 52, 65)">
              <v-col>
                <v-row rows="4" sm="4" md="4">
                  <h4 class="mr-2">
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
                  <img src="@/assets/users.jpg" style="
                      margin-top: 10px;
                      margin-left: 10px;
                      margin-right: 2px;
                      border-radius: 50%;
                    " width="45" height="45" />
                  <v-text-field label="comment..." class="my-text-field" v-model="comments"
                    v-on:keyup.enter="addComment"></v-text-field>
                </div>
              </div>
              <div>
                <div v-for="comment of allComments.slice().reverse()" :key="comment"
                  class="d-flex align-start my-3 text-no-wrap">
                  <img src="@/assets/users.jpg" style="
                      margin-top: 10px;
                      margin-left: 10px;
                      margin-right: 2px;
                      border-radius: 50%;
                    " width="40" height="40" />
                  <div class="mt-3 ml-4 d-flex flex-column w-75">
                    <h5>{{ comment.user.full_name }}</h5>
                    <p class="text-wrap w-100 mt-1">
                      {{ comment.comment_text }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </v-row>
      </v-col>
      <v-col cols="12" md="4">
        <v-row>
          <CardDetail class="mb-3 ml-3" rounded="50" color="#1b242e" v-for="(video, index) in videos" :key="index"
            :video="video" @click="createHistory" @click.stop="clickvideo(video.id, video.categories_id)" />
        </v-row>
      </v-col>
      <MessageDialog v-if="checking" />
    </v-row>

  </v-layout>
</template>
<script>
import router from "@/router";

import CardDetail from "@/components/Cards/CardDetail.vue";
import MyCardVue from "@/components/Cards/MyCard.vue";
import ReportDialog from '../components/Dialog/ReportDialog.vue';
import MessageDialog from '../components/Dialog/MessageDialog.vue';
export default {
  name: "VuePlyrVideo",
  components: { CardDetail, ReportDialog, MessageDialog },
  data: () => ({
    options: { quality: { default: "1080p" } },
    id: "",
    showDialog: false,
    messageDialing: false,
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
      Channel_id: "",
      Channel_name: "",
      Channel_profile: "",
    },
    Followtext: "Follow",
    day: null,
    url: "",
    isClicked: false,
    isLiked: false,
    dialog: false,
    items: Array.from({ length: 10 }, (k, v) => v + 1),
    srcvideo: "",
    Pages: 2,
    favorites: "",
    comments: "",
    allComments: [],
    likes: [],
    videoId: "",
    allFollowers: [],
    channel_id: "",
  }),
  computed: {
    checking() {
      return this.messageDialing;
    }
  },
  methods: {
    handOver(bool) {
      this.showDialog = bool;
    },
    showReport() {
      let token =
        this.$cookies.get("token") !== "undefined" &&
          this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      if (token) {
        this.showDialog = true;
      } else {
        this.messageDialing = true;
        setTimeout(() => {
          this.messageDialing = false;
        }, 3000)
      }
    },
    clickfollow() {
      let token =
        this.$cookies.get("token") !== "undefined" &&
          this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      let data = {
        channel_id: this.video.channel_id, date_time: new Date()
          .toISOString()
          .replace(/T/, " ")
          .replace(/\..+/, ""),
      }
      if (token) {
        this.isClicked = !this.isClicked
        if (this.isClicked == true) {
          this.$http.post('/follower', data, { headers: { Authorization: `Bearer ${token}` } }).then((response) => {
            this.Followtext = "Followed";
            console.log(response.data);
            this.getAllFollwer();
          }).catch((error) => { console.log(error.message) });
        } else {
          this.$http.delete('/follower/' + this.video.channel_id, { headers: { Authorization: `Bearer ${token}` } }).then((response) => {
            this.Followtext = "Follow";
            console.log(response.data);
            this.getAllFollwer();
          }).catch((error) => { console.log(error.message) });
        }
      } else {
        this.messageDialing = true;
        setTimeout(() => {
          this.messageDialing = false;
        }, 3000)
      }
    },
    getAllFollwer() {
      let user_id =
        this.$cookies.get("user_id") !== "undefined" &&
          this.$cookies.get("user_id") !== null
          ? this.$cookies.get("user_id")
          : "";
      this.$http.get('/follower/' + this.video.channel_id).then((response) => {
        this.allFollowers = response.data.data;
        for (let follower of this.allFollowers) {
          if (follower.user_id == user_id) {
            this.isClicked = !this.isClicked
            this.Followtext = "Followed";
          }
        }
      }).catch((error) => { console.log(error.message) });
    },
    download() {
      this.$http
        .get(`/video/id/${this.videoId}`)
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

    async getLikes() {
      this.$http
        .get(`/likes/${this.video.id}`)
        .then((response) => {
          this.likes = response.data.data;
          let user_id =
            this.$cookies.get("user_id") !== "undefined" &&
              this.$cookies.get("user_id") !== null
              ? this.$cookies.get("user_id")
              : "";
          for (let like of this.likes) {
            if (like.video_id == this.video.id && like.user_id == user_id) {
              this.isLiked = true;
            }
          }
        })
        .catch((e) => {
          console.log(e.message);
        });
    },
    addLike() {

      let token =
        this.$cookies.get("token") !== "undefined" &&
          this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      let data = {
        video_id: this.video.id,
        date_time: new Date()
          .toISOString()
          .replace(/T/, " ")
          .replace(/\..+/, ""),
      };
      if (token != "") {
        this.isLiked = !this.isLiked;
        if (this.isLiked) {
          this.$http
            .post("/likes", data, {
              headers: { Authorization: `Bearer ${token}` },
            })
            .then((response) => {
              console.log(response.data);
              this.getLikes();
            })
            .catch((e) => {
              console.log(e.message);
            });
        } else {
          this.$http
            .delete(`/likes/${this.video.id}`, {
              headers: { Authorization: `Bearer ${token}` },
            })
            .then((response) => {
              console.log(response.data);
              this.getLikes();
            })
            .catch((e) => {
              console.log(e.message);
            });
        }
      } else {
        this.messageDialing = true;
        this.getLikes();
        setTimeout(() => {
          this.messageDialing = false;

        }, 3000)
      }

    },
    addComment() {
      let token =
        this.$cookies.get("token") !== "undefined" &&
          this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      let data = {
        comment_text: this.comments,
        video_id: this.video.id,
        date_time: new Date()
          .toISOString()
          .replace(/T/, " ")
          .replace(/\..+/, ""),
      };
      if (token) {
        if (this.comments) {
          this.$http
            .post("/comments", data, {
              headers: { Authorization: `Bearer ${token}` },
            })
            .then((response) => {
              console.log(response.data);
              this.getAllComments();
              this.comments = "";
            })
            .catch((e) => {
              console.log(e.message);
            });
        }
      } else {
        this.messageDialing = true;
        this.getAllComments();
        setTimeout(() => {
          this.messageDialing = false;

        }, 3000)
      }
    },
    async getAllComments() {
      this.$http
        .get(`/comments/${this.video.id}`)
        .then((response) => {
          this.allComments = response.data.data;
        })
        .catch((e) => {
          console.log(e.message);
        });
    },
    playNextVideo() {
      let countdown = document.querySelector(".next-video");
      countdown.style.display = "block";
      this.nextVideoTimeout = setTimeout(() => {
        countdown.style.display = "none";
        // Get the index of the current video
        const currentIndex = this.videos.findIndex(
          (video) => video.id === this.video.id
        );

        // Check if there is a next video
        if (currentIndex < this.videos.length - 1) {
          const nextVideo = this.videos[currentIndex + 1];
          this.video = {
            id: nextVideo.id,
            title: nextVideo.title,
            description: nextVideo.description,
            thumbnail: nextVideo.thumbnail,
            src: nextVideo.src,
            videoType: nextVideo.videoType,
            viewer: nextVideo.viewer,
            date_time: nextVideo.date_time,
            user: nextVideo.user.full_name,
            channel_id: nextVideo.channel_id,
            channel_name: nextVideo.Channel_name,
            channel_profile: nextVideo.Channel_profile,
          };
        } else {
          // There is no next video, do something else
          console.log("No more videos to play");
        }
      }, 7000);
      this.startCountdown();
    },

    startCountdown() {
      this.interval = setInterval(() => {
        if (this.counter > 0) {
          this.counter--;
          if (this.counter == 0) {
            this.counter = 7;
            clearInterval(this.interval);
          }
        } else {
          clearInterval(this.interval);
        }
      }, 1000);
    },

    cancelNext() {
      let countdown = document.querySelector(".next-video");
      countdown.style.display = "none";
      this.counter = 7;
      clearInterval(this.interval);
      clearTimeout(this.nextVideoTimeout);
    },

    playNow() {
      let countdown = document.querySelector(".next-video");
      countdown.style.display = "none";
      const videoPlayer = this.$refs.videoPlayer;
      videoPlayer.pause();
      const currentIndex = this.videos.findIndex(
        (video) => video.id === this.video.id
      );

      // Check if there is a next video
      if (currentIndex < this.videos.length - 1) {
        const nextVideo = this.videos[currentIndex + 1];
        this.video = {
          id: nextVideo.id,
          title: nextVideo.title,
          description: nextVideo.description,
          thumbnail: nextVideo.thumbnail,
          src: nextVideo.src,
          videoType: nextVideo.videoType,
          viewer: nextVideo.viewer,
          date_time: nextVideo.date_time,
          user: nextVideo.user.full_name,
          channel_id: nextVideo.channel_id,
          channel_name: nextVideo.Channel_name,
          channel_profile: nextVideo.Channel_profile,
        };
      } else {
        // There is no next video, do something else
        console.log("No more videos to play");
      }
      this.counter = 7;
      clearInterval(this.interval);
      clearTimeout(this.nextVideoTimeout);
    },

    clickShare() {
      this.$http
        .get(`/video/id/${this.videoId}`)
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
        .get(`/videos/recommendation/${this.videoId}/${this.favorites}`)
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },

    getVideosById() {
      let url = "/video/id/" + this.$route.params.id;
      this.$http
        .get(url)
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

          this.video = data;
          this.video.date_time = duration;
          this.getVideos();
          this.getAllFollwer();
          this.getAllComments();
          this.getLikes();
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
      this.$http
        .get("videos/viewer/" + id)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.message);
        });
      document.cookie = "favorites=" + categories_id;
      await router.push({ name: "videodetail", params: { id: id } });
      window.location.reload();
    },
    shareFacebook() {
      const url = "https://www.facebook.com";
      window.open(url, "Share on Facebook");
    },
    shareTelegram() {
      const url = "https://t.me/share/url?url=" + window.location.href;
      window.open(url);
    },

    shareInstagram() {
      const url = "https://www.instagram.com/";
      window.open(url, "_blank");
    },

    shareTwitter() {
      const url = "https://twitter.com/";
      window.open(url, "_twitter");
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
    this.videoId = this.$route.params.id;
    this.channel_id =
        this.$cookies.get("channel_id") !== "undefined" &&
          this.$cookies.get("channel_id") !== null
          ? this.$cookies.get("channel_id")
          : "";
    this.getVideosById();
    // this.clickfollow();
    this.favorites = this.$cookies.get("favorites");
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
