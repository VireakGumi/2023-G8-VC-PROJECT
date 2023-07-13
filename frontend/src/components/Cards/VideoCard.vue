<template>
  <v-card rounded="50" width="400px">
    <div style="width: 400px; height: 255px;">
      <img :src="video.thumbnail" alt="" style="width: 100%;height: 100%;">
    </div>
    <v-container class="d-flex mt-5 pa-0">
      <v-avatar rounded="50">
        <v-img
          cover
          src="https://images.alphacoders.com/131/1314427.jpeg"
        ></v-img>
      </v-avatar>
      <v-container class="pt-0 ma-0 text-white" rounded="50">
        <v-list-item-title> {{ video.title }} </v-list-item-title>
        <v-list-item-subtitle> {{ video.description }} </v-list-item-subtitle>
        <v-list-item-subtitle> {{ video.viewer }} </v-list-item-subtitle>
      </v-container>
    </v-container>
  </v-card>
</template>
<script>
export default {
  props: ["video"],
};
</script>
<style scoped>
.group-pf {
  display: flex;
}
.v-card-title p {
  font-size: small;
}
.v-card {
  box-shadow: none;
}
</style>
