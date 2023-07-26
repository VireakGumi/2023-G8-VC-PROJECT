<template>
  <v-app style="background-color: #252525; color: white; height: 600px">
    <v-container class="profile-section" fluid></v-container>
    <v-row class="profile" flex-md="column">
      <v-col class="profile-image">
        <img src="../../assets/pare-m.jpg" alt="Profile image" />
        <div class="ml-4">
          <h2>{{ user_name }}</h2>
          <p>@{{ user_name }}</p>
          <p>200M subscribers</p>
        </div>
      </v-col>
      <v-col class="d-flex justify-end">
        <v-btn class="ma-2" @click="$router.push('/creator')"
          >Manage Video</v-btn
        >
      </v-col>
    </v-row>
    <v-row class="number-video">
      <v-col>
        <p class="view">100 videos</p>
        <p class="content">step records sorry for the owner video</p>
      </v-col>
    </v-row>
    <router-view></router-view>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      user_name: "",
    };
  },
  methods: {
    getUser() {
      const fullName = this.$cookies.get("full_name");
      this.user_name =
        fullName !== "full_name" && fullName !== null ? fullName : "";
    },
  },
  mounted() {
    this.getUser();
  },
};
</script>

<style scoped>
.profile-section {
  background-image: url("../../assets/10years.jpg");
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  position: relative;
  height: 400px;
}

.profile-image {
  display: flex;
  align-items: flex-end;
  position: absolute;
  top: 55%;
  left: 3%;
  width: 50%;
  z-index: 2;
}
.profile-image div {
  width: 200px;
}
.profile-image img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  cursor: pointer;
}

.btn a {
  color: white;
  background: #15202b;
  border: none;
  text-decoration: none;
  padding: 10px;
  border-radius: 10px;
  text-align: start;
}

.link a {
  color: black;
  border: none;
  text-decoration: none;
  font-size: large;
  padding-right: 60px;
  text-align: start;
}

.link a:hover {
  border-bottom: 2px solid #000;
}

.video {
  margin-top: 20px;
  margin-left: 40px;
}

.v-row,
.v-col {
  margin: 0;
  padding: 0;
}

.number-video .v-col {
  height: 20px;
  margin-left: 3%;
}

.profile {
  display: flex;
  align-items: center;
  height: 50px;
  margin: 0;
  padding: 0;
}
</style>
