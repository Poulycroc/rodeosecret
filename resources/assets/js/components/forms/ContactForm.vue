<template>
  <div class="contact-form">
    <div class="contact-title">
      <h4>Contactez-nous</h4>
      <h5>
        Nous nous ferons un plaisir de vous répondre dans les meilleurs délais.
      </h5>
    </div>
    <form @submit.prevent="handleSubmit" novalidate="true">
      <div class="form-group">
        <input
          v-model="contactForm.name"
          type="text"
          class="form-control"
          id="name"
          name="name"
          placeholder="Nom, Prénom"
          required="required"
          data-error="This field is required."
        />
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group">
        <input
          v-model="contactForm.email"
          type="email"
          class="form-control"
          id="email"
          name="email"
          placeholder="Adresse mail"
          required="required"
          data-error="This field is required."
        />
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group">
        <input
          v-model="contactForm.subject"
          type="text"
          class="form-control"
          id="subject"
          name="subject"
          placeholder="Sujet"
        />
      </div>
      <div class="form-group">
        <textarea
          v-model="contactForm.message"
          class="form-control"
          id="message"
          name="message"
          rows="10"
          placeholder="Message"
          required="required"
          data-error="Please, leave us a message."
        ></textarea>
        <div class="help-block with-errors"></div>
      </div>
      <button type="submit" class="disabled">Evoyer</button>
      <div class="messages"></div>
    </form>
  </div>
</template>

<script>
export default {
  name: "SignCompetitionForm",
  data() {
    return {
      contactForm: {
        name: "",
        email: "",
        subject: "",
        message: ""
      }
    };
  },
  methods: {
    handleSubmit($event) {
      console.log({ $event, contactForm: this.contactForm });
    }
  }
};
</script>
