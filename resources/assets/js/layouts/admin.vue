<template>
  <div id="layout_viewport" class="landing_layout">
    
    <admin-navbar />

    <div class="content">
      <child />
    </div>
  </div>
</template>

<script>
import AdminNavbar from '~/components/AdminNavbar'

export default {
  name: "AdminLayout",
  components: {
    AdminNavbar
  }
};
</script>
