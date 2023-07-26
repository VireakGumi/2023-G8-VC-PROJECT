<template>
    <div class="container bg-blue-grey-darken-4 pa-8 fill-height">
        <v-row class=" d-flex flex-column" style="width: 90%%;">
            <v-row class="d-flex justify-space-between w-100 align-center">
                <h1 class="ml-7">Performance</h1>
                <h3 class="mr-3">Chart</h3>
            </v-row>
            <v-row class="ml-1 mt-4 mr-4 mb-2 d-flex d-flex" style="width: 90%%;">
                <v-col class="bg-indigo-lighten-5 d-flex flex-column rounded-lg ml-3 " style="width: 65%;">
                    <div id="chart" class="bg-white rounded-lg align-self-center " style="width: 98%;">
                        <apexchart type="bar" height="230" class="w-100 " :options="chartOptions"
                            :series=getVideosOftheYear(videos)>
                        </apexchart>
                    </div>
                    <h3 class="ml-1 mt-3 px-4 py-2 bg-teal-lighten-1 rounded-lg d-flex mr-auto">Users</h3>
                </v-col>
                <v-col class="bg-indigo-lighten-5 d-flex flex-column rounded-lg ml-3 " style="width: 65%;">
                    <div id="chart" class="bg-white rounded-lg align-self-center " style="width: 98%;">
                        <apexchart type="bar" height="230" class="w-100 " :options="chartOptions"
                            :series=getVideosOftheYear(users)>
                        </apexchart>
                    </div>
                    <h3 class="ml-1 mt-3 px-4 py-2 bg-teal-lighten-1 rounded-lg d-flex mr-auto">Videos</h3>
                </v-col>

            </v-row>
        </v-row>
        <v-row class="mt-7" style="width: 90%%;">
            <v-row class="d-flex justify-space-between w-100 align-center">
                <h1 class="ml-7">Information</h1>
                <h3 class="mr-9">Detalis</h3>
            </v-row>
            <v-row class="mt-2 ml-2 mr-2  d-flex justify-space-between" style="width: 90%%;">
                <v-col>
                    <v-card class="d-flex align-center justify-space-between px-12 py-3 rounded-xl bg-green-accent-2">
                        <v-icon class="my-icon" size="160px">mdi-account</v-icon>
                        <div class="text ">
                            <h2>{{ users.length }}</h2>
                            <h4>User</h4>
                            <p>Date: {{ getDate() }}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="d-flex align-center justify-space-between px-12 py-4 rounded-xl bg-light-blue-lighten-1">
                        <v-icon class="my-icon" size="160px">mdi-movie-roll</v-icon>
                        <div class="text">
                            <h2>{{ videos.length }}</h2>
                            <h4>Videos</h4>
                            <p>Date: {{ getDate() }}</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="d-flex align-center justify-space-between px-12 py-4 rounded-xl bg-red-lighten-2">
                        <v-icon class="my-icon" size="160px">mdi-movie-open-remove</v-icon>
                        <div class="text">
                            <h2>{{ reports.length }}</h2>
                            <h4>Report</h4>
                            <p>Date: {{ getDate() }}</p>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-row>
        <v-row class="mt-10  d-flex " style="width: 90%%;">
            <v-row class="d-flex justify-space-between w-100 align-center">
                <h2 class="ml-7">Popular Videos</h2>
                <h2 class="mr-9">Categories</h2>
            </v-row>
            <v-row class="mt-4 ml-2 mr-2 mb-10">
                <v-col>
                    <v-card class="bg-indigo-lighten-5  rounded-lg pa-5 d-flex flex-wrap justify-space-evenly ">
                        <ul style="list-style: none;"
                            class="text-blue-grey-lighten-2 ma-3 d-flex justify-space-evenly fill-height"
                            v-for="item of popularVideos" :key="item">
                            <li class="py-3 px-5 bg-teal-lighten-1 rounded-xl d-flex mr-auto">
                                <a class="text-white" style="text-decoration: none;" @click = playVideo(item.id) >{{
                                    item.title }}</a>
                            </li>
                        </ul>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="bg-indigo-lighten-5 py-5 px-4 rounded-lg ">
                        <ul class="d-flex flex-wrap w-100 align-center">
                            <li class="mx-4 my-3 py-3 px-5 bg-teal-lighten-1 rounded-xl d-flex mr-auto"
                                v-for="item of allCategories" :key="item">
                                <h4>{{ item.category_name }}</h4>
                            </li>
                        </ul>
                    </v-card>
                </v-col>
            </v-row>
        </v-row>
    </div>
</template>
<script>
import router from "@/router";
export default {
    data() {
        return {
            // categories: [
            //     "Anime",
            //     "Adventure",
            //     "Cartoon",
            //     "Comedy",
            //     "Drama",
            //     "Ecchi",
            //     "Anime",
            //     "School",
            //     "Adventure",
            //     "Cartoon",
            //     "Drama",
            //     "Comedy",
            //     "School",
            //     "Ecchi",
            // ],
            // series: [{
            //     name: 'Inflation',
            //     data: [0,0,0,0,3.2,0,0,0,0,0,0,0],
            // }],
            chartOptions: {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        fill: {
                            type: 'gradient',
                            gradient: {
                                colorFrom: '#D8E3F0',
                                colorTo: '#BED1E6',
                                stops: [0, 100],
                                opacityFrom: 0.4,
                                opacityTo: 0.5,
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function (val) {
                            return val + "%";
                        }
                    }

                },
                title: {
                    text: 'Monthly Inflation in Argentina, 2002',
                    floating: true,
                    offsetY: 330,
                    align: 'center',
                    style: {
                        color: '#444'
                    }
                }
            },
            videos: [],
            users: [],
            reports: [],
            allCategories: [],
            popularVideos: [],


        }
    },
    methods: {
        playVideo(id) {
            return router.push("/videodetail/" + id);
        },
        getVideosOftheYear(items) {
            const monthlyData = {};

            // Group the videos by month and calculate the average value for each month
            items.forEach((item) => {
                const timestamp = Date.parse(item.date_time);
                const date = new Date(timestamp);
                const month = date.getMonth() + 1; // Get the month number (1-12)
                if (monthlyData[month]) {
                    // Add the video to the existing month
                    monthlyData[month].push(item);
                } else {
                    // Create a new entry for the month with the first video
                    monthlyData[month] = [item];
                }
            });

            // Calculate the number of videos for each month and store the values in an array
            const monthlyValues = Array.from({ length: 12 }, (_, i) => {
                const monthVideos = monthlyData[i + 1] || []; // Get the videos for the current month or an empty array
                return monthVideos.length / 10.0;
            });
            return [{ name: 'Inflation', data: monthlyValues, }]

        },
        getPopularVideos() {
            for (let video of this.videos) {
                if (this.popularVideos.length < 13) {
                    this.popularVideos.push(video);
                }
            }
            console.log(this.popularVideos);
        },
        getVideos() {
            this.$http.get('/videos').then((response) => {
                this.videos = response.data.data;
                this.getPopularVideos()
            }).catch((error) => { console.log(error.message) });
        },
        getUsers() {
            this.$http.get('/users').then((response) => {
                this.users = response.data.user;
            }).catch((error) => { console.log(error.message) });
        },
        getReports() {
            this.$http.get('/report').then((response) => {
                this.reports = response.data.data;
            }).catch((error) => { console.log(error.message) });
        },
        getCategories() {
            this.$http.get('/categories').then((response) => {
                this.allCategories = response.data.data;
                console.log(this.allCategories);
            }).catch((error) => { console.log(error.message) });
        },
        getDate() {
            const dateString = new Date().toISOString().replace(/T/, " ").replace(/\..+/, "");
            const date = new Date(dateString);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear().toString().substr(-2);
            const formattedDate = `${day}/${month}/${year}`;
            return formattedDate;
        }
    },
    created() {
        this.getVideos();
        this.getUsers();
        this.getReports();
        this.getCategories();
    }

}
</script>

<style scoped>
.container {
    height: 140vh;
}

.my-icon {
    opacity: 0.4;
}
</style>