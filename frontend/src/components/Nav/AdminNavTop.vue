<template>
  <v-app>
    <v-app-bar app theme="dark">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>ADMIN</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-text-field class="w-50" density="compact" variant="solo" label="Search here" append-inner-icon="mdi-magnify"
        single-line hide-details rounded="pill"></v-text-field>
      <v-spacer></v-spacer>
      <v-btn class="text-none" @click="dialog = !dialog" icon>
        <v-badge content="2" color="error">
          <v-icon>mdi-bell-outline</v-icon>
        </v-badge>
        <notification-dialog v-if="dialog"></notification-dialog>
      </v-btn>

      <v-menu transition="slide-x-transition" bottom right :open-on-click="true">
        <template v-slot:activator="{ props }">
          <v-btn v-bind="props" icon>
            <v-icon size="x-large">mdi-account</v-icon>
          </v-btn>
        </template>

        <v-list width="300px">
          <v-list-item>
            <v-avatar class="mr-5" image="https://image.lexica.art/full_jpg/19f280a2-2b97-4be2-b782-1fd5c70b84f4"
              size="40"></v-avatar>
            <v-item-title> Hirito </v-item-title>
          </v-list-item>
          <v-divider :thickness="3"></v-divider>
          <v-list-item v-for="(profile, i) in profiles" :key="i">
            <v-list-item :prepend-icon="profile.icon" :title="profile.title" :value="profile.title"></v-list-item>
            <v-divider :thickness="1"></v-divider>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-navigation-drawer app theme="dark" v-model="drawer">
      <v-list>
        <v-list-item v-for="icon of icons" 
          :key="icon.title" class="ml-2" 
          @click="drawer = !drawer"
          :prepend-icon="icon.icon" 
          :title="icon.title" 
          :to="icon.to">
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>
<script>

import NotificationDialog from "../Dialog/NotificationDialog.vue"
export default {
  components: {
    NotificationDialog
  },
  data() {
    return {
      drawer: true,
      dialog: false,
      profiles: [
        { title: "Your Channel", icon: "mdi-laptop-account", to: "" },
        {
          title: "Switch Account",
          icon: "mdi-account-reactivate-outline",
          to: "",
        },
        { title: "Theme", icon: "mdi-theme-light-dark", to: "" },
        { title: "Feedback", icon: "mdi-message-alert", to: "" },
        { title: "Sign Out", icon: "mdi-login-variant", to: "" },
      ],
      icons: [
        { title: "Home", icon: "mdi-home", to: "/" },
        { title: "Board", icon: "mdi-view-dashboard", to: "/dashboard" },
        { title: "User", icon: "mdi-account", to: "/user" },
        { title: "Video", icon: "mdi-video", to: "/video" },
        { title: "Video Report", icon: "mdi-video-off", to: "/report" },
      ],
    };
  },
};
</script>
