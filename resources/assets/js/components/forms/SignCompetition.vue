<template>
  <div class="signin_competition_form_wrapper">
    <form class="col-12" @submit.prevent="handleSubmit">
      <div class="title_form">
        <h2>PARTICIPATION</h2>
        <p>
          Complétez vos coordonnées afin de profiter de vos concours
        </p>
      </div>
      <div class="form_content">
        <label for="name">Nom, Prénom</label>
        <input v-model="poarticitionForm.name" id="name" />

        <label for="email">Adresse mail</label>
        <input type="email" v-model="poarticitionForm.email" id="email" />

        <label for="birthday">Date d'anniversaire</label>
        <birth-day v-model="poarticitionForm.birthday" />
        <!-- <input v-model="poarticitionForm.birthday" id="birthday" /> -->
      </div>

      <div class="footer">
        <input type="submit" value="PARTICIPER" />
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "SignCompetitionFormComponent",
  data() {
    return {
      poarticitionForm: {
        name: "",
        email: "",
        birthday: ""
      }
    };
  },
  computed: {
    currCompetition() {
      return this.$store.getters["competitions/currCompetition"];
    }
  },
  methods: {
    async handleSubmit() {
      await this.$store.dispatch("participants/setParticipants", {
        competition: this.currCompetition,
        participant: this.poarticitionForm
      });
      this.$emit('submited', true)
    }
  }
};
</script>
