<template>
  <div class="container pa-8">
    <h1>Upload video</h1>
    <div class="upload-container">
      <v-icon
        style="width: 100%; font-size: 200px; margin: 0; padding: 0"
        :icon="token && channel!='' ? 'mdi-upload' : 'mdi-upload-off'"
      ></v-icon>
      <h2 v-if="!token && channel!='' ">Cannot upload video</h2>
      <p style="color: white" v-if="!token">
        Upload video isn't available when signed out.
      </p>
      <p style="color: white" v-if="channel=='' && token">
        Cannot upload video when you do not have a channel.
      </p>
      <v-btn
        class="mr-6 ml-8 mr-2"
        rounded="pill"
        prepend-icon="mdi-upload"
        v-if="token && channel!=''"
        @click="upload = true"
      >
        Upload video
      </v-btn>
      <v-btn
        class="mr-6 ml-8 mr-2"
        rounded="pill"
        prepend-icon="mdi-laptop-account"
        @click="showChannelDialog = true"
        v-if="channel=='' && token"
      >
        Create Channel
      </v-btn>
      <v-btn
        class="mr-6 ml-8 ml-8"
        rounded="pill"
        prepend-icon="mdi-account"
        v-if="!token"
        @click="loginForm = true"
      >
        Sign in
      </v-btn>
    </div>
    <LoginForm
      v-model="loginForm"
      @show="handOver"
      @isShow="handOverIsShowLogin"
    />
    <RegisterForm
      v-model="registerForm"
      @show="handOver"
      @isShow="handOverIsShowRegister"
    />
    <upload-dialog v-if="upload" @upload="uploadFile"></upload-dialog>
    <channel-dialog :showChannelDialog="showChannelDialog" @haveChannel="createChannel"></channel-dialog>
  </div>
</template>

<script>
import UploadDialog from "@/components/Dialog/UploadDialog.vue";
import ChannelDialog from "@/components/Dialog/ChannelDialog.vue";
import LoginForm from "../components/LoginComponent.vue";
import RegisterForm from "../components/RegisterComponent.vue";
export default {
  components: {
    LoginForm,
    RegisterForm,
    UploadDialog,
    ChannelDialog,
  },
  data() {
    return {
      loginForm: false,
      registerForm: false,
      upload: false,
      user: {
        token: "",
        full_name: "",
        email: "",
        user_id: "",
      },
      token: "",
      channel: '',
      showChannelDialog: false,
    };
  },

  methods: {
    uploadFile() {
      this.upload = false;
    },
    createChannel(item) {
      this.showChannelDialog = item;
      this.getChannel();
    },
    setUpload() {
      this.$emit("show", { register: true, login: false });
    },
    handOverIsShowLogin(item) {
      this.getDataFromCookies();
      this.loginForm = item;
    },
    handOverIsShowRegister(item) {
      this.getDataFromCookies();
      this.registerForm = item;
    },
    handOver(item) {
      this.loginForm = item.login;
      this.registerForm = item.register;
    },
    handOverToken(user) {
      this.user = user;
    },
    getDataFromCookies() {
      this.user.user_id =
        this.$cookies.get("user_id") !== "undefined" &&
        this.$cookies.get("user_id") !== null
          ? this.$cookies.get("user_id")
          : "";
      this.user.full_name =
        this.$cookies.get("full_name") !== null &&
        this.$cookies.get("full_name") !== null
          ? this.$cookies.get("full_name")
          : "";
      this.user.email =
        this.$cookies.get("email") !== "email" &&
        this.$cookies.get("email") !== null
          ? this.$cookies.get("email")
          : "";
     this.user.token =
        this.$cookies.get("token") !== "undefined" &&
        this.$cookies.get("token") !== null
          ? this.$cookies.get("token")
          : "";
    },
    getChannel() {
      this.$http
        .get(`/user/channels`, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => {
          this.channel = response.data.data;
          this.haveChannel = true;
        })
        .catch((error) => {
          console.error("Error getting channels:", error.message);
          // Show an error message to the user
        });
    },
  },
  created() {
    this.token = this.$cookies.get("token");
    this.getChannel();
  },
};
</script>

<style scoped>
.upload-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 78.8vh;
}
.v-btn {
  margin-top: 5px;
  background-color: #5d5bd0;
  color: white;
}
</style>