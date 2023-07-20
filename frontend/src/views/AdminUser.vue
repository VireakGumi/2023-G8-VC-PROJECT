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
        <v-table class="w-100 rounded" >
          <thead>
            <tr>
              <th style="font-weight: bolder;" >
                <input type="checkbox" v-model="selectAll" class="mr-5" />Name
              </th>
              <th style="font-weight: bolder; text-align: center">
                Date Of Birth
              </th>
              <th style="font-weight: bolder; text-align: center">Email</th>
              <!-- <th style="font-weight: bolder; text-align: center">Action</th> -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>
                <input class="mr-5" type="checkbox" v-model="item.selected" />{{
                  item.name
                }}
              </td>
              <td style=" text-align: center;" >{{ item.date }}</td>
              <td style=" text-align: center;">{{ item.email }}</td>
              <td class="d-flex justify-end">
                <template v-for="action in item.actions" :key="action">
                  <v-btn
                    color="red"
                    class="ma-1"
                    @click="performAction(action)"
                  >
                    {{ action.label }}
                  </v-btn>
                </template>
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
      selectAll: false,
      userCard: [
        {
          quantity: 2000,
          title: "New Users",
          icon: "mdi-account-plus",
          color: "green-accent-4",
        },
        {
          quantity: 20000,
          title: "Total Users",
          icon: "mdi-account-group",
          color: "light-blue-darken-3",
        },
        {
          quantity: 20,
          title: "Users Blocked",
          icon: "mdi-account-cancel",
          color: "red-lighten-1",
        },
      ],
      items: [
        {
          id: 1,
          name: "John Doe",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 2,
          name: "Jane Doe",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 3,
          name: "Bob Smith",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
        {
          id: 4,
          name: "Alice Johnson",
          date: "8-10-2003",
          email: "test321@gmail.com",
          actions: [{ label: "Block" }, { label: "Delete" }],
        },
      ],
    };
  },
  methods: {
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
  },
};
</script>
<style scoped>
.my-icon {
  opacity: 0.4;
}

</style>
