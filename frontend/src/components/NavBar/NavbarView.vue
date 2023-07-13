<template>
  <v-card class="card">
    <v-toolbar>
      <!-- <template v-slot:extension> -->
      <v-tabs v-model="tab" align-tabs="title">
        <v-tab v-for="item in items" :key="item" :value="item">
          {{ item.name }}
        </v-tab>
      </v-tabs>
        <input
          type="search"
          placeholder="Search"
          id="search"
          v-model="searchQuery"
          @input="search"
        />
        <img
          src="../../assets/search.png"
          class="search"
          alt=""
          width="30"
          height="30"
        />
      <!-- </template> -->
    </v-toolbar>
    <hr />
    <v-window v-model="tab">
      <v-window-item v-for="item in items" :key="item.name" :value="item">
        <v-card flat>
          <component :is="item.component" />
        </v-card>
      </v-window-item>
    </v-window>
  </v-card>
</template>

<script>
import MyHome from "../creator/MyHome.vue";
import MyVideo from "../creator/MyVideos.vue";
import MyPlaylist from "../creator/MyPlaylist.vue";
import MyCommunity from "../creator/MyCommunity.vue";
import MyChannel from "../creator/MyChannel.vue";
import MyAbout from "../creator/MyAbout.vue";

export default {
  name: "App",
  components: {
    MyHome,
    MyVideo,
    MyPlaylist,
    MyCommunity,
    MyChannel,
    MyAbout,
  },
  data() {
    return {
      tab: null,
      items: [
        { name: "Home", component: "MyHome" },
        { name: "Videos", component: "MyVideo" },
        { name: "Playlists", component: "MyPlaylist" },
        { name: "Community", component: "MyCommunity" },
        { name: "Channels", component: "MyChannel" },
        { name: "About", component: "MyAbout" },
      ],
    };
  },
};
</script>

<style scoped>
.v-toolbar {
  background: white;
  border: none;
}

.v-tabs {
  padding: 5px;
}

.card {
  background: white;
}

#search {
  border-radius: 10px;
  width: 40%;
  padding: 10px;
  margin-left: 2%;
}

#next {
  margin-top: -1%;
  margin-left: 7%;
}
.search {
  margin-top: 0.5%;
  margin-left: -5%;
  border-left: 1px solid black;
}

iframe {
  transition: transform 0.2s ease-in-out;
}

iframe:hover {
  transform: scale(1.05);
}
</style>
