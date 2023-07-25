<template>
    <section >
        <General-Info></General-Info>
        <Navbar-page/>
    </section>
</template>

<script>
    import CoverAndProfile from "../../components/Profiles/CoverAndProfile.vue";
    import NavBarview from "../../components/NavBar/NavbarView.vue";
    export default {
        components:{
            'General-Info':CoverAndProfile,
            'Navbar-page':NavBarview
        }
    }
</script>

<style scoped>
section {
    height: 28%;
}
</style>