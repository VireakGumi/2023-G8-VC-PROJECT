<template>
  <div class="pa-5 bg-blue-grey-darken-4 fill-height">
    <h1>USER LISTS</h1>
    <v-divider :thickness="3"></v-divider>
    <v-row class="mt-1">
      <v-col lg="4" cols="12" v-for="(user, index) of userCard" :key="index">
        <v-card
          height="150px"
          elevation="3"
          rounded="lg"
          :color="user.color"
          @click="showDialog = index === userCard.length - 1"
        >
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

    <v-dialog v-model="showDialog" max-width="800" >
      <v-card class="fill-height pa-6">
        <v-card-title><h2>Blocked Users</h2></v-card-title>
        <v-table v-if="blockedUsers != ''" class="w-100 rounded">
          <thead>
            <tr>
              <th style="font-weight: bolder; text-align: center">Full Name</th>
              <th style="font-weight: bolder; text-align: center">Email</th>
              <th style="font-weight: bolder; text-align: center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="blocked in blockedUsers" :key="blocked.id">
              <td style="text-align: center">
                {{ blocked.full_name }}
              </td>
              <td style="text-align: center">{{ blocked.email }}</td>
              <td class="d-flex justify-center">
                <v-btn
                  color="primary"
                  class="ma-1"
                  @click="unblockUser(blocked.id)"
                >
                  Unblock
                </v-btn>
              </td>
            </tr>
          </tbody>
        </v-table>
        <div v-else height="100vh" class="text-center mt-16 mb-16">
          <h2>{{ message }}</h2>
        </div>
        <v-btn color="primary" @click="showDialog = false">Close</v-btn>
      </v-card>
    </v-dialog>

    <v-progress-linear
      v-if="loading"
      color="red"
      height="7"
      indeterminate
      class="my-5"
    ></v-progress-linear>

    <v-dialog v-model="blockDialog" max-width="500px">
      <v-card>
        <v-card-title>
          {{ userToDelete ? "Delete User" : "Block User" }}
        </v-card-title>
        <v-card-text>
          <p>
            {{
              userToDelete
                ? "Are you sure you want to delete this user?"
                : "Are you sure you want to block this user?"
            }}
          </p>
        </v-card-text>
        <v-card-actions>
          <v-btn color="green darken-1" text @click="blockDialog = false">
            Cancel
          </v-btn>
          <v-btn
            color="red darken-1"
            text
            @click="
              userToDelete ? deleteUser(userToDelete) : blockUser(userToBlock);
              blockDialog = false;
            "
          >
            Confirm
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-row>
      <v-col lg="12">
        <v-table class="w-100 rounded">
          <thead>
            <tr>
              <th style="font-weight: bolder; text-align: center">Full Name</th>
              <th style="font-weight: bolder; text-align: center">Email</th>
              <th style="font-weight: bolder; text-align: center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td style="text-align: center">
                {{ item.full_name }}
              </td>
              <td style="text-align: center">{{ item.email }}</td>
              <td class="d-flex justify-end">
                <v-btn
                  color="warning"
                  class="ma-1"
                  @click="(userToBlock = item.id), (blockDialog = true)"
                >
                  Block
                </v-btn>
                <v-btn
                  color="red"
                  class="ma-1"
                  @click="(userToDelete = item.id), (blockDialog = true)"
                >
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
      message: "Don't have users blocked",
      blockedUsers: [],
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
      loading: false,
      blockDialog: false,
      userToDelete: null,
      userToBlock: null,
      showDialog: false,
    };
  },
  methods: {
    async getNewUser() {
      try {
        const response = await this.$http.get("/users");
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
      } catch (error) {
        console.log(error);
      }
    },
    async getUser() {
      try {
        const response = await this.$http.get("/users");
        this.items = response.data.user;
        this.totalUsers = response.data.user.length;
      } catch (error) {
        console.log(error.message);
      }
    },
    async Blocked() {
      try {
        const response = await this.$http.get("/blockeduser");
        this.blockedUsers = response.data.data;
        console.log(this.blockedUsers);
      } catch (error) {
        console.log(error);
      }
    },
    async getUserBlocked() {
      try {
        const response = await this.$http.get("/userblocked");
        this.userBlock = response.data.data.length;
        this.Blocked();
      } catch (error) {
        console.log(error);
      }
    },

    async blockUser(id) {
      try {
        await this.$http.post("/admin/" + id);
        this.getUserBlocked();
      } catch (error) {
        console.log(error.message);
      }
    },
    async unblockUser(id) {
      try {
        await this.$http.delete("/admin/unblock/" + id);
        this.getUserBlocked();
      } catch (error) {
        console.log(error.message);
      }
    },
    async deleteUser(id) {
      try {
        await this.$http.delete("/admin/" + id);
        await this.getUser();
        await this.getUserBlocked();
        await this.getNewUser();
      } catch (error) {
        console.log(error.message);
      }
    },
  },
  watch: {
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
  async mounted() {
    this.loading = true;
    await Promise.all([
      this.getUser(),
      this.getUserBlocked(),
      this.getNewUser(),
    ]);
    this.loading = false;
  },
};
</script>

<style scoped>
.my-icon {
  opacity: 0.6;
}
</style>
