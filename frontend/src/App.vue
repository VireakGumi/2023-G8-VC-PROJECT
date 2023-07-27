<template>
  <div>
    <template v-if="userRole === 'admin'">
      <AdminNavTop />
    </template>
    <template v-else>
      <NavigationBar/>
    </template>
  </div>
</template>

<script>
import AdminNavTop from "./components/Nav/AdminNavTop.vue";
import NavigationBar from "./components/Nav/NavigationBar.vue";

export default {
  components: { AdminNavTop,NavigationBar },
  data() {
    return {
      userRole: ''
    }
  },
  methods: {
    reloadPage() {
      window.location.reload();
    },
  },
  created() {
    this.userRole = this.$cookies.get('user_role');
  }
};
</script>

<style scoped></style>
