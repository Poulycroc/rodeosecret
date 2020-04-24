<template>
  <form ref="form" @submit.stop.prevent="handleSubmit">
    <b-form-group
      :state="nameState"
      label="Name"
      label-for="name-input"
      invalid-feedback="Name is required"
    >
      <b-form-input
        id="name-input"
        v-model="name"
        :state="nameState"
        required
      ></b-form-input>
    </b-form-group>
  </form>
</template>

<script>
export default {
  methods: {
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      // Push the name to submitted names
      this.submittedNames.push(this.name);
      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    }
  }
};
</script>
