<template>
  <v-card>
    <v-list>
      <v-list-item v-for="(notification, index) in notifications" :key="index">
        <v-list-item-avatar>
          <v-icon :color="notification.color">{{ notification.icon }}</v-icon>
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title>{{ notification.title }}</v-list-item-title>
          <v-list-item-subtitle>{{
            notification.subtitle
          }}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action>
          <v-btn icon>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      notifications: [
        {
          title: "Notification 1",
          subtitle: "This is the first notification",
          icon: "mdi-alert",
          color: "red",
        },
        {
          title: "Notification 2",
          subtitle: "This is the second notification",
          icon: "mdi-information",
          color: "blue",
        },
        {
          title: "Notification 3",
          subtitle: "This is the third notification",
          icon: "mdi-check-circle",
          color: "green",
        },
      ],
    };
  },
};
</script>
