<template>
  <v-container class="w-auto mt-16 bg-lime-accent-3">
    <v-row
      class="justify-center bg-green-accent-4 mt-16"
      v-for="(_, n) in 100"
      :key="n"
    >
      <v-col v-for="(_, n) in 3" :key="n" cols="auto">
        <v-card
          height="100px"
          width="370px"
          :class="['d-flex justify-center align-center bg-secondary']"
        >
          <div>{{ n }}</div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {};
</script>
<style scoped>
.my-container {
  width: 100%;
}
</style>
