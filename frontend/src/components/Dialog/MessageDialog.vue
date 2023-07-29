<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent width="auto">
            <v-card>
                <v-card-title class="text-h4 text-center">
                    You don't have an account yet
                </v-card-title>
                <v-card-text>Plase login or register if you want to use like this video</v-card-text>
            </v-card>
        </v-dialog>
        <LoginDialog  />
    </v-row>
</template>

<script>
export default {
    data() {
        return {
            dialog: true,
        }
    },



}
</script>
