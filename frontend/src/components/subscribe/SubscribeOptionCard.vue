<template>
  <div class="subscription-options-card">
    <input type="radio" id="all" name="subscription-type" value="all" v-model="subscriptionType" @change="hideOptions">
    <label for="all">All</label><br>
    <input type="radio" id="personal" name="subscription-type" value="personal" v-model="subscriptionType" @change="hideOptions">
    <label for="personal">Personalised</label><br>
    <input type="radio" id="none" name="subscription-type" value="none" v-model="subscriptionType" @change="hideOptions">
    <label for="none">None</label><br>
    <input type="radio" id="unsubscribe" name="subscription-type" value="unsubscribe" v-model="subscriptionType" @change="confirmUnsubscribe">
    <label for="unsubscribe">Unsubscribe</label><br>
  </div>
</template>

<script>
export default {
  props: {
    subscriptionType: String
  },
  methods: {
    hideOptions() {
      this.$emit('hide-options');
    },
    confirmUnsubscribe() {
      this.$emit('confirm-unsubscribe');
    }
  }
}
</script>

<style scoped>
.subscription-options-card {
  padding: 10px;
  background-color: white;
  border: 1px solid black;
  border-radius: 5px;
}
</style>