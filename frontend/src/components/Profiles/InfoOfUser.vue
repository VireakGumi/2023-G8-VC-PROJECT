<template>
  <v-col class="profile-details">
      <h2>{{user_name}}</h2>
      <p>@{{ user_name }}</p>
      <p>200M subscribers</p>
  </v-col>
</template>

<script>
export default {
  data() {
    return {
      user_name: ""
    }
  },
  methods: {
    getUser() {
      this.user_name =         this.$cookies.get("full_name") !== "full_name" &&
      this.$cookies.get("full_name") !== null
        ? this.$cookies.get("full_name")
        : "";
    }
  },
  mounted() {
    this.getUser()
  }

}
</script>

<style scoped>

.profile-details {
margin-left: -5%;
margin-bottom: 30px;
}
</style>