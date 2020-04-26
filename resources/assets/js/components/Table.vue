<template>
  <div class="table_container_wrapper">
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

    <b-table
      hover
      sort-icon-left
      :per-page="perPage"
      :items="items"
      :fields="fields"
      :filter="filter"
      :busy="isBusy"
      :current-page="currentPage"
      @filtered="onFiltered"
    >
      <template v-slot:cell(actions)="{ item }">
        <b-button variant="link" @click="handleEdit(item)">Editer</b-button>
        <b-button variant="link" @click="handleRemove(item)">
          Supprimer
        </b-button>
      </template>
    </b-table>

    <b-pagination
      v-model="currentPage"
      aria-controls="table"
      :total-rows="items.length"
      :per-page="perPage"
    />
  </div>
</template>

<script>
import tableMixin from "~/mixins/table.mixin";

export default {
  name: "TableContainerComponent",
  mixins: [tableMixin],
  props: {
    items: {
      type: Array,
      required: true,
      default: () => []
    },
    fields: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      isBusy: false
    }
  },
  methods: {
    handleEdit(item) {
      this.$emit("edit", item);
    },
    handleRemove(item) {
      this.$emit("delete", item);
    },
    handleAdd() {
      this.$emit("add", true);
    }
  }
};
</script>
