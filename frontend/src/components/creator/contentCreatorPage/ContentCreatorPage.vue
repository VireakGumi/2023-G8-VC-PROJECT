<template>
  <v-app>
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
          <th class="text-left">Visability</th>
          <th class="text-left">Date</th>
          <th class="text-left">Viewer</th>
          <th class="text-left">Comment</th>
          <th class="text-left">Like</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="videos in linkVideos" :key="videos.id">
          <td>
            <div class="my-video">
              <v-checkbox></v-checkbox>
              <img class="video-thumbnail" :src="videos.thumbnail" alt="" />
              <div class="my-action">
                <p class="title">{{ videos.title }}</p>
                <div class="btn-creator mt-16">
                  <v-btn @click="editVideo(videos.id)" class="ml-2 mr-4 mb-5" color="error">Edit</v-btn>
                  <v-btn @click="deleteVideo(videos.id)" class="mb-5" color="error">
                    Delete
                  </v-btn>
                </div>
              </div>
            </div>
          </td>
          <td>{{ videos.privacy }}</td>
          <td>{{ videos.date_time }}</td>
          <td>{{ videos.viewer }}</td>
          <td>{{ videos.viewer }}</td>
          <td>{{ videos.viewer }}</td>
        </tr>
      </tbody>
    </v-table>
  </v-app>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      url: "http://172.16.1.106:8000/api/user/videos",
      linkVideos: [],
    };
  },
  methods: {
    
    fetchVideo() {
      let token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
      axios.get(this.url, {headers: {'Authorization': `Bearer ${token}`}}).then((response) => {
        this.linkVideos = response.data.data;
      });
    },
    deleteVideo(id) {
      let token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
      if (token) {
        axios
        .delete(`http://172.16.1.106:8000/api/videos/${id}`, {headers: {'Authorization': `Bearer ${token}`}})
        .then((response) => {
          // Remove the deleted video from the local data array
          console.log(response.data);
          this.linkVideos = this.linkVideos.filter((video) => video.id !== id);
        }).catch ((e) => console.log(e.message));
      }
    },
  },
  mounted() {
    this.fetchVideo();
  },
};
</script>
<style scoped>
.container {
  margin-top: 7%;
  margin-left: 8%;
}

.v-table {
  margin-left: 8%;
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

.btn{
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
