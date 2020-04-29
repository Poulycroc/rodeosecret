<template>
  <page name="categories_admin" type="admin">
    <div class="container">
      <h2>Concours & Avantage</h2>
    </div>

    <b-card>
      <div class="content">
        <table-container
          :items="competitions"
          :fields="fields"
          @add="handleAdd"
          @edit="handleEdit"
          @delete="handleRemove"
        />
      </div>
    </b-card>

    <b-modal
      v-model="isCompetitionModalOpen"
      title="BootstrapVue"
      size="lg"
      @hidden="handleHidden"
      @cancel="handleHidden"
      @ok="handleSubmit"
    >
      <add-competition-form
        :edit-mode="isEditModalMode"
        @change="handleCompetitionChange"
      />
    </b-modal>
  </page>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

const defaultCategoryForm = {
  id: null,
  name: ""
};

export default {
  name: "CategoryAdminPage",
  middleware: "auth",
  layout: "admin",
  data() {
    return {
      isBusy: false,
      isCompetitionModalOpen: false,
      fields: [
        {
          key: "actions",
          label: "Actions",
          formatter: value => value
        },
        {
          key: "type",
          label: "Type",
          sortable: true
        },
        {
          key: "title",
          label: "Titre",
          sortable: true
        },
        {
          key: "start_event",
          label: "Date événement",
          sortable: true
        },
        {
          key: "publication",
          label: "Date publication",
          sortable: true
        },
        {
          key: "in_landing",
          label: "Afficher sur la home",
          formatter: (value, key, item) => {
            return item.in_landing === "1" ? "Oui" : "Non";
          },
          sortable: true
        },
        {
          key: "on_top",
          label: "Afficher sur le haut",
          formatter: (value, key, item) => {
            return item.on_top === "1" ? "Oui" : "Non";
          },
          sortable: true
        }
      ],

      competitionToSubmit: null,
      isEditModalMode: false
    };
  },
  created() {
    this.$store.dispatch("competitions/getCompetitions");
  },
  computed: {
    ...mapGetters({
      competitions: "competitions/competitions"
    })
  },
  methods: {
    ...mapActions({
      getCategories: "categories/getCategories",
      setCategories: "categories/setCategories",
      editCategories: "categories/editCategories",

      setCompetitions: "competitions/setCompetitions",
      getCompetition: "competitions/getCompetition",
      editCompetitions: "competitions/editCompetitions",
      deleteCompetitions: "competitions/deleteCompetitions"
    }),

    handleCompetitionChange(competition) {
      this.competitionToSubmit = competition;
    },

    async handleAdd() {
      await this.getCategories();
      this.isCompetitionModalOpen = true;
    },

    /**
     * @param {Object} competition
     */
    async handleEdit({ id }) {
      await this.getCompetition(id);
      await this.getCategories();
      this.isEditModalMode = true;
      this.isCompetitionModalOpen = true;
    },
    async handleRemove({ id, title }) {
      await this.getCategories();
      this.showDeleteMessage(id, title);
    },
    handleHidden($event) {
      this.isEditModalMode = false;
      this.isCompetitionModalOpen = false;
    },
    async handleSubmit($event) {
      if (this.isEditModalMode) {
        await this.editCompetitions(this.competitionToSubmit);
      } else {
        await this.setCompetitions(this.competitionToSubmit);
      }
    },

    showDeleteMessage(id, title) {
      const t = `Supprimer le concours "${title}" ?`;
      this.$bvModal
        .msgBoxConfirm(t, {
          title: "Attention",
          size: "sm",
          buttonSize: "sm",
          okVariant: "danger",
          okTitle: "Oui",
          cancelTitle: "Non",
          hideHeaderClose: false,
          centered: true
        })
        .then(async () => await this.deleteCompetitions({ id }))
        .catch(err => new Error(err));
    }
  }
};
</script>
