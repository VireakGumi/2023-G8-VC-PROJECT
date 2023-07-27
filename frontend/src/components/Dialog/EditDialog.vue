<template>
  <div class="text-center">
    <v-dialog v-model="postInfo" width="1024" @click:outside="isShow">
      <v-card>
        <v-card-title>
          <h1 class="mt-2">Edit Video</h1>
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
                <label for="thumbnail-input" class="mb-2">Thumbnail</label>
                <v-file-input
                  label="Select thumbnail"
                  accept="image/*,video/*"
                  :rules="thumbnailRule"
                  v-model="thumbnail"
                ></v-file-input>
              </div>
            </v-col>
            <v-col>
              <label for="">Video</label>
              <video ref="video" controls>
                <source
                  ref="videoSource"
                  :src="videoData.src"
                  type="video/mp4"
                />
              </video>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <label for="" class="mb-2">Privacy</label>
              <v-select
                :items="['Public', 'Private']"
                placeholder="Select Privacy"
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
        <v-card-actions class="group ma-2 pa-2">
          <v-btn variant="text" @click="isShow">Cancel</v-btn>
          <v-btn variant="text" @click="editVideo">Edit</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog width="500" v-model="uploading" @click:outside="isShow">
      <v-card height="200" class="d-flex justify-center pa-5 align-center">
        <div
          v-if="uploadProgress == 100"
          class="d-flex justify-space-between align-center"
        >
          <v-icon size="100" style="color: green"
            >mdi-check-circle-outline</v-icon
          >
          <h1>Edite Video successful!</h1>
        </div>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  props: {
    videoData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      uploading: false,
      uploadProgress: null,
      authToken: "",
      listCategories: [],
      category_name: [],
      video: {},
      showVideo: false,
      upload: true,
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
      let id = null;
      this.listCategories.forEach((category) => {
        if (category.category_name == name) {
          id = category.id;
        }
      });
      return id;
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

    isShow() {
      this.$emit("isShow", false);
    },

    editVideo() {
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
        let formData = new FormData();
        formData.append("title", this.title);
        formData.append("description", this.description);
        formData.append("thumbnail", this.thumbnail[0]);
        formData.append(
          "date_time",
          new Date().toISOString().replace(/T/, " ").replace(/\..+/, "")
        );
        formData.append("privacy", this.privacy);
        formData.append("categories_id", this.getCategoryID(this.category));
        formData.append("_method", "PUT"); // Add this line to indicate that it's a PUT request

        this.$http
          .put(`/videos/${this.videoData.id}`, formData, {
            headers: {
              Authorization: "Bearer " + this.authToken,
              Accept: "application/json",
              "Content-Type": "multipart/form-data", // Set the content type to multipart/form-data
            },
            onUploadProgress: (progressEvent) => {
              let progress = Math.round(
                (progressEvent.loaded / progressEvent.total) * 100
              );
              if (progress == 0) {
                progress = 100;
              }
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
        this.category_name = [];
        if (this.videoData) {
          const file = new File(
            [this.videoData.thumbnail],
            this.videoData.image,
            { type: this.videoData.imageType }
          );
          this.thumbnail = new Proxy([file], {
            get(target, prop) {
              return target[prop];
            },
            set(target, prop, value) {
              target[prop] = value;
              return true;
            },
          });
        }
        this.category_name = this.listCategories.map(
          (category) => category.category_name
        );
        this.title = this.videoData.title;
        this.description = this.videoData.description;
        this.privacy = this.videoData.privacy;
        for (let item of this.listCategories) {
          if (item.id == this.videoData.categories_id) {
            this.category = item.category_name;
          }
        }
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style scoped>
/* .v-dialog {
  position: absolute;
} */
.v-dialog--active {
  position: fixed !important;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%);
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
  font-size: large;
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
  padding: 0;
  height: 60px;
}
.group button {
  width: 49%;
  height: 50px;
}
</style>
