<!-- https://swiperjs.com/get-started/ -->
<template>
  <div
    class="swiper_component"
    v-swiper:swiperComponent="options"
    ref="swiperComponent"
  >
    <div class="swiper-wrapper">
      <slot />
    </div>
    <div v-if="!hidePagination" class="swiper-pagination"></div>
    <div v-if="!hideNavigation" class="swiper-button-prev"></div>
    <div v-if="!hideNavigation" class="swiper-button-next"></div>
    <div v-if="!hideScrollbar" class="swiper-scrollbar"></div>
  </div>
</template>

<script>
export default {
  name: "SwiperComponent",
  props: {
    classContainer: {
      type: String,
      require: false,
      default: ".swiper-container"
    },
    options: {
      type: Object,
      required: true,
      default: () => {}
    },
    hideScrollbar: {
      type: Boolean,
      required: false,
      default: false
    },
    hideNavigation: {
      type: Boolean,
      required: false,
      default: false
    },
    hidePagination: {
      type: Boolean,
      required: false,
      default: false
    }
  }
};
</script>
