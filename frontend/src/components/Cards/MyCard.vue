<template>
  <video
    style="width: 30%; height: 30%"
    :key="id"
    v-show="data.id"
    :src="data.src"
    :type="data.type"
    controls
  ></video>
  <div>
    <v-card-title class="mr-16">Title: {{ data.title }} </v-card-title>
    <div class="d-flex">
      <img
        width="40"
        height="40"
        style="border-radius: 50%; margin-left: 15px"
        src="../../assets/logo.png"
      />
    </div>
    <v-card-title class="ml-3">User_id: {{ data.user_id }}</v-card-title>
    <v-card-subtitle>Description: {{ data.description }} </v-card-subtitle>
    <v-card-subtitle style="margin-right: 90px"                                                                                                 
      >Viewer: {{ data.viewer }}
    </v-card-subtitle>
  </div>
</template>

<script>
export default {
  props: ["data"],
};
</script>

<style>

</style>