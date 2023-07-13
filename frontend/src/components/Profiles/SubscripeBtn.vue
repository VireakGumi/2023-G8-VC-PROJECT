<template>
  <v-col class="subscribe">
    <div>
      <router-link to="/creator"><button class="btn">Manage Videos</button></router-link>
    </div>
  <router-view></router-view>
  </v-col>
</template>

<script>
export default {
  data() {
    return {
      
    }
  },
}
</script>

<style scoped>

.subscribe {
  margin-top: 40px;
  margin-left: 50%;
}

.btn {
  padding: 10px;
  color: white;
  background: #15202b;
  border: none;
  margin: 5px;
  padding: 5px;
  border-radius: 10px;
  text-align: start;
}

</style>