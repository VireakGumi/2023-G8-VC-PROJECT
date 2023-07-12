<template>
  <v-layout class="bg-surface-variant ma-0 pa-0 bg-red-accent-4"  width="100%">
    <v-row no-gutters>
      <v-col>
        <navigation-bar />
      </v-col>
    </v-row>
    <v-row no-gutters class="ml-13 mt-16 w-100">
      <v-col>
        <router-view/>
      </v-col>
    </v-row>
  </v-layout>
</template>
<script>
// import SideBar from './components/Nav/SideBar.vue';
export default {};
</script>
<style>
</style>
