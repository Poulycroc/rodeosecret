<template>
  <nav :class="isScrolledCls">
    <div class="container">
      <a href="#top"
        ><img src="img/clubAvantageLogo.png" alt="Club Avantage"
      /></a>
      <section>
        <router-link to="/#top">Home</router-link>
        <router-link to="/#one">Concours avantages</router-link>
        <router-link to="/#contact">Contact</router-link>
      </section>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBarIncludeComponent",
  data() {
    return {
      windowScrollY: 0,
      scrolled: false
    };
  },
  computed: {
    isScrolledCls() {
      if (this.scrolled) return "white";
    }
  },
  methods: {
    handleScroll() {
      if (process.browser) this.windowScrollY = window.scrollY;
      this.scrolled = this.windowScrollY >= 50;
    }
  },
  created() {
    if (process.browser) window.addEventListener("scroll", this.handleScroll);
  },
  destroyed() {
    if (process.browser)
      window.removeEventListener("scroll", this.handleScroll);
  }
};
</script>
