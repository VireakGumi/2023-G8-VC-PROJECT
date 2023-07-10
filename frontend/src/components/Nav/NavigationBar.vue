<template>
  <v-layout class="w-100">
    <v-app-bar app color="#15202B">
      <template v-slot:prepend>
        <img
          src="../../assets/menu.png"
          @click.stop="drawer = !drawer"
          class="ml-4 mr-6"
          width="35"
          alt=""
        />
      </template>
      <v-app-bar-logo>
        <img src="../../assets/logo.png" width="35" class="mr-16 mt-2" />
      </v-app-bar-logo>

      <v-text-field
        density="compact"
        variant="solo"
        label="Search Videos"
        append-inner-icon="mdi-magnify"
        single-line
        hide-details
        rounded="pill"
      ></v-text-field>

      <v-btn
        class="my-btn mr-6 ml-8 mr-2"
        prepend-icon="account"
        rounded="pill"
        to="/register"
      >
        Sign in
      </v-btn>
    </v-app-bar>

    <!-- <v-toolbar  class="mt-16 " density="compact" color="#15202B">
      <v-sheet class="w-100 ml-16"  >
        <v-slide-group show-arrows>
          <v-slide-group-item
            v-for="n in 3"
            :key="n"
            v-slot="{ isSelected, toggle }"
          >
            <v-btn
              density="compact"
              class="ma-2"
              rounded
              :color="isSelected ? 'primary' : undefined"
              @click="toggle"
            >
              Options {{ n }}
            </v-btn>
          </v-slide-group-item>
        </v-slide-group>
      </v-sheet>
    </v-toolbar> -->

    <v-navigation-drawer
      v-model="drawer"
      :width="200"
      temporary
      dark
      color="#15202B"
      class="sidebar-drawer"
    >
      <v-list>
        <v-list-item v-for="item in items" :key="item.title" link>
          <v-list-item-icon class="d-flex">
            <v-list-item-icon>
              <v-icon class="ms-2" color="white" x-large>{{
                item.icon
              }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="text-white ml-9">{{
                item.title
              }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item-icon>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-navigation-drawer
      color="#15202B"
      app
      class="d-flex flex-column"
      width="75px"
    >
      <v-list-item v-for="item in items" :key="item.title" link>
        <v-list-item-icon class="d-flex">
          <v-list-item-icon>
            <v-icon class="ma-2" color="white" x-large>{{ item.icon }}</v-icon>
          </v-list-item-icon>
        </v-list-item-icon>
      </v-list-item>
    </v-navigation-drawer>
    <v-layout class="w-100">
      <side-bar />
    </v-layout>
  </v-layout>
</template>
<script>
export default {
  data() {
    return {
      drawer: false,
      items: [
        { title: "Home", icon: "mdi-home" },
        { title: "Upload", icon: "mdi-video-plus" },
        { title: "History", icon: "mdi-history" },
        { title: "Message", icon: "mdi-email-outline" },
        { title: "Bookmark", icon: "mdi-bookmark-outline" },
        { title: "Playlist", icon: "mdi-playlist-play" },
        { title: "More", icon: "mdi-dots-horizontal-circle-outline" },
      ],
    };
  },
};
</script>
<style scoped>
.my-btn {
  background: #ffffff;
}
</style>
