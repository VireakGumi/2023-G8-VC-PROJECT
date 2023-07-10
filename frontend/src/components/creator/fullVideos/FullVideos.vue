<template>
  <div>
    <div v-for="video in videos" :key="video.id" @click="selectVideo(video)">
      <iframe :src="video.img"></iframe>
      <p>{{ video.title }}</p>
      <p>{{ video.texttitle }}</p>
      <p class="text viewer">{{ video.viewer }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      videos: [
        {
          id: 1,
          img: "https://www.youtube.com/embed/_bUTaGSLQsM",
          title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 51 រដូវកាលទី៥",
          texttitle: " | សម្រាយរឿង Anime Recap",
          viewer: "135K views  3 days ago"
        },
        {
          id: 2,
          img: "https://www.youtube.com/embed/3Nl3XUAUc3k",
          title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 50 រដូវកាលទី័១",
          texttitle: " | សម្រាយរឿង Anime Recap",
          viewer: "146K views  1 week ago"
        },
        {
          id: 3,
          img: "https://www.youtube.com/embed/_bUTaGSLQsM",
          title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 51 រដូវកាលទី៥",
          texttitle: " | សម្រាយរឿង Anime Recap",
          viewer: "135K views  3 days ago"
        },
        {
          id: 4,
          img: "https://www.youtube.com/embed/3Nl3XUAUc3k",
          title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 50 រដូវកាលទី័១",
          texttitle: " | សម្រាយរឿង Anime Recap",
          viewer: "146K views  1 week ago"
        }
      ]
    };
  },
  methods: {
    selectVideo(video) {
      this.$emit('video-selected', video);
    }
  }
};
</script>