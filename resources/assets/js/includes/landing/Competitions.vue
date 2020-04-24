<template>
  <section class="competition_includes">
    <div
      class="background_container"
      style="background-image: url('img/photo_concours.jpg');"
    />
    <div class="container">
      <div class="title">
        <span>Pour les membres</span>
        <h2>TOUS LES CONCOURS & LES avantages</h2>
      </div>
      <div class="swipe_concours">
        <swiper hide-navigation hide-scrollbar :options="swiperOptions">
          <div class="swiper-slide">
            <div class="platform-item">
              slide
            </div>
          </div>
          <div class="swiper-slide">
            <div class="platform-item">
              slide
            </div>
          </div>
          <div class="swiper-slide">
            <div class="platform-item">
              slide
            </div>
          </div>
          <div class="swiper-slide">
            <div class="platform-item">
              slide
            </div>
          </div>
          <div class="swiper-slide">
            <div class="platform-item">
              slide
            </div>
          </div>
          <div class="swiper-slide">
            <div class="platform-item">
              slide
            </div>
          </div>
        </swiper>
      </div>
    </div>
  </section>
</template>

<script>
import Swiper from "~/components/Swiper";

export default {
  name: "CompetitionslandingIncludes",
  components: {
    Swiper
  },
  data() {
    return {
      swiperOptions: {
        autoplay: true,
        slidesPerView: 3
      }
    };
  }
};
</script>
