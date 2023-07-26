<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      width="1024"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">Your Channel</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col>
              <div>
                <label for="title">Title</label>
                <v-text-field
                  required
                  name="title"
                  placeholder="Please enter your title"
                  :rules="titleRule"
                  v-model="title"
                ></v-text-field>
              </div>
              <div>
                <label for="des">Description</label>
                <v-text-field
                  required
                  name="des"
                  placeholder="Please enter your Description"
                  :rules="descriptionRule"
                  v-model="description"
                ></v-text-field>
              </div>
              <div>
                <label for="thumbnail-input">Thumbnail</label>
                <v-file-input
                  label="Select thumbnail"
                  accept="image/*"
                  :rules="thumbnailRule"
                  v-model="thumbnail"
                ></v-file-input>
              </div>
            </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="dialog = false"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
  export default {
    data: () => ({
      dialog: true,
    }),
  }
</script>