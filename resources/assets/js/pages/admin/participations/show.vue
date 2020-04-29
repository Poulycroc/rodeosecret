<template>
  <page name="categories_admin" type="admin">
    <div class="container">
      <h2>
        Participants: <small>{{ currCompetition.title }}</small>
      </h2>
    </div>

    <div class="centered_content marg_b">
      <b-button variant="outline-primary" @click="backToParticipants">
        Retour a la liste des participants
      </b-button>
    </div>

    <b-card title="Générer les gagnants">
      <b-row>
        <b-col md="9">
          <v-select :options="mapParticipants" />
        </b-col>
        <b-col md="3">
          <b-button variant="primary" @click="handleGenerateWinner">
            Générer un gagnant
          </b-button>
        </b-col>
      </b-row>
    </b-card>

    <b-card title="Les gagnants">
      <div v-if="winnersParticipants.length" class="content">
        <table-container
          hide-top-actions
          hide-actions
          :items="winnersParticipants"
          :fields="participantsFields"
        />
      </div>
      <div v-else class="content">
        Pas de gagnants pour le moment
      </div>
    </b-card>

    <b-card title="Toues les participations">
      <div class="content">
        <table-container
          hide-top-actions
          :items="signedParticipants"
          :fields="participantsFields"
        />
      </div>
    </b-card>
  </page>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

const defaultCategoryForm = {
  id: null,
  name: ""
};

export default {
  name: "ParticipationsAdminPage",
  middleware: "auth",
  layout: "admin",
  data() {
    return {
      isBusy: false,
      isCategoryModalOpen: false,
      participantsFields: [
        {
          key: "status",
          label: "Gagant",
          formatter: this.checkWin,
          sortable: true
        },
        {
          key: "name",
          label: "Nom & prénom",
          sortable: true
        },
        {
          key: "email",
          label: "Email",
          formatter: v => v,
          sortable: true
        },
        {
          key: "birthday",
          label: "Date de naissance",
          sortable: true
        }
      ],
      categoryForm: defaultCategoryForm,
      nameState: null
    };
  },
  created() {
    const { id } = this.$route.params;
    this.getWinnersParticipants(id);
    this.getSignedParaticipants(id);
    this.getCompetition(id);
  },
  computed: {
    ...mapGetters({
      currCompetition: "competitions/currCompetition",
      winnersParticipants: "participants/winnersParticipants",
      signedParticipants: "participants/signedParticipants",
      currWinner: "winners/currWinner"
    }),

    mapParticipants() {
      return this.signedParticipants.map(p => ({
        code: p.id,
        label: p.name
      }));
    }
  },
  methods: {
    ...mapActions({
      getCompetition: "competitions/getCompetition",
      getWinnersParticipants: "participants/getWinnersParticipants",
      getSignedParaticipants: "participants/getSignedParaticipants",

      generateWinner: "winners/generateWinner",
      saveWinner: "winners/saveWinner"
    }),

    // -- FORMATTERS
    checkWin(value, key, item) {
      const c = item.status === "1" || item.status === 1;
      return c ? "Oui" : "Non";
    },

    backToParticipants() {
      this.$router.push({ name: "admin.participations" });
    },

    async handleGenerateWinner() {
      await this.generateWinner(this.currCompetition.id);

      const h = this.$createElement;
      const { name, email } = this.currWinner;
      const msg = h("div", null, [
        h("p", { class: ["text-center"] }, [
          "Le gagnant sera ",
          h("strong", name),
          ` (${email}) `,
          h("br"),
          "Pour le concours ",
          h("strong", this.currCompetition.title),
          ", si vous confirmez"
        ])
      ]);

      this.$bvModal
        .msgBoxConfirm([msg], {
          title: "Confirmer le gagnant",
          size: "sm",
          buttonSize: "sm",
          okVariant: "success",
          okTitle: "Copnfirmer",
          cancelTitle: "Annuler",
          footerClass: "p-2",
          hideHeaderClose: false,
          centered: true
        })
        .then(() => this.saveWinner(this.currWinner))
        .catch(err => new Error(err));
    }
  }
};
</script>
