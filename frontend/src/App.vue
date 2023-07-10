<template>
  <v-app>
    <!-- Profile section -->
    <Profile-Page/>
  </v-app>
</template>

<script>
import CoverPage from './views/ProfilePage/CoverPage.vue'
export default {
  name: "App",
  components:{
    "Profile-Page": CoverPage,
  },
};
</script>

<style>
body {
  font-family: sans-serif;
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

.categories {
  margin-top: 40px;
  margin-left: 30px;
  display: flex;
  flex-direction: row;
}

.btn {
    width: 100px;
    margin: 10px;
    text-align: center;
}

.btn a {
    color: white;
    text-decoration: none;
}

.btn:hover {
    background: rgba(235, 209, 62, 0.927);
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


.viewer {
  font-size: small;
}

.text {
  margin-left: 17px;
}

p {
  margin: 0;
}

.categories {
  margin-top: 40px;
  margin-bottom: -10px;
  margin-left: 40px;
  display: flex;
  flex-direction: row;
}

.btn {
  margin: 10px;
}

iframe {
  transition: transform 0.2s ease-in-out;
  margin-bottom: 10px;
}

iframe:hover {
  transform: scale(1.05);
}
</style>
