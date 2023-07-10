<template>
  <div class="subscribe">
    <div v-if="!isSubscribed">
      <button @click="subscribe">Subscribe</button>
    </div>

    <div v-else>
      <button @click="toggleOptions"><img src="../../assets/all.png" alt="" width="15" height="15"> {{ buttonText }}</button>
      <div v-if="showSubscriptionOptions" class="subscribe-user">
        <input type="radio" id="all" name="subscription-type" value="all" v-model="subscriptionType" @change="hideOptions">
        <label for="all"><img src="../../assets/all.png" alt="" width="15" height="15"> All</label><br>
        <input type="radio" id="personal" name="subscription-type" value="personal" v-model="subscriptionType" @change="hideOptions">
        <label for="personal"><img src="../../assets/personal.png" alt="" width="15" height="15"> Personalised</label><br>
        <input type="radio" id="none" name="subscription-type" value="none" v-model="subscriptionType" @change="hideOptions">
        <label for="none"><img src="../../assets/none.png" alt="" width="15" height="15"> None</label><br>
        <input type="radio" id="unsubscribe" name="subscription-type" value="unsubscribe" v-model="subscriptionType" @change="confirmUnsubscribe">
        <label for="unsubscribe">-<img src="../../assets/unuser.png" alt="" width="15" height="15"> Unsubscribe</label><br>
      </div>
    </div>

    <div class="overlay" v-if="showConfirmationDialog">
      <div class="confirm-dialog">
        <p>Are you sure you want to unsubscribe?</p>
        <button @click="unsubscribe">OK</button>
        <button @click="cancelUnsubscribe">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isSubscribed: false,
      subscriptionType: '',
      showSubscriptionOptions: false,
      buttonText: 'Subscribe',
      showConfirmationDialog: false
    }
  },
  computed: {
    selectedOption() {
      switch (this.subscriptionType) {
        case 'all':
          return 'Subscribed';
        case 'personal':
          return 'Subscribed';
        case 'none':
          return 'Subscribed';
        case 'unsubscribe':
          return 'Unsubscribe';
        default:
          return '';
      }
    }
  },
  methods: {
    subscribe() {
      this.isSubscribed = true;
      this.subscriptionType = '';
      this.buttonText = 'Subscribed';
      this.showSubscriptionOptions = false;
    },
    toggleOptions() {
      this.showSubscriptionOptions = !this.showSubscriptionOptions;
    },
    hideOptions() {
      this.buttonText = this.selectedOption;
      this.showSubscriptionOptions = false;
    },
    confirmUnsubscribe() {
      this.showConfirmationDialog = true;
    },
    cancelUnsubscribe() {
      this.showConfirmationDialog = false;
      // Reset the radio button to the previous value
      this.subscriptionType = '';
    },
    unsubscribe() {
      this.isSubscribed = false;
      this.subscriptionType = '';
      this.buttonText = 'Subscribe';
      this.showSubscriptionOptions = false;
      this.showConfirmationDialog = false;
    }
  }
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

.subscribe {
  width: 23%;
  margin-top: 1%;
  margin-right: -8%;
}

.subscribe-user {
    color: white;
    width: 50%;
    height: 100%;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    background: rgb(188, 185, 185);
}

input, label {
    margin-top: 25px;
    padding: 10px;
}

input:hover, label:hover {
    background: teal;
}

.confirm-dialog {
  background-color: white;
  padding: 20px;
  border: 1px solid black;
  border-radius: 5px;
}

button {
    background: rgb(188, 185, 185);
    border: none;
    width: 50%;
    padding: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    color: white;
}
</style>