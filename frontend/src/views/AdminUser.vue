<template>
  <div class="pa-5 bg-blue-grey-darken-4">
    <h1>USER LISTS</h1>
    <v-divider :thickness="3"></v-divider>
    <v-row class="mt-1">
      <v-col lg="4" cols="12" v-for="user of userCard" :key="user">
        <v-card height="150px" elevation="3" rounded="lg" :color="user.color">
          <v-card-text
            class="fill-height d-flex justify-space-evenly align-center"
          >
            <div class="text-white">
              <h1>{{ user.quantity }}</h1>
              <small>{{ user.title }}</small>
            </div>
            <v-icon size="150px" class="my-icon">{{ user.icon }}</v-icon>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-row>
      <v-col lg="12">
        <v-table class="w-100 rounded">
          <thead>
            <tr>
              <th style="font-weight: bolder">
                <input type="checkbox" v-model="selectAll" class="mr-5" />Name
              </th>
              <th style="font-weight: bolder; text-align: center">Email</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>
                <input class="mr-5" type="checkbox" v-model="item.selected" />{{
                  item.full_name
                }}
              </td>
              <td style="text-align: center">{{ item.email }}</td>
              <td class="d-flex justify-end">
                <v-btn color="red" class="ma-1" @click="performAction(action)">
                  Block
                </v-btn>
                <v-btn color="red" class="ma-1" @click="performAction(action)">
                  Delete
                </v-btn>
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-col>
    </v-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      userBlock: 0,
      totalUsers: 0,
      newUsers: 0,
      selectAll: false,
      items: [],
      userCard: [
        {
          quantity: 0,
          title: "New Users",
          icon: "mdi-account-plus",
          color: "green-accent-4",
        },
        {
          quantity: 0,
          title: "Total Users",
          icon: "mdi-account-group",
          color: "light-blue-darken-3",
        },
        {
          quantity: 0,
          title: "Users Blocked",
          icon: "mdi-account-cancel",
          color: "red-lighten-1",
        },
      ],
    };
  },
  mounted() {
    this.getUser();
    this.getUserBlocked();
    this.getNewUser();
  },
  methods: {
    getNewUser() {
      this.$http
        .get("/users")
        .then((response) => {
          const today = new Date();
          const users = response.data.user;
          const newUsers = [];
          for (let i = 0; i < users.length; i++) {
            const createdAt = new Date(users[i].created_at);
            if (createdAt.toDateString() === today.toDateString()) {
              newUsers.push(users[i]);
            }
          }
          this.newUsers = newUsers.length;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getUser() {
      this.$http
        .get("/users")
        .then((response) => {
          this.items = response.data.user;
          this.totalUsers = response.data.user.length;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    getUserBlocked() {
      this.$http
        .get("/userblocked")
        .then((response) => {
          this.userBlock = response.data.data.length;
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    performAction(action) {
      // Perform the action based on the button that was clicked
      console.log(`Performing action: ${action.label}`);
    },
  },
  watch: {
    selectAll(value) {
      // Set the selected state of all items when the "select all" checkbox is toggled
      this.items.forEach((item) => (item.selected = value));
    },
    userBlock(newVal) {
      this.userCard[2].quantity = newVal;
    },
    totalUsers(newVal) {
      this.userCard[1].quantity = newVal;
    },
    newUsers(newVal) {
      this.userCard[0].quantity = newVal;
    },
  },
  created() {
    this.userCard[0].quantity = this.newUsers;
    this.userCard[1].quantity = this.totalUsers;
    this.userCard[2].quantity = this.userBlock;
  },
};
</script>
<style scoped>
.my-icon {
  opacity: 0.4;
}
</style>
