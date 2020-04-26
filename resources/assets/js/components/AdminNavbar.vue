<template>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand>
      <router-link :to="{ name: 'admin.dashboard' }" class="navbar-brand">
        Club Avantages
      </router-link>
    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item v-for="(link, i) in links" :key="i">
          <router-link :to="{ name: link.path }">{{ link.label }}</router-link>
        </b-nav-item>
      </b-navbar-nav>

      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown right>
          <template v-slot:button-content>
            <avatar :user="user" :size="40" />
            {{ user.name }}
          </template>
          <b-button variant="link" @click="logout">Se Déconnecter</b-button>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      appName: window.config.appName,
      links: [
        {
          path: "admin.categories",
          label: "Catégories"
        },
        {
          path: "admin.concours_avantages",
          label: "Concours Avantages"
        },
        {
          path: "admin.participations",
          label: "Participations"
        }
      ]
    };
  },

  computed: mapGetters({
    user: "auth/user"
  }),

  methods: {
    async logout() {
      await this.$store.dispatch("auth/logout");
      this.$router.push({ name: "admin.login" });
    }
  }
};
</script>
