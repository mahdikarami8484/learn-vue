<template>
  <header>
    <NavbarComponent />
  </header>

  <RouterView />
</template>

<script>
import { RouterLink, RouterView } from "vue-router";
import NavbarComponent from "@/components/Header/NavbarComponent.vue";

export default {
  name: "App",
  components: { NavbarComponent },
  watch: {
    $route() {
      this.$store.commit("onStart");
    },
  },
  mounted() {
    this.$store.commit("onStart");
  },
};
</script>
