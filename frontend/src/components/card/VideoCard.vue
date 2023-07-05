<template>
    <v-row >
        <v-card to="/about">
          <v-img src="https://img.freepik.com/premium-photo/image-colorful-galaxy-sky-generative-ai_791316-9864.jpg?w=740" height="209" class="rounded-xl" ></v-img>
          <v-card-title class="d-flex flex-column align-start mb-6">
            <h5 class="line-clamp-2" >Ttitle</h5>
            <div class="group-pf">
              <img src="https://img.freepik.com/premium-photo/pixar-style-super-cute-happy-generative-ai_791316-8114.jpg"  height="30" width="30" rounded  class="rounded-circle mr-2">
              <h6 ml="5">Taherp</h6>
            </div>
            <p class="caption mb-0"><span>34M Views</span>. 3 month</p>
          </v-card-title >
        </v-card>
    </v-row>
</template>

<style scoped>
.group-pf{
  display: flex;
}
.v-card-title p{
  font-size: small;
}
.v-card{
  box-shadow: none;
}
</style>