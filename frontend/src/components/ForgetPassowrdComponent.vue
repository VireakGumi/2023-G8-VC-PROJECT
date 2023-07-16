<template>
  <div>
    <h2>Forgot Password</h2>
    <form @submit.prevent="submit">
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required />
      </div>
      <button type="submit">Reset Password</button>
    </form>
    <div v-if="message">{{ message }}</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      message: "",
    };
  },
  methods: {
    submit() {
      // Call the API to send a reset password email to the user's email address
      axios
        .post("/api/forgot-password", { email: this.email })
        .then((response) => {
          this.message = response.data.message;
        })
        .catch((error) => {
          this.message = error.response.data.message;
        });
    },
  },
};
</script>
