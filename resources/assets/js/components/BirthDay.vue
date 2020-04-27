<template>
  <div class="input_birthdaydate__divider" @keyup.capture="updateValue">
    <input
      class="input_birthdaydate__input input_birthdaydate__input--day"
      v-if="showDay"
      ref="day"
      type="number"
      placeholder="dd"
      v-model="day"
      @input="updateDay"
      @blur="day = day.padStart(2, 0)"
    />

    <span
      class="input_birthdaydate__divider"
      v-if="showDay && showMonth"
      v-html="separator"
    />

    <input
      class="input_birthdaydate__input input_birthdaydate__input--month"
      v-if="showMonth"
      ref="month"
      type="number"
      placeholder="mm"
      v-model="month"
      @input="updateMonth"
      @blur="month = month.padStart(2, 0)"
    />

    <span
      class="input_birthdaydate__divider"
      v-if="showYear && (showDay || showMonth)"
      v-html="separator"
    />

    <input
      class="input_birthdaydate__input input_birthdaydate__input--year"
      v-if="showYear"
      ref="year"
      type="number"
      placeholder="aaaa"
      v-model="year"
    />
  </div>
</template>

<script>
export default {
  name: "BirthDayInputTagComponent",
  props: {
    value: {
      type: [Number, String],
      required: true
    },
    showDay: {
      type: Boolean,
      required: false,
      default: true
    },
    showMonth: {
      type: Boolean,
      required: false,
      default: true
    },
    showYear: {
      type: Boolean,
      required: false,
      default: true
    },
    separator: {
      type: String,
      required: false,
      default: "/"
    }
  },
  data() {
    const { value } = this;
    const val = new Date(value);

    return {
      day: value ? val.getDate() : "",
      month: value ? val.getMonth() + 1 : "",
      year: value ? val.getFullYear() : ""
    };
  },
  watch: {
    year(current, prev) {
      if (current.length > 3) {
        if (current > 9999) this.year = prev;
        if (current < 1900) this.year = prev;
      }
    }
  },
  methods: {
    updateDay() {
      if (!this.day.length || parseInt(this.day, 10) < 4) return;
      if (this.showMonth) {
        this.$refs.month.select();
      } else if (this.showYear) {
        this.$refs.year.select();
      }
    },
    updateMonth() {
      if (!this.month.length || parseInt(this.month, 10) < 2) return;
      if (this.showYear) this.$refs.year.select();
    },
    updateValue() {
      const { month, day, year } = this;
      const fullDate = `${month}/${day}/${year.padStart(4, 0)}`;
      // const timestamp = Date.parse(`${fullDate} 00:00:00`) / 1000

      // if (Number.isNaN(timestamp)) return
      this.$emit("input", fullDate);
    }
  }
};
</script>
