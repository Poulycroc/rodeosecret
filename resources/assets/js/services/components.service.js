/**
 * @package     creativeRoom
 * @component   Components services
 * @author      Maxime Bartier <poulycroc.studio@gmail.com>
 *
 * @note        Add globaly all components needed
 */
import Vue from "vue";
import { HasError, AlertError, AlertSuccess } from "vform";
import { toKebabCase } from "~/utils";

// Basic components
import Child from "~/components/Child";
import Loading from "~/components/Loading";
import Avatar from "~/components/Avatar";
import TableContainer from "~/components/Table";
import BirthDay from "~/components/BirthDay";
import Page from "~/components/tools/YieldPage";

import Contact from "~/components/forms/ContactForm";
import AddCategory from "~/components/forms/AddCategory";
import SignCompetition from "~/components/forms/SignCompetition";
import AddCompetition from '~/components/forms/AddCompetition'

const importer = {
  components: {
    Loading,
    Avatar,
    Page,
    Child,
    HasError,
    AlertError,
    AlertSuccess,
    TableContainer,
    BirthDay
  },

  forms: {
    Contact,
    AddCategory,
    AddCompetition,
    SignCompetition
  }
};

/**
 * Injecting all components inside the propject
 */
Object.keys(importer).forEach(key => {
  const extend = key !== "components" ? `-${key.slice(0, -1)}` : "";
  Object.keys(importer[key]).forEach(elem => {
    const name = toKebabCase(elem) + extend;
    Vue.component(name, importer[key][elem]);
  });
});
