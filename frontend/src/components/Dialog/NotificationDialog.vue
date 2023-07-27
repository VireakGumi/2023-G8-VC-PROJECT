<template>
  <div>
    <v-dialog v-model="dialog" style="margin-left: 60%; margin-top: 2.5%">
      <v-card-all style="
          height: 670px;
          overflow-y: auto;
          background-color: white;
          border-radius: 15px;
          width: 100%;
        ">
        <v-card-icon style="display: flex; justify-content: space-between; margin-right: 10px; margin-top: 10px">
          <v-card-title style="height: 50px">Notifications</v-card-title>
          <svg-icon type="mdi" :path="path" style="margin-top: 10px;"></svg-icon>
        </v-card-icon>
        <hr />
        <v-list style="height: 545px; background-color: white">
          <v-card v-for="(notification, index) in notifications" :key="index" :style="{
            backgroundColor: notification.hover
              ? 'rgb(240, 235, 235)'
              : 'white',
            color: 'black',
          }" v-on:mouseover="notification.hover = true" v-on:mouseout="notification.hover = false" class="pa-2">

            <div  @click="dialog = false, playVideo(notification.video.id, notification.video.categories_id)" class="d-flex justify-space-between align-center">
              <div class="d-flex align-center"> 
                <img :src="notification.video.thumbnail" alt="" width="130" height="80">
                <div>
                  <v-card-title class="headline ml-3">{{
                    notification.video.title
                  }}</v-card-title>
                  <h4 class="headline ml-7">{{
                    notification.video.channel.name
                  }}</h4>
                </div>
              </div>
              <div>
                <img :src="notification.video.channel.profile" alt="" width="45" height="45" class="rounded-circle">
              </div>
            </div>
          </v-card>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card-all>
    </v-dialog>
  </div>
</template>

<script>
import router from "@/router";
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiCog } from "@mdi/js";
export default {
  name: "my-cool-component",
  components: {
    SvgIcon,
  },
  data() {
    return {
      token: '',
      notifications: [],
      dialog: true,
      path: mdiCog,
    };
  },
  methods: {
    playVideo(id, categories_id) {
      this.dialog = false;
      router.push("/videodetail/" + id);
      this.$http.get('videos/viewer/'+id).then((response) => {
        console.log(response.data);
      }).catch((error) => {
        console.log(error.message);
      });
      document.cookie = "favorites=" + categories_id;
    },
    getNotifications() {
      this.$http.get("/notification", { headers: { 'Authorization': `Bearer ${this.token}` } }).then((response) => {
        this.notifications = response.data.data;
      }).catch((error) => { console.log(error.message); });
    },
  },
  created() {
    this.token = (this.$cookies.get('token') !== 'undefined' && this.$cookies.get('token') !== null) ? this.$cookies.get('token') : '';
    this.getNotifications()
  }
};
</script>

<style scoped>
a {
  text-decoration: none;
  color: black;
}
</style>
