<template>
  <div class="landing_main_navbar_wrapper">
    <div class="container">
      <nav class="navbar navbar-expand-lg">
        <router-link class="brand_logo" to="/">
          <img src="img/logos/club_avantage.png" />
        </router-link>
        <div class="navbar-nav mx-auto text-center">
          <ul class="links">
            <li v-for="(link, i) in navLinks" :key="i" class="nav-item">
              <router-link
                class="nav-link active"
                data-scroll-nav="1"
                :to="link.path"
              >
                {{ link.label }}
              </router-link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NavBarLandingInclude',
  data() {
    return {
      navLinks: [
        {
          path: "/",
          label: "HOME"
        },
        {
          path: "/",
          label: "CONCOURS & AVANTAGES"
        },
        {
          path: "/",
          label: "CONTACT"
        }
      ]
    };
  }
};
</script>
