<template>
  <div class="swipe_concours custom slider">
    <swiper
      hide-navigation
      hide-scrollbar
      class="slides"
      :options="swiperOptions"
    >
      <div
        v-for="(competition, i) in competitions"
        :key="i"
        class="swiper-slide"
      >
        <article class="platform-item" @click="handleCompet(competition)">
          <header>
            <img
              v-if="competition.image"
              :src="rendImg(competition.image)"
              :alt="competition.image.alt"
            />
            <h2>{{ competition.title }}</h2>
          </header>
          <p style="padding: 15px 35px;">
            {{ competition.description }}
            <a title="">participer au concours ?</a>
          </p>
        </article>
      </div>
    </swiper>

    <b-modal
      ref="signinCompetitionModal"
      modal-class="sign_competition_modal_custom"
      hide-footer
    >
      <sign-competition-form @submited="handleSubmited" />
    </b-modal>
  </div>
</template>

<script>
import Swiper from "~/components/Swiper";
import { mapActions } from "vuex";

export default {
  name: "CompetitionsSliderlandingIncludes",
  components: {
    Swiper
  },
  data() {
    return {
      isModalOpen: false,
      swiperOptions: {
        autoplay: true,
        slidesPerView: 3
      }
    };
  },
  computed: {
    competitions() {
      return this.$store.getters["competitions/landingCompetitions"];
    }
  },
  mounted() {
    this.getLandingCompetitions();
  },
  methods: {
    ...mapActions({
      getLandingCompetitions: "competitions/getLandingCompetitions",
      getCompetition: "competitions/getCompetition"
    }),

    showModal() {
      this.$refs["signinCompetitionModal"].show();
    },

    handleSubmited() {
      this.$refs["signinCompetitionModal"].hide();
    },

    async handleCompet({ id }) {
      await this.getCompetition(id);
      this.showModal();
    },

    /**
     * @return {String}
     */
    rendImg({ src }) {
      return `/storage/img/competitions/${src}`
    }
  }
};
</script>
