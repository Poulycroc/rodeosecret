<template>
  <page name="landing">
    <nav-bar />
    <head-top />
    <main>
      <competitions />
      <social />
      <testimony />
    </main>
    <foot />
  </page>
</template>

<script>
import NavBar from "~/includes/landing/Nav";
import HeadTop from "~/includes/landing/Header";
import Competitions from "~/includes/landing/Competitions";
import Social from "~/includes/landing/Social";
import Testimony from "~/includes/landing/Testimony";
import Foot from "~/includes/landing/Footer";

export default {
  name: "LandingPage",
  components: {
    NavBar,
    HeadTop,
    Competitions,
    Social,
    Testimony,
    Foot
  },
  data() {
    return {
      title: window.config.appName
    };
  }
};
</script>
