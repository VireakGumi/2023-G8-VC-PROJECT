<template>
  <v-col class="subscribe">
    <div>
      <v-btn color="primary" class="btn" dark @click="subscribe">Manage Videos</v-btn>
    </div>
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
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.confirm-dialog {
  width: 50%;
  margin: 0 auto;
  background-color: white;
  padding: 20px;
  border: 1px solid black;
  border-radius: 5px;
}

.btn-option {
  margin-right: 10%;
  width: 200%;
}

.all-list{
  width: 230%;
  margin-bottom: 20px;
  margin-top:10px;
}

.subscribe {
  margin-top: 40px;
  margin-left: 50%;
}

button {
  color: white;
  background: #15202b;
  border: none;
  margin: 5px;
  padding: 5px;
  border-radius: 10px;
  text-align: start;
}

</style>