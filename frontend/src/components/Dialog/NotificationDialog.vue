<template>
  <div>
    <v-dialog v-model="dialog" style="margin-left: 60%; margin-top: 2.5%">
      <v-card-all
        style="
          height: 670px;
          overflow-y: auto;
          background-color: white;
          border-radius: 15px;
          width: 100%;
        "
      >
        <v-card-icon style="display: flex; justify-content: space-between; margin-right: 10px; margin-top: 10px">
          <v-card-title style="height: 50px">Notifications</v-card-title>
          <svg-icon type="mdi" :path="path" style="margin-top: 10px;"></svg-icon>
        </v-card-icon>
        <hr />
        <v-list style="height: 545px; background-color: white">
          <v-card
            v-for="(notification, index) in notifications"
            :key="index"
            :style="{
              backgroundColor: notification.hover
                ? 'rgb(240, 235, 235)'
                : 'white',
              color: 'black',
            }"
            v-on:mouseover="notification.hover = true"
            v-on:mouseout="notification.hover = false"
            class="pa-2"
          >
            <router-link to="/video-details" @click="dialog = false">
              <v-card-title class="headline">{{
                notification.title
              }}</v-card-title>
              <v-card-subtitle class="grey--text">{{
                notification.subtitle
              }}</v-card-subtitle>
            </router-link>
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
import SvgIcon from "@jamescoyle/vue-icon";
import { mdiCog } from "@mdi/js";
export default {
  name: "my-cool-component",
  components: {
    SvgIcon,
  },
  data() {
    return {
      notifications: [],
      dialog: true,
      path: mdiCog,
    };
  },
  methods: {
    getNotifications(){
      this.$http.get("/notification").then((response) => {
        this.notifications = response.data;
      }).catch((error) => {console.log(error.message);});
    },  
    removeNotification(notification) {
      const index = this.notifications.indexOf(notification);
      this.notifications.splice(index, 1);
    },
  },
  created() {
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
