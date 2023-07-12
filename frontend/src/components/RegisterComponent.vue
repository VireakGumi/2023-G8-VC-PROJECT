<template>
  <v-dialog v-model="dialog" width="100%">
    <div>
      <v-card class="mx-auto pa-12 pb-8" elevation="8" max-width="900" rounded="lg">
        <v-row>
          <v-col cols="12" sm="6">
            <v-img class="mx-auto my-6 mt-16" max-width="700"
              src="https://www.miraeassetmf.co.in/images/default-source/maq/registration.png?sfvrsn=aa71ff68_0"></v-img>
          </v-col>

          <v-col cols="12" sm="6">
            <v-card-text class="text-center">
              <a class="text-decoration-none">
                <h1>Register</h1>
              </a>
            </v-card-text>
            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
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

            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
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

            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
              <p>ComfirmPassword</p>
            </div>

            <v-text-field
              :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
              :type="visible ? 'text' : 'password'"
              :rules="[confirmPasswordRules, passwordConfirmationRule()]"
              density="compact"
              placeholder="confirmPassword"
              variant="outlined"
              v-model="confirmPassword"
              @click:append-inner="visible = !visible"
            ></v-text-field>

            <v-btn block class="mb-2 bg-blue" color="white" size="large" variant="tonal" @click="Register">
              Register
            </v-btn>

            <v-card-text class="text-center">
              <a class="text-blue text-decoration-none">
                <p>Register with social accounts</p>
              </a>
            </v-card-text>

            <v-row class="ms-16">
              <div class="me-12">
                <v-img class="my-2" max-width="20"
                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png"></v-img>
              </div>

              <div class="me-14">
                <v-img class="my-2" max-width="20"
                  src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Facebook_f_logo_%282021%29.svg/1200px-Facebook_f_logo_%282021%29.svg.png"></v-img>
              </div>

              <div class="me-12">
                <v-img class="my-2" max-width="20"
                  src="https://png.pngtree.com/png-clipart/20221019/original/pngtree-twitter-social-media-round-icon-png-image_8704823.png"></v-img>
              </div>

              <div class="me-4">
                <v-img class="my-2" max-width="20"
                  src="https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_instagram-512.png"></v-img>
              </div>
            </v-row>
            <v-card-text class="text-center">
              <a class="text-blue text-decoration-none">
                <p>Have an accounts? <span class="login" @click="setForm">Login</span></p>
              </a>
            </v-card-text>
          </v-col>
        </v-row>
      </v-card>
    </div>
  </v-dialog>
</template>

<script>
import axios from "axios";
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
    confirmPasswordRules: [(value) => !!value || "type confirm password"],
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
    Register() {
      let value = {
        full_name: this.full_name,
        email: this.email,
        password: this.password,
        comfirm_password: this.confirmPassword,
      };
      axios
        .post("http://172.16.1.106:8000/api/register", value)
        .then((response) => {
          document.cookie = "token=" + response.data.token;
          document.cookie = "user_id=" + response.data.user.id;
          document.cookie = "full_name=" + response.data.user.full_name;
          document.cookie = "email=" + response.data.user.email;
          this.full_name = "";
          this.email = "";
          this.password = "";
          this.confirmPassword = "";
          this.dialog = false;
          this.$emit("isShow", false);
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
    }
  },
};
</script>

<style scoped>
.v-card {
  background-color: #15202b;
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

.v-text-field .v-field__field {
  background: white !important;
  color: black;
  border-radius: 5px;
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
</style>
