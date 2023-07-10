<template>
  <v-app>
   
    <!-- Categories section -->
    <v-container class="categories" fluid>
      <router-link class="btn" color="primary" to="/" dark>Home</router-link>
      <router-link class="btn" color="primary" to="/videos" dark>Videos</router-link>
      <router-link class="btn" color="primary" to="/playlist" dark>Playlists</router-link>
      <router-link class="btn" color="primary" to="/community" dark>Community</router-link>
      <router-link class="btn" color="primary" to="/channel" dark>Channels</router-link>
      <router-link class="btn" color="primary" to="about" dark>About</router-link>
      <input type="search" placeholder="Search" id="search" v-model="searchQuery" @input="search"/>
      <img src="../../assets/search.png" class="search" alt="" width="30" height="30">
    
    </v-container>
      <hr />
    <router-view></router-view>
  </v-app>
</template>

<script>
export default {
  name: "App",
};
</script>

<style scoped>

.categories {
  margin-top: 40px;
  margin-left: 0px;
  display: flex;
  flex-direction: row;
}

.btn {
  padding: 10px;
  border-radius: 10px;
  /* margin: 10px; */
  margin-right: 50px;
  text-decoration: none;
}

.card-container {
  margin: 30px;
}

.card {
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  margin: 10px;
  margin-bottom: 50px;
}


#search {
  border-radius: 10px;
  width: 15%;
  margin-left: 2%;
  margin-bottom: 10px;
}

#next {
  margin-top: -1%;
  margin-left: 7%;
}
.search {
  margin-top: 1%;
  margin-left: -3%;
  border-left: 1px solid black;
}
iframe {
  transition: transform 0.2s ease-in-out;
}

iframe:hover {
  transform: scale(1.05);
}
</style>
