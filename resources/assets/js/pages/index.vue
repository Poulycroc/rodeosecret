<template>
  <div id="wrapper_landing_view">
    <nav-bar />
    <header class="container" id="top">
      <img class="bck top" src="img/top-bckgrd-right.png" />
      <img class="title" src="img/clubAvantageTitle.png" alt="Club Avantage" />
      <section class="col-12 col-md-12 col-lg-8 col-xl-6 one">
        <h5>Découvrez le Club</h5>
        <h2>Devenez membre gratuitement</h2>
        <p>Vous êtes client Beobank?</p>
        <p class="justify">
          Le Club Avantages a été conçu pour vous ! Profitez chaque mois d'une
          multitude de concours et avantages (des expériences uniques avec des
          animateurs d’RTL, des tickets pour les plus grands concerts et
          spectacles, des tickets de cinéma, des chèques voyages...).
        </p>
      </section>
      <img class="bck bottom" src="img/top-bckgrd-left.png" />

      <section class="col-12 col-md-12 col-lg-8 col-xl-6 inscription">
        <h5>S'inscrire est très facile</h5>
        <ul>
          <li>
            <p>1</p>
            <span></span
            ><a
              href="https://www.beobank.be/fr/particulier/"
              target="_blank"
              title="Enregistrez-vous via Beobank"
              ><u>Enregistrez-vous via Beobank</u>&nbsp;</a
            ><span class="span2">pour accéder au Club</span>
          </li>
          <li>
            <p>2</p>
            <span>Choisissez le concours qui vous tente le plus</span>
          </li>
          <li>
            <p>3</p>
            <span>Cliquer sur « participer »</span>
          </li>
          <li>
            <p>4</p>
            <span>Voilà votre participation est enregistrée</span>
          </li>
        </ul>
        <div class="ctas">
          <div>
            <h4>Enregistrez-vous et profitez du Club !</h4>
            <a
              href="https://www.beobank.be/fr/particulier/rejoignez-le-club-et-profitez-des-avantages-rtl-tvi-et-bel-rtl"
              target="_blank"
              class="btn btn-1"
              >S'enregistrer</a
            >
          </div>
          <div>
            <h4>Vous n'êtes pas encore client Beobank ?</h4>
            <a
              href="https://www.beobank.be/fr/particulier/"
              target="_blank"
              class="btn btn-2"
              >Devenir client Beobank</a
            >
          </div>
        </div>
      </section>
    </header>

    <section id="one">
      <div class="container">
        <h5>Pour les membres</h5>
        <h2>Tous les concours & les avantages</h2>
        <div class="slider">
          <competitions-slider />
        </div>
      </div>
    </section>

    <section id="two">
      <h5>Pour ne rien rater de nos news et concours</h5>
      <h2>Rejoignez-nous!</h2>
      <div>
        <a
          href="https://www.facebook.com/clubavantages/"
          target="_blank"
          title="Facebook"
        >
          <img src="img/facebook.png" alt="Facebook" />
        </a>
        <a
          href="https://www.instagram.com/club_avantages/"
          target="_blank"
          title="Instagram"
        >
          <img src="img/instagram.png" alt="Instagram" />
        </a>
      </div>
    </section>

    <section id="three" class="container">
      <img class="bck" src="img/top-bckgrd-left-three.png" />
      <h5>Serez-vous l'un des nombreux gagnant ?</h5>
      <h2>Témoignages</h2>

      <article class="col-12 col-md-12 col-lg-6">
        <p>
          J'ai participé au concours WONDERBOX et j'ai remporté un weekend
          citytrip à Barcelone. J'ai adoré, merci!
        </p>
        <p class="author">Julie D.</p>
      </article>
    </section>

    <section id="contact" name="contact" class="container">
      <div class="col-12 col-md-12 col-lg-6">
        <contact />
      </div>
      <div class="sponsor col-12 col-md-12 col-lg-6">
        <img
          class="clubavantage"
          src="img/clubAvantageTitle.png"
          alt="Club Avantages"
        />
        <div>
          <a
            href="https://www.beobank.be/fr/particulier/"
            target="_blank"
            title="Beobank"
            ><img src="img/BEOBANK.png" alt="BEOBANK"
          /></a>
          <a href="https://www.rtlplay.be/tvi" target="_blank" title="RTL TVI"
            ><img src="img/RTL-TVI.png" alt="RTL-TVI"
          /></a>
          <a
            href="https://www.rtl.be/belrtl/index-bel-rtl.htm"
            target="_blank"
            title="Bel RTL"
            ><img src="img/BEL_RTL.png" alt="BEL_RTL"
          /></a>
        </div>
      </div>
    </section>

    <footer>
      <p>
        Website by
        <a
          href="http://www.creativeroom.be/"
          target="_blank"
          title="Creativeroom"
        >
          <img src="img/creativeroom.png" alt="Creativeroom"
        /></a>
      </p>
      <p>
        Copyright 2020 Belgium s.a. Belgique -
        <a
          href="https://www.google.com/maps?q=Copyright+2020+Belgium+s.a.+Belgique+-+Av+Jacques+Georgin,+2B-1030+Bruxelles&um=1&ie=UTF-8&sa=X&ved=2ahUKEwj_0bK7z4bpAhXD0qQKHbF5CRYQ_AUoAXoECAwQAw"
          target="_blank"
          title="Av Jacques Georgin, 2B-1030 Bruxelles"
          >Av Jacques Georgin, 2B-1030 Bruxelles</a
        >
      </p>
      <p>
        <a
          target="_blank"
          href="https://clubavantages.be/medias/blockcontent/33/trad_image/fra//static/files/reglements-concours.pdf/reglements-concours.pdf
"
          title="Règlement des concours"
          >Règlement des concours</a
        >
        |
        <a target="_blank" href="#" title="Conditions Générales"
          >Conditions Générales</a
        >
        |
        <a
          target="_blank"
          href="https://clubavantages.be/charte-vie-privee
"
          title="Vie privée"
          >Vie privée</a
        >
        |
        <a
          target="_blank"
          href="https://clubavantages.be/conditions-utilisation"
          title="Conditions d’utilisation RTL Belgium"
          >Conditions d’utilisation RTL Belgium</a
        >
      </p>
    </footer>
  </div>
</template>

<script>
import NavBar from "~/includes/landing/NavBar";
import CompetitionsSlider from "~/includes/landing/CompetitionsSlider";
import Contact from "~/includes/landing/Contact";

export default {
  name: "LandingPage",
  components: {
    NavBar,
    CompetitionsSlider,
    Contact
  },
  data() {
    return {
      title: window.config.appName
    };
  }
};
</script>
