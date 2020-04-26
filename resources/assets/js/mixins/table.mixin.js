export default {
  name: 'TableMixin',
  data() {
    return {
      currentPage: 1,
      filter: null,
      totalRows: '',
      perPage: 50
    }
  },
  methods: {
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  }
}
