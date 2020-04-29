<template>
  <form ref="form">
    <b-form-group
      label="Ttitre"
      label-for="name-input"
      invalid-feedback="Le titre est important"
    >
      <b-form-input id="name-input" v-model="competitionForm.title" required />
    </b-form-group>
    <b-form-group label="Type de concours" for="type-input">
      <b-form-input id="type-input" v-model="competitionForm.type" required />
    </b-form-group>
    <b-form-group label="Catégorie">
      <b-form-select
        v-model="competitionForm.category_id"
        :options="mapCategories"
        @change="handleChangeCat"
      />
    </b-form-group>

    <b-form-group label="Date de publication">
      <b-form-datepicker
        id="publish-date"
        v-model="competitionForm.publication"
        class="mb-2"
      />
    </b-form-group>

    <b-form-group label="Début de l'événement">
      <b-form-datepicker
        id="start-event-date"
        v-model="competitionForm.start_event"
        class="mb-2"
      />
    </b-form-group>

    <b-form-group label="Ajouter une image">
      <b-form-file id="file-default"></b-form-file>
    </b-form-group>

    <b-form-checkbox
      v-model="competitionForm.on_top"
      :value="1"
      :unchecked-value="0"
    >
      Afficher sur le haut
    </b-form-checkbox>
    <b-form-checkbox
      v-model="competitionForm.in_landing"
      :value="1"
      :unchecked-value="0"
    >
      Afficher sur la home
    </b-form-checkbox>
  </form>
</template>

<script>
import { mapGetters } from "vuex";
const now = new Date();

export default {
  name: "AddCompetitionFormComponent",
  props: {
    editMode: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data() {
    return {
      competitionForm: {
        title: "",
        type: "Concours",
        category_id: null,
        start_event: now,
        publication: now,
        on_top: 1,
        img: 1,
        in_landing: 1
      }
    };
  },
  computed: {
    ...mapGetters({
      currCompetition: "competitions/currCompetition",
      categories: "categories/categories"
    }),

    mapCategories() {
      console.log({ categories: this.categories });
      return this.categories.map(({ id, name }) => ({
        value: id,
        text: name
      }));
    }
  },
  created() {
    if (this.editMode) {
      console.log({ currCompetition: this.currCompetition });
      this.competitionForm = {
        ...this.competitionForm,
        ...this.currCompetition,
        category_id: parseInt(this.currCompetition.category_id)
      };
    }
  },
  watch: {
    competitionForm: {
      handler(competition) {
        this.$emit("change", competition);
      },
      deep: true
    }
  },
  methods: {
    handleChangeCat($event) {
      console.log({ $event });
    }
  }
};
</script>
