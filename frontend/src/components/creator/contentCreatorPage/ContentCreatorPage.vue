<template>
<v-app>
    <div class="container">
        <h1>CHANNEL CONTENT</h1>
        <div class="btn">
        <button>Videos</button>
        <button>Performance</button>
        </div>
        <hr>
    </div>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">
          Video
        </th>
        <th class="text-left">
          Visability
        </th>
        <th class="text-left">
          Date
        </th>
        <th class="text-left">
          Viewer
        </th>
        <th class="text-left">
          Comment
        </th>
        <th class="text-left">
          Like
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="videos in linkVideos"
        :key="videos.id"
      >
        <td>
            <div class="my-video">
            <v-checkbox></v-checkbox>
            <img               
                class="video-thumbnail"
                :src="videos.thumbnail"
                alt="">
            <div class="my-action">
            <p class="title">{{videos.title}}</p>
            <div class="btn-creator">
            <button>Edit</button>
            <button>Delete</button>
            </div>
            </div>
            </div>
        </td>
        <td> {{ videos.privacy }} </td>
        <td> {{ videos.date_time }} </td>
        <td> {{ videos.viewer }} </td>
        <td> {{ videos.viewer }} </td>
        <td> {{ videos.viewer }} </td>
      </tr>
    </tbody>
  </v-table>
</v-app>
</template>
<script>
import axios from "axios";
export default {
    data () {
      return {
      url: "http://172.16.1.106:8000/api/user/videos/1",
      linkVideos: [],
    };
  },
  methods: {
    fetchVideo() {
      axios.get(this.url).then((response) => {
        this.linkVideos = response.data.data;
      });
    },
  },
  mounted() {
    this.fetchVideo();
  },
  }

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


.btn {
    display: flex;
}

button {
    width: 10%;
    padding: 10px;
  color: white;
  background: #15202b;
  border: none;
  margin: 5px;
  padding: 5px;
  border-radius: 15px;
  text-align: center;
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

.btn-creator {
    width: 250%;
    margin-top: 18%;
    margin-left: -2%;
}

</style>