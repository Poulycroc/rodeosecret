<template>
  <div :id="pageName" :class="cls" class="page_content_wrapper">
    <slot />
  </div>
</template>

<script>
import { makeKey } from "~/utils";

export default {
  name: "YieldPageTools",
  props: {
    name: {
      type: String,
      required: false,
      default: makeKey(10)
    },
    type: {
      type: String,
      required: false,
      default: "basic"
    }
  },
  computed: {
    /**
     * @return {String}
     */
    pageName() {
      return `${this.name}_page`;
    },

    /**
     * @return {String}
     */
    cls() {
      return `is-${this.type}`;
    }
  }
};
</script>
