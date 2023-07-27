<template>
  <div>
    <h1 class="ml-12 pt-5">History</h1>
    <div v-if="token == ''" class="history-container ml-12">
      <v-icon style="width: 100%; font-size: 200px; margin: 0; padding: 0"
        >mdi-history</v-icon
      >
      <h2>Keep track of what you watch</h2>
      <p>Watch history isn't viewable when signed out.</p>
      <v-btn
        class="mr-6 ml-8 mr-2"
        rounded="pill"
        prepend-icon="mdi-account"
        @click.stop="loginForm = true"
      >
        Sign in
      </v-btn>
    </div>
    <div>
      <HistoryCard
        color="#1b242e"
        v-for="(video, index) in videos"
        :key="index"
        :video="video"
        class="ma-4 pt-2 pb-2"
        @click="playVideo(video.id, video.categories_id)"
      />
    </div>
    <div v-if="videos == null && token" class="history-container ml-12">
      <v-icon style="width: 100%; font-size: 200px; margin: 0; padding: 0"
        >mdi-history</v-icon
      >
      <h2>No history</h2>
      <p style="color: white">Keep track of what you watch</p>
    </div>
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
</template>
<script>
import HistoryCard from "@/components/Cards/HistoryCard.vue";
import router from "@/router";
import LoginForm from "@/components/LoginComponent.vue";
import RegisterForm from "@/components/RegisterComponent.vue";
export default {
  components: { LoginForm, RegisterForm, HistoryCard },
  data() {
    return {
      videos: null,
      loginForm: false,
      registerForm: false,
      Pages: 2,
      user: {
        token: "",
        full_name: "",
        email: "",
        user_id: "",
      },
      token: "",
      loading: false,
    };
  },
  methods: {
    playVideo(id, categories_id) {
      router.push("/videodetail/" + id);
      this.$http.get('videos/viewer/'+id).then((response) => {
        console.log(response.data);
      }).catch((error) => {
        console.log(error.message);
      });
      document.cookie = "favorites=" + categories_id;
    },
    fetchVideo() {
      this.$http
        .get("/history", { headers: { Authorization: `Bearer ${this.token}` } })
        .then((response) => {
          this.videos = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
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
        this.$cookies.get("full_name") !== "full_name" &&
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
    searchView(id, categories_id) {
      document.cookie = "favorites=" + categories_id;
      router.push({ name: "videodetail", params: { id: id } });
    },
    handleScroll() {
      if (
        window.innerHeight + window.scrollY >=
        document.documentElement.scrollHeight - 150
      ) {
        this.loadMore();
      }
    },
    async loadMore() {
      if (this.isLoading) {
        return;
      }
      this.isLoading = true;
      try {
        const response = await this.$http.get(`/history?page=${this.Pages}`, {
          headers: { Authorization: `Bearer ${this.token}` },
        });
        const data = response.data.data;
        for (const key in data) {
          this.videos.push(data[key]);
        }
        this.Pages++;
      } catch (error) {
        console.log(error.message);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.loadMore();
  },
  created() {
    if (this.$cookies.get("token")) {
      this.token = this.$cookies.get("token");
    }
    this.fetchVideo();
  },
};
</script>
<style scoped>
.history-container {
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
p {
  color: black;
}
</style>
