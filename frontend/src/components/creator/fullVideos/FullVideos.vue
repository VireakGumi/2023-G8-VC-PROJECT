<template>
  <v-app>
    <v-container class="card-container" fluid>
      <v-row class="my-card">
        <v-col v-for="videos in linkVideos.video_play_lists" :key="videos">
          <div class="card-right" v-if="videos.video.id == 2">
            <div class="card-img">
              <img
                width="310"
                height="180"
                :src="videos.video.thumbnail"
                frameborder="0"
                allowfullscreen
                alt=""
              />

              <h2>
                {{ videos.video.title }}
              </h2>
              <h4>
                {{ videos.video.description }}
              </h4>
              <div class="date">
                <p class="text view-viewer">
                  {{ videos.video.viewer }}
                </p>
                <p class="text view-date">
                  {{ videos.video.date_time }}
                </p>
              </div>
            </div>
            <div class="icon">
              <img
                src="../../../assets/save.png"
                width="30"
                height="30"
                id="save"
                alt=""
              />
              <img
                src="../../../assets/share.png"
                width="30"
                height="30"
                id="share"
                alt=""
              />
              <img
                src="../../../assets/download.png"
                width="30"
                height="30"
                id="down"
                alt=""
              />
              <img
                src="../../../assets/more.png"
                width="30"
                height="30"
                id="more"
                alt=""
              />
            </div>
            <div class="btn">
              <button>
                <a href="#" class="play"
                  ><img
                    src="../../../assets/play.png"
                    width="20"
                    height="20"
                    alt=""
                  />Play all</a
                >
              </button>
              <button class="shuffle">
                <a href="#" class="play"
                  ><img
                    src="../../../assets/shuffle.png"
                    width="20"
                    height="20"
                    alt=""
                  />Play all</a
                >
              </button>
            </div>
          </div>
        </v-col>

        <div class="video-wrapper">
          <div
            class="my-card-left"
            v-for="videos in linkVideos.video_play_lists"
            :key="videos"
          >
            <div class="my-video">
              <div class="id">{{ videos.video.id }}</div>
              <img
                width="300"
                height="150"
                :src="videos.video.thumbnail"
                frameborder="0"
                allowfullscreen
                alt=""
              />
              <div class="video-title">
                <div class="title">
                  <h4>{{ videos.video.title }}</h4>
                </div>
                <div class="description">
                  {{ videos.video.description }}
                </div>
                <div class="viewer-video">
                  <p class="text view-viewer">
                    {{ videos.video.viewer }}
                  </p>
                  <p class="text view-date">
                    {{ videos.video.date_time }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      url: "/playlistByID/1",
      linkVideos: [],
    };
  },
  methods: {
    fetchVideo() {
      this.$http.get(this.url).then((response) => {
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
.card-container {
  margin-top: 6%;
  margin-right: -7%;
}

.card-right {
  flex: 0 0 330px;
  width: 40%;
  padding: 3%;
  border-radius: 15px;
  margin-right: 2%;
  background: rgb(139, 77, 15);
  height: 160%;
}

.v-col {
  display: flex;
  padding: 0;
  margin: 10px;
  width: 80%;
  flex-grow: 0;
}

.card-img img {
  padding: 15px;
  border-radius: 30px;
}

.date {
  display: flex;
  margin-left: 29px;
  color: white;
}

h2,
h4 {
  margin-left: 14px;
  color: white;
}

.text {
  margin-left: -15px;
  font-size: 15px;
}

.view-date {
  margin-left: 10px;
  margin-bottom: 3%;
}

.icon {
  display: flex;
  margin-left: 7px;
}

.btn {
  display: flex;
  margin-top: 10px;
  margin-left: 7px;
}

button {
  background: white;
  width: 40%;
  margin: 4px;
  padding: 5px;
  border-radius: 15px;
}

.play img {
  margin-bottom: -3%;
  margin-right: 5px;
  color: black;
}

a {
  color: black;
  text-decoration: none;
}

.shuffle {
  background: rgb(189, 186, 186);
}

.video-wrapper {
  flex: 1 1 330px;
  display: flex;
  flex-direction: column;
  margin-left: 20px;
}

.video-wrapper img {
  border-radius: 15px;
}

.my-card {
  display: flex;
  flex-direction: row;
}

.my-card-left {
  display: flex;
  flex-direction: row;
}

.my-video {
  display: flex;
  flex-direction: row;
  margin: 10px;
}

.id {
  margin-right: 5%;
  margin-top: 14%;
  height: 100%;
}

.video-title {
  width: 100%;
  display: flex;
  flex-direction: column;
}

.title {
  width: 100%;
  margin-left: 10px;
}

.description {
  width: 100%;
  margin-left: 15%;
}

.viewer {
  width: 100%;
  display: flex;
  margin-left: 16%;
}

.viewer-video {
  width: 100%;
  display: flex;
  margin-left: 25%;
}

#save,
#share,
#more,
#down {
  margin: 5px;
  background: rgb(216, 213, 213);
  padding: 6px;
  border-radius: 15px;
}
</style>
