<template>
<v-app>
  <v-button class="population">
    <button class="btn">Latest</button>
    <button class="btn">Popular</button>
    <button class="btn">Oldest</button>
  </v-button>
    <v-container class="card-container" fluid>
      <v-row class="my-card">
        <v-col v-for="video in videos" :key="video.id" cols="12" md="4">
          <v-card class="card mb-60" @click="selectedVideoId = video.id">
            <v-card-media>
              <v-responsive aspect-ratio="16/9">
                <iframe
                  width="332"
                  height="250"
                  :src="video.img"
                  frameborder="0"
                  allowfullscreen
                ></iframe>
              </v-responsive>
            </v-card-media>
            <v-card-title>
              <p class="text title"> {{ video.title }} </p>
              <p class="text title"> {{ video.texytitle }} </p>
              <p class="text viewer">{{ video.viewer }}</p>
            </v-card-title>
          </v-card>
          <br>
        </v-col>
      </v-row>
    </v-container>
</v-app>
    
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      videos: [
        {id: 1, img: "https://www.youtube.com/embed/_bUTaGSLQsM", title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 51 រដូវកាលទី៥", texttitle:" | សម្រាយរឿង Anime Recap", viewer: "135K views  3 days ago"},
        {id: 2, img: "https://www.youtube.com/embed/3Nl3XUAUc3k", title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 50 រដូវកាលទី័៥", texttitle:" | សម្រាយរឿង Anime Recap", viewer: "146K views  1 week ago"},
        {id: 3, img: "https://www.youtube.com/embed/_bUTaGSLQsM", title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 51 រដូវកាលទី៥", texttitle:" | សម្រាយរឿង Anime Recap", viewer: "135K views  3 days ago"},
        {id: 4, img: "https://www.youtube.com/embed/3Nl3XUAUc3k", title: "ប្រយុទ្ធទៅកាន់មេឃា ភាគទី 50 រដូវកាលទី័៥", texttitle:" | សម្រាយរឿង Anime Recap", viewer: "146K views  1 week ago"},
      ]
    }
  }
};

</script>

<style scoped>

.population {
  margin-left: 30px;
}

.btn {
  width: 10%;
  padding: 10px;
  border-radius: 10px;
  background: #15202b;
  color: white;
}


.video {
  margin-left: 3%;
  margin-top: -1.5%;
}

.play {
  margin-left: 10%;
}

a {
  text-decoration: none;
  color: black;
}

img {
  margin-right: 10px;
}

.card-container {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  margin: 20px;
}

.my-card {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
}

.card {
  margin-left: 20px;
  margin-bottom: 10%;
  margin: 20px;
}

</style>
