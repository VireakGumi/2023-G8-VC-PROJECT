<template>
  <v-dialog v-model="dialog" width="100%">
    <div class="cards">
      <v-card
        class="mx-auto pb-8"
        elevation="8"
        max-width="900"
        rounded="lg"
        style="max-height: 550px; overflow-y: auto"
      >
        <v-row>
          <v-col cols="12" sm="6" class="d-flex ma-0 pa-0">
            <v-img
              class="mx-auto"
              max-width="700"
              :src="require('@/assets/registration.png')"
            ></v-img>
          </v-col>

          <v-col cols="12" sm="6">
            <v-card-text class="text-center">
              <a class="text-decoration-none">
                <h1>Register</h1>
              </a>
            </v-card-text>
            <div
              class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
              <p>UserName</p>
            </div>

            <v-text-field
              density="compact"
              :rules="rules"
              placeholder="full_name"
              variant="outlined"
              id="round"
              v-model="full_name"
            ></v-text-field>
            <div
              class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
              <p>Email</p>
            </div>

            <v-text-field
              density="compact"
              :rules="emailRules"
              placeholder="email"
              variant="outlined"
              id="round"
              v-model="email"
            ></v-text-field>

            <div
              class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
              <p>Password</p>
            </div>

            <v-text-field
              :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
              :type="visible ? 'text' : 'password'"
              :rules="passwordRules"
              density="compact"
              placeholder="password"
              variant="outlined"
              v-model="password"
              @click:append-inner="visible = !visible"
            ></v-text-field>

            <div
              class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
              <p>ComfirmPassword</p>
            </div>

            <v-text-field
              :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
              :type="visible ? 'text' : 'password'"
              :rules="[...confirmPasswordRules, passwordConfirmationRule()]"
              density="compact"
              placeholder="confirmPassword"
              variant="outlined"
              v-model="confirmPassword"
              @click:append-inner="visible = !visible"
            ></v-text-field>

            <v-btn
              block
              class="mb-2 bg-blue"
              color="white"
              size="large"
              variant="tonal"
              @click="Register"
            >
              Register
            </v-btn>

            <v-card-text class="text-center">
              <a class="text-blue text-decoration-none">
                <p>Register with social accounts</p>
              </a>
            </v-card-text>

            <div class="d-flex justify-center justify-space-evenly">
              <v-img
                class="my-2"
                max-width="25"
                :src="require('@/assets/google.png')"
              ></v-img>
              <v-img
                class="my-2"
                max-width="25"
                :src="require('@/assets/facebook.png')"
              ></v-img>
              <v-img
                class="my-2"
                max-width="32"
                :src="require('@/assets/twitter.png')"
              ></v-img>
              <v-img
                class="my-2"
                max-width="25"
                :src="require('@/assets/instagrame.png')"
              ></v-img>
            </div>
            <v-card-text class="text-center">
              <a class="text-blue text-decoration-none">
                <p>
                  Have an accounts?
                  <span class="login" @click="setForm">Login</span>
                </p>
              </a>
            </v-card-text>
          </v-col>
        </v-row>
      </v-card>
    </div>
  </v-dialog>
</template>

<script>
export default {
  props: {
    value: Boolean,
  },
  data: () => ({
    visible: false,
    loginForm: false,
    full_name: "",
    email: "",
    password: "",
    confirmPassword: "",
    rules: [(value) => !!value || "Required!"],
    emailRules: [
      (v) =>
        /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
        "E-mail must be valid",
    ],
    passwordRules: [
      (value) => !!value || "Please type password.",
      (value) =>
        /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/.test(
          value
        ) || "password required number, charaters, sign, and last 8",
    ],
    confirmPasswordRules: [(v) => !!v || "Confirm Password is required"],
  }),
  computed: {
    dialog: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
  methods: {
    userRole(role) {
      if (role == 3) {
        return "admin";
      } else if (role == 2) {
        return "content-creator";
      } else {
        return "user";
      }
    },
    Register() {
      let value = {
        full_name: this.full_name,
        email: this.email,
        password: this.password,
        confirm_password: this.confirmPassword,
      };
      this.$http
        .post("/register", value)
        .then((response) => {
          document.cookie = "token=" + response.data.token;
          document.cookie = "user_id=" + response.data.user.id;
          document.cookie = "full_name=" + response.data.user.full_name;
          document.cookie = "email=" + response.data.user.email;
          document.cookie = "user_role=" + this.userRole(response.data.user.role_id);
          this.full_name = "";
          this.email = "";
          this.password = "";
          this.confirmPassword = "";
          this.dialog = false;
          this.$emit("isShow", false);
          // Replace this line with a valid statement
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    passwordConfirmationRule() {
      return () =>
        this.password === this.confirmPassword || "Password must match";
    },
    setForm() {
      this.$emit("show", { register: false, login: true });
    },
  },
};
</script>

<style scoped>
.v-card {
  background-color: #252525;
}

p {
  color: white;
}

.v-btn {
  background-color: #5d5bd0;
}

.v-field__append-inner {
  background: white !important;
  color: black;
  border-radius: 0px 5px 5px 0px;
  padding-right: 0px;
}

.v-field {
  background-color: white;
}

a {
  color: white;
}

#round {
  border-radius: 5px !important;
}

.v-row {
  margin-right: 5%;
}

.login {
  color: rgb(0, 149, 255);
  cursor: pointer;
}
.v-text-field {
  background: white !important;
  border-radius: 5px;
  height: 44px;
  margin-bottom: 25px;
}
</style>
