<template>
  <v-dialog v-model="dialog" width="100%">
    <div class="cards">
      <v-card
        class="mx-auto pa-12 pb-8"
        elevation="8"
        max-width="900"
        rounded="lg"
      >
        <v-row>
          <v-col cols="12" sm="6">
            <v-img
              class="mx-auto my-6 mt-16"
              max-width="700"
              :src="require('@/assets/registration.png')"
            ></v-img>
          </v-col>

          <v-col cols="12" sm="6">
            <v-card-text class="text-center">
              <a class="text-white text-decoration-none">
                <h1>Login</h1>
              </a>
            </v-card-text>
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
              :rules="rules"
              density="compact"
              placeholder="password"
              variant="outlined"
              v-model="password"
              @click:append-inner="visible = !visible"
            ></v-text-field>
            <div
              class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
            >
              <p></p>
              <a
                class="text-caption text-decoration-none text-blue"
                href="#"
                rel="noopener noreferrer"
                target="_blank"
              >
                Forgot login password?</a
              >
            </div>

            <v-btn
              block
              class="mb-2"
              color="white"
              size="large"
              variant="tonal"
              @click="login"
            >
              Sign in
            </v-btn>
            <v-card-text class="text-center">
              <a class="text-blue text-decoration-none">
                <p>Login with social accounts</p>
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
                  Don't have an accounts?
                  <span class="register" @click="setForm">Register</span>
                </p>
              </a>
            </v-card-text>
          </v-col>
        </v-row>
      </v-card>
    </div>
    <RegisterForm v-model="registerForm" />
  </v-dialog>
</template>
<script>
import RegisterForm from "./RegisterComponent.vue";
export default {
  components: {
    RegisterForm,
  },
  props: {
    value: Boolean,
  },
  data: () => ({
    registerForm: false,
    wrong: false,
    errorMessage: "",
    visible: false,
    password: "",
    email: "",
    rules: [(value) => !!value || "Required!"],
    emailRules: [
      (v) =>
        /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
        "E-mail must be valid",
    ],
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
      if (role == 2) {
        return "admin";
      } else {
        return "user";
      }
    },
    login() {
        let value = { email: this.email, password: this.password };
        this.$http
          .post("/login", value)
          .then((response) => {
            document.cookie = "token=" + response.data.token;
            document.cookie = "user_id=" + response.data.user.id;
            document.cookie = "full_name=" + response.data.user.full_name;
            document.cookie = "email=" + response.data.user.email;
            document.cookie = "user_role=" + this.userRole(response.data.user.role_id);

            this.password = "";
            this.email = "";
            this.dialog = false
            window.location.reload();
          })
          .catch((error) => {
            console.log(error.response);
          });
    },
    setForm() {
      this.$emit("show", { register: true, login: false });
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

.v-text-field {
  background: white !important;
  border-radius: 5px;
  height: 44px;
  margin-bottom: 25px;
}

.v-field__append-inner {
  background: white !important;
  color: white !important;
  border-radius: 0px 5px 5px 0px;
  padding-right: 0px;
}

.v-field {
  background-color: white;
  color: white !important;
}

#round {
  border-radius: 5px !important;
}

a {
  color: white;
}

span {
  color: red;
}

.register {
  color: rgb(0, 149, 255);
  cursor: pointer;
}
</style>
