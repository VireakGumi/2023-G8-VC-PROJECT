<template>
  <div class="text-center">
    <v-dialog v-model="upload" width="400">
      <v-card height="400" class="pa-5">
        <h1 class="text-center">Upload Video</h1>
        <v-icon icon="mdi-upload"></v-icon>
        <div class="group">
          <input
            type="file"
            name="file"
            id="file"
            ref="video"
            @change="filesChange()"
            class="inputfile"
            accept="video/*"
          />
          <label for="file">Choose a file</label>
          <button @click="upload = false">Cancel</button>
        </div>
      </v-card>
    </v-dialog>
    <v-dialog v-model="postInfo" width="1024">
      <v-card>
        <v-card-title>
          <h1>Post Video</h1>
        </v-card-title>
        <v-container>
          <v-row>
            <v-col>
              <div>
                <label for="title">Title</label>
                <v-text-field
                  required
                  name="title"
                  placeholder="Please enter your title"
                  :rules="titleRule"
                  v-model="title"
                ></v-text-field>
              </div>
              <div>
                <label for="des">Description</label>
                <v-text-field
                  required
                  name="des"
                  placeholder="Please enter your Description"
                  :rules="descriptionRule"
                  v-model="description"
                ></v-text-field>
              </div>
              <div>
                <label for="thumbnail-input">Thumbnail</label>
                <v-file-input
                  label="Select thumbnail"
                  accept="image/*"
                  :rules="thumbnailRule"
                  v-model="thumbnail"
                ></v-file-input>
              </div>
            </v-col>
            <v-col v-if="showVideo">
              <label for="">Video</label>
              <video ref="video" controls>
                <source ref="videoSource" :src="videoSource" />
              </video>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <label for="">Privacy</label>
              <v-select
                :items="['Public', 'Private']"
                selected="Select Privacy"
                :rules="privacyRule"
                v-model="privacy"
              ></v-select>
            </v-col>
            <v-col>
              <label for="">Category</label>
              <v-select
                placeholder="Select category"
                :items="category_name"
                :rules="categoryRule"
                v-model="category"
              ></v-select>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-btn variant="text" @click="(postInfo = false), (upload = true)">
            Back
          </v-btn>
          <v-btn variant="text" @click="postInfo = false"> Cancel </v-btn>
          <v-btn variant="text" @click="postVideo()"> Post </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: {
    value: Boolean,
  },
  data() {
    return {
      visible: false,
      listCategories: [],
      category_name: [],
      video: null,
      showVideo: false,
      upload: false,
      postInfo: true,
      videoSource: null,
      title: "",
      description: "",
      thumbnail: [],
      privacy: "",
      category: "",
      titleRule: [
        (v) => !!v || "Title is required",
        (v) =>
          (v && v.length >= 3 && v.length <= 225) ||
          "Title must be between 3 and 225 characters",
      ],
      descriptionRule: [
        (v) => !!v || "Description is required",
        (v) =>
          (v && v.length >= 3 && v.length <= 225) ||
          "Description must be between 10 and 225 characters",
      ],
      thumbnailRule: [
        (v) => !!v.length || "Thumbnail is required",
        (v) => (v && v[0].type.includes("image/")) || "File must be an image",
      ],
      privacyRule: [(v) => !!v || "Privacy is required"],
      categoryRule: [(v) => !!v || "Category is required"],
    };
  },
  methods: {
    getCategoryID(name) {
      this.listCategories.forEach((category) => {
        if (category.category_name == name) {
          return category.category_id;
        }
      });
    },
    filesChange() {
      this.postInfo = true;
      this.upload = false;
      this.showVideo = true;
      this.video = this.$refs.video.files[0];
      // refernces from https://codepen.io/kryvonos_v/pen/wQXaPN
      this.$nextTick(() => {
        this.videoSource = window.URL.createObjectURL(this.video);
        this.$refs.videoSource.parentElement.load();
      });
    },
    postVideo() {
      if (
        this.title &&
        this.description &&
        this.thumbnail &&
        this.privacy &&
        this.category
      ) {
        this.postInfo = false;
        let video = {
          title: this.title,
          description: this.description,
          thumbnail: this.thumbnail[0],
          path: this.video,
          privacy: this.privacy,
          categories_id: this.getCategoryID(this.category),
        };
        axios
          .post("http://172.16.1.106:8000/api/videos", video)
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
  created() {
    axios
      .get("http://172.16.1.106:8000/api/categories")
      .then((response) => {
        this.listCategories = response.data.data;
        this.category_name = this.listCategories.map(
          (category) => category.category_name
        );
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style scoped>
.v-dialog {
  position: absolute;
}
.v-card-actions {
  display: flex;
  justify-content: space-evenly;
  width: 100%;
}
.v-card {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  background-color: #15202b;
  color: white;
}

.v-file-input {
  height: 10px !important;
}
.v-btn {
  padding: 20px;
  width: 32%;
  height: 30%;
  color: white;
  background-color: #5d5bd0;
}
.inputfile {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile + label,
.group button {
  font-size: 1.25em;
  font-weight: 700;
  color: white;
  background-color: #5d5bd0;
  /* display: inline-block; */
  padding: 10px;
  border-radius: 5px;
}

.inputfile:focus + label,
.inputfile + label:hover,
.group button:hover {
  background-color: white;
  color: black;
}
.inputfile + label {
  cursor: pointer; /* "hand" cursor */
}
img {
  width: 50%;
  color: white;
}
video {
  width: 100%;
}
.group {
  display: flex;
  justify-content: space-evenly;
  width: 100%;
}
.group button {
  width: 40%;
}
</style>
