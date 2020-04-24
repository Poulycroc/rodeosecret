<template>
  <b-card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
  </b-card>
</template>

<script>
export default {
  middleware: 'auth',
  layout: 'admin',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>