<template>
  <AdminNavTop />
  <!-- <v-layout class="bg-surface-variant ma-0 pa-0 bg-red-accent-4" width="100%">
    <v-row no-gutters>
      <v-col>
        <navigation-bar @reloadPage="reloadPage" />
      </v-col>
    </v-row>
    <v-row no-gutters style="overflow-y: hidden" class="ml-10 mt-16 w-100">
      <v-col>
        <router-view />
      </v-col>
    </v-row>
  </v-layout> -->
</template>
<script>
import AdminNavTop from "./components/Nav/AdminNavTop.vue";
export default {
  components: { AdminNavTop },
  methods: {
    reloadPage() {
      window.location.reload();
    },
  },
};
</script>
<style scoped></style>
