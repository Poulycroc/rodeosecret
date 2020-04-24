<template>
  <div id="layout_viewport" class="landing_layout">

    <main class="content_sign">
      <div class="content">
        <child />
      </div>
    </main>

  </div>
</template>

<script>
import AdminNavbar from '~/components/AdminNavbar'

export default {
  name: "SignLayout",
  components: {
    AdminNavbar
  }
};
</script>
