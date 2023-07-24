<template>
  <v-app>
    <div v-if="editDialog">
      <EditDialog @isShow="handOver" :videoData="selectedVideo" />
    </div>
    <div class="container">
      <h1>CHANNEL CONTENT</h1>
      <div class="btn">
        <button>Videos</button>
        <button>Performance</button>
      </div>
      <hr />
    </div>
    <v-table>
      <thead>
        <tr>
          <th class="text-left">Video</th>
          <th class="text-left">Visibility</th>
          <th class="text-left">Date</th>
          <th class="text-left">Viewer</th>
          <th class="text-left">Comment</th>
          <th class="text-left">Like</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="video in linkVideos" :key="video.id">
          <td>
            <div class="my-video">
              <v-checkbox></v-checkbox>
              <div style="width: 50%; padding: 0;">
                <img class="video-thumbnail" :src="video.thumbnail" alt="" />
              </div>
              <div class="my-action">
                <p class="title">{{ video.title }}</p>
                <div class="btn-creator mt-16">
                  <v-btn
                    @click="editVideo(video)"
                    class="ml-2 mr-4 mb-5"
                    color="error"
                    >Edit</v-btn
                  >
                  <v-btn
                    @click="deleteVideo(video.id)"
                    class="mb-5"
                    color="error"
                  >
                    Delete
                  </v-btn>
                </div>
              </div>
            </div>
          </td>
          <td>{{ video.privacy }}</td>
          <td>{{ video.date_time }}</td>
          <td>{{ video.viewer }}</td>
          <td>{{ video.viewer }}</td>
          <td>{{ video.viewer }}</td>
        </tr>
      </tbody>
    </v-table>
    <v-dialog width="400" >
      <v-card height="200" class="d-flex justify-center pa-5 align-center">
        <div v-if="uploadProgress < 100" >
          <div class="d-flex column justify-center align-center" justify="space-evenly">
            <h1 class="text-center">Uploading</h1>
            <v-progress-circular
              v-if="uploadProgress !== null"
              :value="uploadProgress"
              size="80"
              color="primary"
              indeterminate
            >{{ uploadProgress }} %</v-progress-circular>
          </div>
        </div>
        <div v-if="uploadProgress == 100">
          <h1>Upload successful!</h1>
        </div>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
import EditDialog from "../../Dialog/EditDialog.vue";
export default {
  components: {
    EditDialog,
  },
  data() {
    return {
      url: "/user/videos",
      linkVideos: [],
      editDialog: false,
      selectedVideo: null,
    };
  },
  methods: {
    handOver() {
      this.editDialog = false;
      this.fetchVideo();
    },
    fetchVideo() {
      let token =
        this.$cookies.get("token") !== "undefined" &&
        this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      this.$http
        .get(this.url, { headers: { Authorization: `Bearer ${token}` } })
        .then((response) => {
          this.linkVideos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteVideo(id) {
      let token =
        this.$cookies.get("token") !== "undefined" &&
        this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
      if (token) {
        this.$http
          .delete(`/videos/${id}`, {
            headers: { Authorization: `Bearer ${token}` },
          })
          .then((response) => {
            // Remove the deleted video from the local data array
            console.log(response.data);
            this.linkVideos = this.linkVideos.filter(
              (video) => video.id !== id
            );
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    editVideo(video) {
      this.editDialog = true;
      this.selectedVideo = video;
    },
  },
  mounted() {
    this.fetchVideo();
  },
};
</script>
<style scoped>
.v-dialog--active {
  position: fixed !important;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%);
}
.container {
  margin-top: 3%;
  margin-left: 3%;
}

.v-table {
  margin-left: 3%;
  margin-top: 3%;
}
.my-video {
  display: flex;
}

.v-checkbox {
  margin-top: 7%;
}

.video-thumbnail {
  width: 250px;
  height: 130px;
  margin: 15px;
  border-radius: 10px;
}

.my-action {
  width: 100%;
}

.title {
  margin-top: 5%;
}

.btn {
  display: flex;
}

button {
  width: 10%;
  background: rgb(100, 37, 37);
  color: white;
  margin: 5px;
  padding: 5px;
  border-radius: 15px;
}

.btn-creator {
  width: 250%;
  margin-top: 18%;
  margin-left: -2%;
}

</style>
