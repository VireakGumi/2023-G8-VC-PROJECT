<template>
  <v-carousel cycle height="400" hide-delimiter-background show-arrows="hover">
    <v-carousel-item v-for="(slide, i) in slides" :key="i">
      <v-sheet height="100%" width="100%">
        <div class="d-flex fill-height w-100 justify-center align-center">
          <img class="w-100" cover :src="slide" />
        </div>
      </v-sheet>
    </v-carousel-item>
  </v-carousel>
</template>
<script>
export default {
  data() {
    return {
      colors: [
        "indigo",
        "warning",
        "pink darken-2",
        "red lighten-1",
        "deep-purple accent-4",
      ],
      slides: [
        require("@/assets/wp1924568-boss-baby-wallpapers.jpg"),
        require("@/assets/wp9374405-the-son-of-bigfoot-wallpapers.jpg"),
        require("@/assets/120697-the-flash-dc-comics-superheroes-5k.jpg"),
        require("@/assets/wp7812223-dora-cartoon-wallpapers.jpg"),
        require("@/assets/Yoga-songs-for-preschool-kindergarten-kids.png"),
        require("@/assets/frozen-jr-website.png"),
        
      ],
    };
  },
};
</script>
