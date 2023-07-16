<template>
  <v-carousel cycle height="400" hide-delimiter-background show-arrows="hover">
    <v-carousel-item v-for="(slide, i) in slides" :key="i">
      <v-sheet height="100%" width="100%">
        <div class="d-flex fill-height w-100 justify-center align-center">
          <img class="w-100" cover :src="slide">
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
        "https://www.mollybrownlondon.com/wp/wp-content/uploads/Addams-Family.webp",
        "https://www.mollybrownlondon.com/wp/wp-content/uploads/9c9651d0368c806d9bb93b18835cda12.webp",
        "https://www.mollybrownlondon.com/wp/wp-content/uploads/emoji-moview-blog.webp",
        "https://images.squarespace-cdn.com/content/v1/591b66f920099ed6bd741796/1628255532968-WY2TPG4L46SVZN6ZF3M8/Yoga-songs-for-preschool-kindergarten-kids?format=750w",
        "https://www.karralyka.com.au/files/assets/karralyka/1-theatre/karrakids/frozen-jr-website.png?dimension=pageimagefullwidth&w=1140",
      ],
    };
  },
};
</script>
