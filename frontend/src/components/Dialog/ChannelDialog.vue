<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent width="400">
      <v-card
        class="d-flex justify-center align-center flex-column"
        style="background-color: #252525; color: white"
      >
        <h1>Your Channel</h1>
        <v-card class="profile-contain" height="150px" width="200px">
          <v-avatar :image="profilePictureUrl" size="150"></v-avatar>
          <v-card-actions class="edite">
            <v-btn icon>
              <v-icon>mdi-pencil</v-icon>
              <input
                enctype="multipart/form-data"
                type="file"
                accept="image/*"
                ref="profile"
                @change="handleFileUpload()"
                style="
                  opacity: 0;
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  cursor: pointer;
                "
              />
            </v-btn>
          </v-card-actions>
        </v-card>
        <v-container>
          <v-row>
            <v-col>
              <div>
                <label for="Name">name</label>
                <v-text-field
                  required
                  name="Name"
                  placeholder="Please enter your channel name"
                  :rules="nameRule"
                  v-model="name"
                  density="compact"
                  variant="outlined"
                ></v-text-field>
              </div>
              <div>
                <label for="des">Description</label>
                <v-text-field
                  required
                  density="compact"
                  name="des"
                  placeholder="Please enter your Description"
                  :rules="descriptionRule"
                  v-model="description"
                ></v-text-field>
              </div>
            </v-col>
          </v-row>
        </v-container>
        <small>*Create your channel you can post your own video</small>

        <v-card-actions class="w-100 p-0 ma-0">
          <v-btn class="button" variant="text" @click="createChannel">
            Create
          </v-btn>
          <v-btn class="button" variant="text" @click="dialog = false">
            Cancel
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      dialog: true,
      authToken: "",
      name: "",
      description: "",
      profilePictureUrl: require("@/assets/users.jpg"),
      nameRule: [
        (v) => !!v || "Name is required",
        (v) => (v && v.length >= 3) || "Name must contain at least 3 words",
        (v) =>
          (v && v.length <= 255) ||
          "Name must be less than or equal to 255 characters",
      ],
      descriptionRule: [
        (v) => !!v || "Description is required",
        (v) =>
          (v && v.length >= 3) || "Description must contain at least 3 words",
        (v) =>
          (v && v.length <= 1000) ||
          "Description must be less than or equal to 1000 characters",
      ],
      default: require("@/assets/users.jpg"),
      profile: [],
    };
  },
  methods: {
    createChannel() {
      const now = new Date();
      const date = now.toISOString().slice(0, 10);
      const time = now.toLocaleTimeString("en-US", { hour12: false });
      const dateTime = `${date} ${time}`;

      if (this.name && this.description) {
        const formData = new FormData();
        formData.append("name", this.name);
        formData.append("description", this.description);
        formData.append("date_time", dateTime);
        if (this.profile){
          formData.append("profile", this.profile);
        }
        this.$http
          .post("/channels", formData, {
            headers: {
              Authorization: "Bearer " + this.authToken,
              Accept: "application/json",
            },
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error.message);
          });
        this.dialog = false;
        window.location.reload();
      }
    },
    handleFileUpload() {
      this.profile = this.$refs.profile.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.profile);
      reader.onload = () => {
        this.profilePictureUrl = reader.result;
      };
    },
  },
  mounted() {
    this.authToken = this.$cookies.get("token");
  },
};
</script>

<style scoped>
.edite {
  display: flex;
  align-items: flex-end;
  position: absolute;
  top: 60%;
  left: 65%;
  border-radius: 50%;
  color: white;
  z-index: 2;
  padding: 0;
  margin: 0;
  background-color: rgba(138, 138, 138, 0.671);
}

.profile-contain {
  border: none;
  background-color: #252525;
  box-shadow: none;
  display: flex;
  justify-content: center;
  align-items: center;
}
.v-card {
  border: none;
}
.v-icon {
  padding: 0;
  margin: 0;
}
.button {
  background-color: #5d5bd0;
  text-align: center;
  margin: 0;
  padding: 5px;
  width: 48%;
}
.v-text-field {
  background: white !important;
  border-radius: 5px;
  height: 44px;
  margin-bottom: 25px;
  color: black;
}
.v-card-actions {
  display: flex;
  justify-content: space-between;
  padding: 5px;
  color: white;
}
</style>
