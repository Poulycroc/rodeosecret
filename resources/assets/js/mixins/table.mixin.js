const authorizedActions = ["edit", "show", "delete"];

export default {
  name: "TableMixin",
  props: {
    hideActions: {
      type: Boolean,
      required: false,
      default: false
    },
    actions: {
      type: Array,
      required: false,
      validator: prop => prop.every(e => authorizedActions.includes(e)),
      default: () => ["edit", "delete"]
    }
  },
  data() {
    return {
      currentPage: 1,
      filter: null,
      totalRows: "",
      perPage: 50
    };
  },
  methods: {
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },

    /**
     * @param {String} action
     * @return {Boolean}
     */
    showAction(action) {
      return this.actions.includes(action);
    },

    handleShow(item) {
      this.$emit("show", item);
    },
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
