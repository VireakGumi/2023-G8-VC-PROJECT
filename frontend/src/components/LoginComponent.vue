<template>
  <v-dialog v-model="dialog" width="100%">
    <div class="cards">
      <v-card class="mx-auto pa-12 pb-8" elevation="8" max-width="900" rounded="lg">
        <v-row>
          <v-col cols="12" sm="6">
            <v-img class="mx-auto my-6 mt-16" max-width="700"
              src="https://www.miraeassetmf.co.in/images/default-source/maq/registration.png?sfvrsn=aa71ff68_0"></v-img>
          </v-col>

          <v-col cols="12" sm="6">
            <v-card-text class="text-center">
              <a class="text-white text-decoration-none">
                <h1>Login</h1>
              </a>
            </v-card-text>
            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
              <p>Email</p>
            </div>

            <v-text-field density="compact" :rules="emailRules" placeholder="email" variant="outlined" id="round"
              v-model="email"></v-text-field>

            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
              <p>Password</p>
            </div>

            <v-text-field :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'"
              :rules="rules" density="compact" placeholder="password" variant="outlined" v-model="password"
              @click:append-inner="visible = !visible"></v-text-field>
            <span v-if="wrong">
              <h4>Incorrect</h4>
            </span>
            <div class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between">
              <p></p>
              <a class="text-caption text-decoration-none text-blue" href="#" rel="noopener noreferrer" target="_blank">
                Forgot login password?</a>
            </div>

            <v-btn block class="mb-2" color="white" size="large" variant="tonal" @click="login">
              Sign in
            </v-btn>

            <v-card-text class="text-center">
              <a class="text-blue text-decoration-none">
                <p>Login with social accounts</p>
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
                <p>Don't have an accounts? <span class="register" @click="setForm">Register</span>
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
import axios from "axios";
import RegisterForm from "./RegisterComponent.vue"
export default {
  components: {
    RegisterForm
  },
  props: {
    value: Boolean,
  },
  data: () => ({
    registerForm: false,
    wrong: false,
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
    login() {
      let value = { email: this.email, password: this.password };
      axios.post("http://localhost:8000/api/login", value).then((response) => {
        document.cookie = "token=" + response.data.token;
        document.cookie = "user_id=" + response.data.user.id;
        document.cookie = "full_name=" + response.data.user.full_name;
        document.cookie = "email=" + response.data.user.email;
        this.password = "";
        this.email = "";
        this.dialog = false;
        this.$emit("isShow", false);

      }).catch((error) => {
        console.log(error.response);
        this.wrong = false;
      });
    },
    setForm() {
      this.$emit("show", { register: true, login: false });
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

.v-text-field .v-field__field {
  background: white !important;
  color: black;
  border-radius: 5px;
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

#round {
  border-radius: 5px !important;
}

a {
  color: white;
}

h4 {
  color: rgb(201, 98, 2);
}

.register {
  color: rgb(0, 149, 255);
  cursor: pointer;
}
</style>
