<template>
  <div class="container">
    <h1 class="ml-12 pt-5">Upload video</h1>
    <div class="upload-container">
      <v-icon style="width: 100%; font-size: 200px; margin: 0; padding: 0">{{
        icon
      }}</v-icon>
      <h2 v-if="!isAuthenticated">Can not upload video</h2>
      <p style="color: white" v-if="!isAuthenticated" >
        Upload video isn't available when signed out.
      </p>
      <v-btn
        class="mr-6 ml-8 mr-2"
        rounded="pill"
        prepend-icon="mdi-upload"
        v-if="isAuthenticated"
        @click="upload = true"
      >
        Upload video
      </v-btn>
      <v-btn
        class="mr-6 ml-8 ml-8"
        rounded="pill"
        prepend-icon="mdi-account"
        v-else
        @click="loginForm = true"
      >
        Sign in
      </v-btn>
    </div>
    <LoginForm
      v-model="loginForm"
      @show="handOver"
      @isShow="handOverIsShowLogin"
      :setForm="setForm"
    />
    <RegisterForm
      v-model="registerForm"
      @show="handOver"
    />
    <upload-dialog v-if="upload" ></upload-dialog>
  </div>
</template>

<script>
import UploadDialog from "@/components/Dialog/UploadDialog.vue";
import LoginForm from "../components/LoginComponent.vue";
import RegisterForm from "../components/RegisterComponent.vue";
export default {
  components: {
    LoginForm,
    RegisterForm,
    UploadDialog
  },
  data() {
    return {
      sign: false,
      loginForm: false,
      registerForm: false,
      upload: false,
    };
  },
  computed: {
    isAuthenticated() {
      const token = this.$cookies.get("token");
      if (token) {
        this.sign = true;
        return true;
      } else {
        this.sign = false;
        return false;
      }
    },
    icon() {
      return this.sign ? "mdi-upload" : "mdi-upload-off";
    },
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
