<template>
    <div class="container">
        <v-row class="mt-4 ml-5 mr-4 d-flex flex-column" style="width: 90%%;">
            <v-row class="d-flex justify-space-between w-100 align-center">
                <h1 class="ml-7">Performance</h1>
                <h3 class="mr-3">Chart</h3>
            </v-row>
            <v-row class="ml-1 mt-4 mr-4 mb-2 d-flex d-flex" style="width: 90%%;">
                <v-col class="bg-blue-grey-lighten-2 d-flex flex-column rounded-lg ml-3 " style="width: 65%;">
                    <div id="chart" class="bg-white rounded-lg align-self-center " style="width: 98%;">
                        <apexchart type="bar" height="230" class="w-100 " :options="chartOptions" :series="series">
                        </apexchart>
                    </div>
                    <h3 class="ml-1 mt-3 px-4 py-2 bg-teal-lighten-1 rounded-lg d-flex mr-auto">Users</h3>
                </v-col>
                <v-col class="bg-blue-grey-lighten-2 d-flex flex-column rounded-lg ml-3 " style="width: 65%;">
                    <div id="chart" class="bg-white rounded-lg align-self-center " style="width: 98%;">
                        <apexchart type="bar" height="230" class="w-100 " :options="chartOptions" :series="series">
                        </apexchart>
                    </div>
                    <h3 class="ml-1 mt-3 px-4 py-2 bg-teal-lighten-1 rounded-lg d-flex mr-auto">Videos</h3>
                </v-col>
                <v-col class="bg-blue-grey-lighten-2 d-flex flex-column rounded-lg ml-3 " style="width: 65%;">
                    <div id="chart" class="bg-white rounded-lg align-self-center " style="width: 98%;">
                        <apexchart type="bar" height="230" class="w-100 " :options="chartOptions" :series="series">
                        </apexchart>
                    </div>
                    <h3 class="ml-1 mt-3 px-4 py-2 bg-teal-lighten-1 rounded-lg d-flex mr-auto">Viewer</h3>
                </v-col>
            </v-row>
        </v-row>
        <v-row class="mt-7 ml-5 mr-4" style="width: 90%%;">
            <v-row class="d-flex justify-space-between w-100 align-center">
                <h1 class="ml-7">Information</h1>
                <h3 class="mr-9">Detalis</h3>
            </v-row>
            <v-row class="mt-2 ml-2 mr-2  d-flex justify-space-between" style="width: 90%%;">
                <v-col>
                    <v-card class="d-flex align-center justify-space-between px-12 py-3 rounded-xl bg-green-accent-2">
                        <div class="bg-white px-3 py-3 rounded-xl">
                            <img src="../../assets/audience.png" alt="" width="125">
                        </div>
                        <div class="text">
                            <h2>5000</h2>
                            <p>User</p>
                            <p>Date: 20/07/23</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="d-flex align-center justify-space-between px-12 py-4 rounded-xl bg-light-blue-lighten-1">
                        <div class="bg-white px-5 py-5 rounded-xl">
                            <img src="../../assets/video(1).png" alt="" width="101">
                        </div>
                        <div class="text">
                            <h2>5000</h2>
                            <p>Videos</p>
                            <p>Date: 20/07/23</p>
                        </div>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="d-flex align-center justify-space-between px-12 py-4 rounded-xl bg-red-lighten-2">
                        <div class="bg-white px-5 py-5 rounded-xl">
                            <img src="../../assets/denied.png" alt="" width="101">
                        </div>
                        <div class="text">
                            <h2>5000</h2>
                            <p>Report</p>
                            <p>Date: 20/07/23</p>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </v-row>
        <v-row class="mt-10 ml-5 mr-4 mb-10 d-flex " style="width: 90%%;">
            <v-row class="d-flex justify-space-between w-100 align-center">
                <h2 class="ml-7">Popular Videos</h2>
                <h2 class="mr-9">Categories</h2>
            </v-row>
            <v-row class="mt-4 ml-2 mr-2 mb-10 d-flex " style="width: 90%%;">
                <v-col>
                    <v-card class="bg-blue-grey-lighten-2 py-5 px-4 pl-16 rounded-lg" width="100%" >
                        <ul class="d-flex flex-wrap w-100 align-center  justify-space-between">
                            <li class="my-3 ml-4 text-blue-grey-lighten-2" style="width: 25%;" v-for="item of categories" :key="item"><h4><a class="text-blue-darken-4" href="##">{{ item }}</a></h4></li>
                        </ul>
                    </v-card>
                </v-col>
                <v-col>
                    <v-card class="bg-blue-grey-lighten-2 py-5 px-4 rounded-lg" width="100%">
                        <ul class="d-flex flex-wrap w-100 align-center">
                            <li class="mx-4 my-3 py-3 px-5 bg-teal-lighten-1 rounded-xl d-flex mr-auto" v-for="item of categories" :key="item"><h4>{{ item }}</h4></li>
                        </ul>
                    </v-card>
                </v-col>
            </v-row>
        </v-row>
    </div>
</template>
<script>
export default {
    data() {
        return {
            categories: [
                "Anime",
                "Adventure",
                "Cartoon",
                "Comedy",
                "Drama",
                "Ecchi",
                "Anime",
                "School",
                "Adventure",
                "Cartoon",
                "Drama",
                "Comedy",
                "School",
                "Ecchi",
            ],
            series: [{
                name: 'Inflation',
                data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
            }],
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
        }


    },
}
</script>

<style scoped>
.container {
    height: 140vh;
}
</style>