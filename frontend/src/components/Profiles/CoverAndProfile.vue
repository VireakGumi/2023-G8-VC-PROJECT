<template>
  <v-app>
    <v-container class="profile-section" fluid> </v-container>
    <v-row class="profile">
      <v-col class="profile-image">
        <img src="../../assets/pare-m.jpg" alt="Profile image" />
        <input type="file" id="picture" name="picture" />
      </v-col>
      <Info-Of-User />
      <Btn-Subscribe />
    </v-row>
    <v-row>
      <v-col>
        <p class="view">100 videos</p>
        <p class="content">**step records**sorry for the owner video</p>
      </v-col>
    </v-row>
  <router-view></router-view>
  </v-app>
</template>

<script>
import SubscribeBtn from "./SubscripeBtn.vue";
import InfoOfUser from "./InfoOfUser.vue";
export default {
  components: {
    "Btn-Subscribe": SubscribeBtn,
    "Info-Of-User": InfoOfUser,
  },
};
</script>

<style scoped>

.profile-section {
  background-image: url("../../assets/10years.jpg");
  background-size: cover;
  background-position: center;
  padding: 140px;
  border-radius: 5px;
  display: flex;
  align-items: center;
}

.profile-image {
  margin-top: -4%;
  margin-left: 4%;
  position: relative;
}

.profile-image img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  cursor: pointer;
}

.profile-image input[type="file"] {
  display: none;
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

.view {
  margin-top: -12%;
  margin-left: 4%;
}

.content {
  margin-left: 4%;
}
</style>
