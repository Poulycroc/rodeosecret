<template>
  <page name="categories_admin" type="admin">
    <div class="container">
      <h2>Participations</h2>
    </div>

    <b-card>
      <div class="content">
        <table-container
          :items="participants"
          :fields="fields"
          :actions="['show']"
          @add="handleAdd"
          @edit="handleEdit"
          @show="handleShow"
          @delete="handleRemove"
        />
      </div>
    </b-card>

    <b-modal
      v-model="isCategoryModalOpen"
      title="BootstrapVue"
      @hidden="handleHidden"
      @cancel="handleHidden"
      @ok="handleSubmit"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          :state="nameState"
          label="Name"
          label-for="name-input"
          invalid-feedback="Name is required"
        >
          <b-form-input
            id="name-input"
            v-model="categoryForm.name"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
  </page>
</template>

<script>
import { mapGetters } from "vuex";

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
      fields: [
        {
          key: "actions",
          label: "Action",
          formatter: value => value
        },
        {
          key: "title",
          label: "Concours/avantages",
          sortable: true
        },
        {
          key: "count",
          label: "Nombre de participants",
          formatter: (value, key, item) => {
            return item.participants.length;
          },
          sortable: true
        }
      ],
      categoryForm: defaultCategoryForm,
      nameState: null
    };
  },
  created() {
    this.$store.dispatch("participants/getParticipants");
  },
  computed: {
    ...mapGetters({
      participants: "participants/participants"
    })
  },
  methods: {
    toggleModal(status) {
      this.isCategoryModalOpen = status;
    },
    handleAdd() {
      this.categoryForm.name = "";
      this.toggleModal(true);
    },
    handleHidden() {
      this.categoryForm = defaultCategoryForm;
      this.nameState = null;
      this.toggleModal(false);
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    handleSubmit($event) {
      this.categoryForm.name = "";
      this.nameState = null;
    },
    handleOk(bvModalEvt) {
      bvModalEvt.preventDefault();
      this.handleSubmit();
    },
    handleSubmit() {
      if (!this.checkFormValidity()) return;
      const { id, name } = this.categoryForm;
      this.isBusy = true;
      if (id === null) {
        this.$store.dispatch("categories/setCategories", { name });
      } else {
        this.$store.dispatch(`categories/editCategories`, { id, name });
      }

      this.categoryForm = defaultCategoryForm;
      this.toggleModal(false);
      this.isBusy = false;
    },

    handleShow({ id }) {
      this.$router.push({ name: "admin.participations.show", params: { id } });
    },
    handleEdit({ id, name }) {
      this.categoryForm = {
        id,
        name
      };
      this.toggleModal(true);
    },
    handleRemove(item) {
      this.showDeleteMessage(item.id);
    },

    showDeleteMessage(id) {
      this.$bvModal
        .msgBoxConfirm("Supprimer la catégorie ?", {
          title: "Attention",
          size: "sm",
          buttonSize: "sm",
          okVariant: "danger",
          okTitle: "Oui",
          cancelTitle: "Non",
          hideHeaderClose: false,
          centered: true
        })
        .then(() => this.$store.dispatch("categories/deleteCategories", { id }))
        .catch(err => console.log(err));
    }
  }
};
</script>
