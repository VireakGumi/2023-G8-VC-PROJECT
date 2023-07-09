<template>
  <div>
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
            src="https://www.miraeassetmf.co.in/images/default-source/maq/registration.png?sfvrsn=aa71ff68_0"
          ></v-img>
        </v-col>

        <v-col cols="12" sm="6">
          <v-card-text class="text-center">
            <a class="text-white text-decoration-none">
              <h1>Register</h1>
            </a>
          </v-card-text>
          <div class="text-subtitle-1 text-medium-emphasis">
            <p>UserName</p>
          </div>

          <v-text-field
            density="compact"
            placeholder="UserName"
            variant="outlined"
            id="round"
          ></v-text-field>
          <div class="text-subtitle-1 text-medium-emphasis"><p>Email</p></div>

          <v-text-field
            density="compact"
            placeholder="Email"
            variant="outlined"
            id="round"
          ></v-text-field>

          <div
            class="text-subtitle-1 text-medium-emphasis d-flex align-center justify-space-between"
          >
            <p>Password</p>
          </div>

          <v-text-field
            :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
            :type="visible ? 'text' : 'password'"
            density="compact"
            placeholder="password"
            variant="outlined"
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
            density="compact"
            placeholder="comfirmpassword"
            variant="outlined"
            @click:append-inner="visible = !visible"
          ></v-text-field>

          <v-btn block class="mb-2" color="white" size="large" variant="tonal">
            Register
          </v-btn>

          <v-card-text class="text-center">
            <a class="text-blue text-decoration-none">
              <p>Register with socil accounts</p>
            </a>
          </v-card-text>

          <v-row class="ms-16">
            <div class="me-16">
              <v-img
                class="my-2"
                max-width="20"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/2008px-Google_%22G%22_Logo.svg.png"
              ></v-img>
            </div>

            <div class="me-16">
              <v-img
                class="my-2"
                max-width="20"
                src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Facebook_f_logo_%282021%29.svg/1200px-Facebook_f_logo_%282021%29.svg.png"
              ></v-img>
            </div>

            <div class="me-16">
              <v-img
                class="my-2"
                max-width="20"
                src="https://png.pngtree.com/png-clipart/20221019/original/pngtree-twitter-social-media-round-icon-png-image_8704823.png"
              ></v-img>
            </div>
          </v-row>
          <v-card-text class="text-center">
            <a class="text-blue text-decoration-none">
              <p>Have an accounts? <a href="">Login</a></p>
            </a>
          </v-card-text>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    visible: false,
  }),
};
</script>
<style>
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
</style>
