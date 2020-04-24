<template>
  <section class="testimony_include">
    <div class="title_section">
      <h3>Serez-vous l’un des nombreux gagnants ?</h3>
      <h2>Témoignages</h2>
    </div>

    <div
      class="pic_section"
      style="background-image: url('img/photo_temoignage_copie.png');"
    ></div>

    <div class="tesimonies_container">
      <ul>
        <li v-for="(testimony, i) in testimonies" :key="i">
          <blockquote>
            <p v-html="testimony.text" />
            <footer>
              <cite>{{ testimony.name }}</cite>
            </footer>
          </blockquote>
        </li>
      </ul>
    </div>
  </section>
</template>

<script>
export default {
  name: "TestimonyLandingInclude",
  data() {
    return {
      testimonies: [
        {
          text: `J’ai participé au concours<br>
            WONDERBOX et j’ai remporté un<br>
            weekend citytrip à Barcelone.<br>
            J’ai adoré, merci!`,
          name: "Julie D."
        }
      ]
    };
  }
};
</script>
