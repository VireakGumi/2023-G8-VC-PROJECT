<template>
  <div id="report" class="fill-height pa-4 bg-blue-grey-darken-4 text-white">
    <div>
      <v-text class="text-h4 font-weight-black ml-4">Report</v-text>
      <p class="ml-4">Here are the lists of video that users report.</p>
      <v-btn active class="ml-4 mt-4 rounded-xl text-body-2 my-5"
        >All reports</v-btn
      >
      <v-btn class="ml-4 mt-4 rounded-xl text-body-2 my-5"
        >Currently reports</v-btn
      >
      <v-table class="fill-height">
        <thead>
          <tr class="bg-blue-grey-darken-4">
            <th class="text-center text-white">User Name</th>
            <th class="text-center text-white">Content Video</th>
            <th class="text-center text-white">Type's Report</th>
            <th class="text-center text-white">Comment</th>
            <th class="text-center text-white">View Detail</th>
            <th class="text-center text-white">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="user in users"
            :key="user.name"
            class="bg-blue-grey-darken-4"
          >
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
              <delete-dialog
                @delete="deleteUser(user.id, user.video.id)"
              ></delete-dialog>
            </td>
          </tr>
        </tbody>
      </v-table>
    </div>
  </div>
</template>

<script>
import DeleteDialog from "../components/Dialog/DeleteDialog.vue";
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
        })
        .catch((error) => {
          console.log(error.message);
        });
      return this.users;
    },

    deleteUser: function (id, videoId) {
      // First, delete the report with the given ID
      this.$http
        .delete(`/report/${id}`)
        .then((response) => {
          console.log(response.data);
          // If the report was deleted successfully, delete the video with the same ID
          this.$http
            .delete(`/videosById/${videoId}`)
            .then((response) => {
              // handle success
              console.log(response.data, `/videosById/${videoId}`);
            })
            .catch((error) => {
              console.log(error);
            });
          window.location.reload();
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style scoped>
img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}
td,
th {
  border-collapse: collapse;
}
</style>
