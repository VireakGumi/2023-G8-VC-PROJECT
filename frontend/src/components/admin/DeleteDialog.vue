<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent width="auto">
      <template v-slot:activator="{ props }">
        <v-btn class="rounded-xl text-body-2" color="red" v-bind="props">Delete</v-btn>
      </template>
      <v-card>
        <v-card-text> Do you want to delete?🤔 </v-card-text>

        <v-card-actions>
          <v-btn color="green-darken-1" variant="text" @click="dialog = false">
            Cancle
          </v-btn>
          <v-btn
            class="ml-auto"
            color="green-darken-1"
            variant="text"
            @click="deleteItem"
            v-on:click="dialog = false"
          >
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  emits: ["delete"],

  data() {
    return {
      dialog: false,
    };
  },
  methods: {
    deleteItem: function (id) {
      this.$emit("delete", id);
    },
  },
};
</script>

<style>
</style>