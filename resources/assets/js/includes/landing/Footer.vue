<template>
  
  <footer class="footer_landing_include_wrapper">
    <section class="form" style="background-image: url('img/vague_contact.png');">
      <div class="container">
        <b-row>
          <b-col md="6">
            <contact-form />
          </b-col>
          <b-col md="6">
            <div class="brands_logos">
              <div class="club_avantages">
                <img src="img/logos/club_avantage.png" />
              </div>
              <div class="partners">
                <div class="beobank">
                  <img src="img/logos/beobank.png" alt="Beobank _ Partners _ ClubAvantages">
                </div>
                <div class="rtltvi">
                  <img src="img/logos/rtltvi.png" alt="RTL TVI _ Partners _ ClubAvantages">
                </div>
                <div class="belrtl">
                  <img src="img/logos/bel_rtl.png" alt="Bel RTL _ Partners _ ClubAvantages">
                </div>
              </div>
            </div>
          </b-col>
        </b-row>
      </div>
    </section>
    <section class="copyright">
      <p>
        Website by   <br/>                                     
Copyright 2020 Belgium s.a. Belgique - Av Jacques Georgin, 2B-1030 Bruxelles<br/>
<b>Règlement des concours I Conditions Générales I Vie privée I Conditions d’utilisation RTL Belgium</b>
      </p>
    </section>
  </footer>

</template>

<script>
export default {
  name: 'FooterLandingInclude'
}