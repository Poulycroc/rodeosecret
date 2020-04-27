<template>
  <form class="col-12" @submit.prevent="handleSubmit">
    <h2>Contactez-nous</h2>
    <p>
      Nous nous ferons un plaisir de vous répondre dans les meilleurs délais
    </p>

    <label for="name">Nom, Prénom</label>
    <input v-model="contactForm.name" id="name" />

    <label for="email">Adresse mail</label>
    <input v-model="contactForm.email" id="email" />

    <label for="subject">Sujet</label>
    <input v-model="contactForm.subject" id="subject" />

    <textarea v-model="contactForm.message">Message</textarea>
    
    <input type="submit" name="ENVOYER" />
  </form>
</template>

<script>
export default {
  name: "ContactIncludeComponent",
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
    handleSubmit() {
      console.log({ contactForm: this.contactForm })
    }
  }
};
</script>
