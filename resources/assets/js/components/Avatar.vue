<template>
  <img :src="rendProfilePic" :style="styleObj" />
</template>

<script>
export default {
  name: "AvatarComponent",
  props: {
    user: {
      type: Object,
      required: true
    },
    size: {
      type: Number,
      required: false,
      default: 50
    },
    radius: {
      type: String,
      required: false,
      default: '50%'
    }
  },
  computed: {
    rendProfilePic() {
      const email = this.user;
      return ["https://api.adorable.io/avatars", this.size, email].join("/");
    },
    styleObj() {
      return {
        borderRadius: this.radius
      }
    }
  }
};
</script>
