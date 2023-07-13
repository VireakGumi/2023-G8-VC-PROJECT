<template>
  <v-card rounded="50" width="400px">
    <v-img
      :width="400"
      aspect-ratio="16/9"
      cover
      src="https://images.alphacoders.com/131/1314427.jpeg"
    ></v-img>
    <v-container class="d-flex mt-5 pa-0">
      <v-avatar rounded="50">
        <v-img
          cover
          src="https://images.alphacoders.com/131/1314427.jpeg"
        ></v-img>
      </v-avatar>
      <v-container class="pt-0 ma-0 text-white" rounded="50">
        <v-list-item-title> {{video.title}} </v-list-item-title>
        <v-list-item-subtitle> {{video.description}} </v-list-item-subtitle>
        <v-list-item-subtitle> {{video.viewer}} </v-list-item-subtitle>
      </v-container>
    </v-container>
    <v-btn
      class="mr-6 ml-8 mr-2 bg-white"
      rounded="pill"
      @click.stop="UploadDialog = true"
    >
      Edit
    </v-btn>
    <UploadDialog v-model="UploadDialog" />
  </v-card>
</template>

<script>
import UploadDialog from "../Dialog/UploadDialog.vue";

export default {
  props:["video"],
  components: {
    UploadDialog,
  },
  data() {
    return {
      UploadDialog: false,
    };
  },
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