<template>
  <v-col class="subscribe">
    <div v-if="!isSubscribed">
      <v-btn color="primary" class="btn" dark @click="subscribe"
        >Subscribe</v-btn
      >
    </div>

    <div v-else class="btn-option">
      <v-btn color="primary" class="btn" dark @click="toggleOptions">{{
        buttonText
      }}</v-btn>
      <div class="all-list" v-if="showSubscriptionOptions">
        <subscription-options-card
          :subscription-type="subscriptionType"
          @hide-options="hideOptions"
          @confirm-unsubscribe="confirmUnsubscribe"
        />
      </div>
    </div>

    <div class="overlay" v-if="showConfirmationDialog">
      <div class="confirm-dialog">
        <p>Are you sure you want to unsubscribe?</p>
        <button @click="unsubscribe">OK</button>
        <button @click="cancelUnsubscribe">Cancel</button>
      </div>
    </div>
  </v-col>
</template>

<script>
import SubscriptionOptionsCard from "./SubscribeOptionCard.vue";

export default {
  components: {
    SubscriptionOptionsCard,
  },
  data() {
    return {
      isSubscribed: false,
      subscriptionType: "",
      showSubscriptionOptions: false,
      buttonText: "Subscribe",
      showConfirmationDialog: false,
      
    };
  },
  computed: {
    selectedOption() {
      switch (this.subscriptionType) {
        case "all":
          return "All";
        case "personal":
          return "Personalised";
        case "none":
          return "None";
        case "unsubscribe":
          return "Unsubscribe";
        default:
          return "";
      }
    },
  },
  methods: {
    subscribe() {
      this.isSubscribed = true;
      this.subscriptionType = "";
      this.buttonText = "Subscribed";
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
      this.subscriptionType = "";
    },
    unsubscribe() {
      this.isSubscribed = false;
      this.subscriptionType = "";
      this.buttonText = "Subscribe";
      this.showSubscriptionOptions = false;
      this.showConfirmationDialog = false;
    },
  },
};
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
}

.btn-option {
  margin-right: 10%;
  width: 200%;
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
