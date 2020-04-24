<template>
  <page name="categories_admin" type="admin">
    <div class="container">
      <h2>Concours & Avantage</h2>
    </div>

    <b-card>
      <b-row class="top_actions">
        <b-col md="6" class="my-1">
          <b-form-group
            label="Filter"
            label-cols-sm="3"
            label-align-sm="right"
            label-size="sm"
            label-for="filterInput"
            class="mb-0"
          >
            <b-input-group size="sm">
              <b-form-input
                v-model="filter"
                type="search"
                id="filterInput"
                placeholder="Type to Search"
              ></b-form-input>
              <b-input-group-append>
                <b-button :disabled="!filter" @click="filter = ''"
                  >Clear</b-button
                >
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>

        <b-col md="3" class="my-1">
          <b-button variant="primary" size="sm" @click="handleAdd"
            >Ajouter</b-button
          >
        </b-col>
      </b-row>

      <div class="content">
        <b-table hover :items="competitions" :fields="fields" :busy="isBusy">
          <template v-slot:cell(actions)="{ item }">
            <b-button variant="link" @click="handleEdit(item)">Editer</b-button>
            <b-button variant="link" @click="handleRemove(item)"
              >Supprimer</b-button
            >
          </template>
        </b-table>
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
  name: "CategoryAdminPage",
  middleware: "auth",
  layout: "admin",
  data() {
    return {
      isBusy: false,
      isCategoryModalOpen: false,
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
            return item.in_landing === '1' ? 'Oui' : 'Non'
          },
          sortable: true
        },
        {
          key: "on_top",
          label: "Afficher sur le haut",
          formatter: (value, key, item) => {
            return item.on_top === '1' ? 'Oui' : 'Non'
          },
          sortable: true
        }
      ],
      categoryForm: defaultCategoryForm,
      nameState: null
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
