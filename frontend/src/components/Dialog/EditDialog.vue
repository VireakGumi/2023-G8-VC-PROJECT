<template>
  <div class="text-center">
    <v-dialog v-model="postInfo" width="1024">
      <v-card>
        <v-card-title class="mt-16">
          <h1 class="mt-16">Edit Video</h1>
        </v-card-title>
        <v-container>
          <v-row>
            <v-col>
              <div>
                <label for="title">Title</label>
                <v-text-field required name="title" placeholder="Please enter your title" :rules="titleRule"
                  v-model="title"></v-text-field>
              </div>
              <div>
                <label for="des">Description</label>
                <v-textarea required name="des" placeholder="Please enter your Description" :rules="descriptionRule"
                  v-model="description"></v-textarea>
              </div>
            </v-col>
            <v-col>
              <label for="">Video</label>
              <video ref="video" controls>
                <source ref="videoSource" :src="videoData.src" type="video/mp4" />
              </video>
            </v-col>
          </v-row>
          <v-row>
            <div class="d-flex align-start ml-2">
              <v-col class="mb-2 mr-1">
                <v-row class="d-flex flex-column mb-10">
                  <label for="thumbnail-input" class="mb-2">Thumbnail</label>
                  <v-file-input label="Select thumbnail" accept="image/*" :rules="thumbnailRule"
                    v-model="thumbnail"></v-file-input>
                </v-row>
                <v-row class="mt-16 d-flex flex-column">
                  <label for="" class="mb-2">Privacy</label>
                  <v-select :items="['Public', 'Private']" selected="Select Privacy" :rules="privacyRule"
                    v-model="privacy"></v-select>
                </v-row>
              </v-col>
              <v-col class="d-flex flex-column ">
                <label for="" class="mb-2">Current Thumbnail</label>
                <img :src="videoData.thumbnail" alt="" />
              </v-col>
            </div>
          </v-row>
          <v-row>
            <v-col>
              <label for="">Category</label>
              <v-select placeholder="Select category" :items="category_name" :rules="categoryRule"
                v-model="category"></v-select>
            </v-col>
          </v-row>
        </v-container>
        <v-card-actions>
          <v-btn variant="text" @click="isShow"> Cancel </v-btn>
          <v-btn variant="text" @click="editVideo"> Edit </v-btn>
        </v-card-actions>
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
      if (this.$refs.video && this.$refs.videoSource) {
        this.$refs.video.pause();
        this.$refs.videoSource.setAttribute("src", "");
      }

      let data = {
        title: this.title,
        description: this.description,
        thumbnail: this.videoData.image,
        file: this.thumbnail[0],
        date_time: new Date()
          .toISOString()
          .replace(/T/, " ")
          .replace(/\..+/, ""),
        privacy: this.privacy,
        categories_id: this.getCategoryID(this.category),
      };
      this.uploading = false;
      this.$http
        .put(`/videos/${this.videoData.id}`, data, {
          headers: {
            Authorization: `Bearer ${this.authToken}`,
          },
          onUploadProgress: (progressEvent) => {
            this.uploadProgress = Math.round(
              (progressEvent.loaded / progressEvent.total) * 100
            );
          },
        })
        .then((res) => {
          console.log(res);
          window.location.reload();
          this.$emit("isShow", false);
        })
        .catch((error) => {
          console.log(error.response);
        });
      console.log(data);
    },
  },
  mounted() {
    this.authToken = this.$cookies.get("token");
    this.$http
      .get("/categories")
      .then((response) => {
        this.listCategories = response.data.data;
        this.category_name = [];
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
        console.log(this.category);
      })
      .catch((error) => {
        console.log(error);
      });
    console.log(this.videoData);
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

.inputfile+label,
.group button {
  font-size: 1.25em;
  font-weight: 700;
  color: white;
  background-color: #5d5bd0;
  /* display: inline-block; */
  padding: 10px;
  border-radius: 5px;
}

.inputfile:focus+label,
.inputfile+label:hover,
.group button:hover {
  background-color: white;
  color: black;
}

.inputfile+label {
  cursor: pointer;
  /* "hand" cursor */
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
