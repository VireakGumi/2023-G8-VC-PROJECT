<template>
  <div id="report">
    <div class="ml-4">
      <v-text class="text-h4 font-weight-black ml-4">Report</v-text>
      <p class="ml-4">Here are the lists of video that users report.</p>
      <v-btn active class="ml-4 mt-4 rounded-xl text-body-2">All reports</v-btn>
      <v-btn class="ml-4 mt-4 rounded-xl text-body-2">Currently reports</v-btn>
      <v-table>
        <thead>
          <tr>
            <th class="text-left">User Name</th>
            <th class="text-left">Content video</th>
            <th class="text-left">Type's report</th>
            <th class="text-left">Comment</th>
            <th class="text-left">View Detail</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.name">
            <td>
              <img
                src="https://w7.pngwing.com/pngs/1003/701/png-transparent-dog-walking-pet-sitting-dog-food-dog-animals-pet-dog-like-mammal.png"
                alt=""
              />
              <v-text>{{ user.user.full_name }}</v-text>
            </td>
            <td>{{ user.content }}</td>
            <td>{{ user.type_report }}</td>
            <td>{{ user.comment }}</td>
            <td>
              <router-link
                :to="{ name: 'videodetail', params: { id: user.video.id } }"
              >
                {{ user.video.title }}
              </router-link>
            </td>
            <td>
              <delete-dialog @delete="deleteUser(user.id)"></delete-dialog>
            </td>
          </tr>
        </tbody>
      </v-table>
    </div>
    <p>{{ getData() }}</p>
  </div>
</template>

<script>
import DeleteDialog from "../components/admin/DeleteDialog.vue";
export default {
  components: {
    DeleteDialog,
  },

  data() {
    return {
      users: "",
    };
  },
  methods: {
    getData: function () {
      this.$http
        .get(`/report`)
        .then((response) => {
          this.users = response.data.data;
          console.log(this.users);
        })
        .catch((error) => {
          console.log(error.message);
        });
    },
    deleteUser: function (id) {
      this.$http.delete().then();
      let i = this.users.map((item) => item.id).indexOf(id); // find index of object
      this.users.splice(i, 1); // remove it from array
    },
  },
};
</script>

<style>
img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}
#report {
  color: black;
  background-color: white;
}
</style>