<template>
  <div class="text-center" >
    <v-dialog v-model="upload" width="400" @click="cancel">
      <v-card height="400" class="pa-5">
        <h1 class="text-center">Upload Video</h1>
        <v-icon
          icon="mdi-upload"
          style="width: 100%; font-size: 200px; margin: 0; padding: 0"
        ></v-icon>
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
          <button @click="upload = false" @click.stop="cancel">Cancel</button>
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
          <v-btn variant="text" @click="postInfo = false" @click.stop="cancel">
            Cancel
          </v-btn>
          <v-btn variant="text" @click="postVideo()"> Post </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog width="500" v-model="uploading">
      <v-card height="200" class="d-flex justify-center pa-5 align-center">
        <div v-if="uploadProgress < 100">
          <div class="d-flex justify-space-between align-center">
            <h1>Uploading</h1>
            <v-progress-circular
              v-if="uploadProgress !== null"
              :value="uploadProgress"
              size="100"
              color="white"
              indeterminate
              class="ml-5"
              >{{ uploadProgress }} %</v-progress-circular
            >
          </div>
        </div>
        <div
          v-if="uploadProgress == 100"
          class="d-flex justify-space-between align-center"
        >
          <v-icon size="100" style="color: green"
            >mdi-check-circle-outline</v-icon
          >
          <h1>Upload successful!</h1>
        </div>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  data() {
    return {
      uploading: false,
      uploadProgress: null,
      authToken: "",
      listCategories: [],
      category_name: [],
      video: null,
      showVideo: false,
      upload: true,
      postInfo: false,
      videoSource: null,
      title: "",
      description: "",
      thumbnail: [],
      privacy: "",
      category: null,
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
    cancel() {
      this.$emit("upload", false);
    },
    getCategoryID(name) {
      let id = null;
      this.listCategories.forEach((category) => {
        if (category.category_name == name) {
          id = category.id;
        }
      });
      return id;
    },
    setUpload() {
      this.$emit("show", { register: true, login: false });
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
        this.category &&
        this.video
      ) {
        this.postInfo = false;
        this.uploading = true;
        const now = new Date();
        const date = now.toISOString().slice(0, 10);
        const time = now.toLocaleTimeString("en-US", { hour12: false });
        const dateTime = `${date} ${time}`;
        let formData = new FormData();
        formData.append("title", this.title);
        formData.append("description", this.description);
        formData.append("thumbnail", this.thumbnail[0]);
        formData.append("date_time",dateTime);
        formData.append("path", this.video);
        formData.append("privacy", this.privacy);
        formData.append("categories_id", this.getCategoryID(this.category));
        this.$http
          .post("/videos", formData, {
            headers: {
              Authorization: "Bearer " + this.authToken,
              Accept: "application/json",
              "Content-Type": "multipart/form-data",
            },
            onUploadProgress: (progressEvent) => {
              let progress = Math.round(
                (progressEvent.loaded / progressEvent.total) * 100
              );
              if (progress == 0) {
                progress = 100;
              }
              console.log(`Upload progress: ${progress}`);
              this.uploadProgress = progress;
            },
          })
          .then((response) => {
            if (response.status >= 200 && response.status < 300) {
              console.log("Upload successful!");

              console.log(response.data);
            } else {
              console.log("Upload failed!");
              console.log(response.data);
            }
            this.$emit("upload", false);
          })
          .catch((error) => {
            console.log("Error uploading video:", error.message);
          });
      }
    },
  },
  mounted() {
    this.authToken = this.$cookies.get("token");
    this.$http
      .get("/categories")
      .then((response) => {
        this.listCategories = response.data.data;
        this.category_name = []; // set to an empty array before assigning values
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
  background-color: #252525;
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
