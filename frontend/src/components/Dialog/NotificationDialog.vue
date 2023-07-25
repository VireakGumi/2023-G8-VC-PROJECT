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
      notifications: [
        {
          title: "Notification 1",
          subtitle: "This is the first notification",
          icon: "mdi-alert",
          color: "red",
          hover: false,
        },
        {
          title: "Notification 2",
          subtitle: "This is the second notification",
          icon: "mdi-information",
          color: "blue",
          hover: false,
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
          hover: false,
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
          hover: false,
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
          hover: false,
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
          hover: false,
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
          hover: false,
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
          hover: false,
        },
      ],
      dialog: true,
      path: mdiCog,
    };
  },
  methods: {
    removeNotification(notification) {
      const index = this.notifications.indexOf(notification);
      this.notifications.splice(index, 1);
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
  color: black;
}
</style>
