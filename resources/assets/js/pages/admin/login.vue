<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <b-card :title="$t('login')">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("email")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.email"
                type="email"
                name="email"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('email') }"
              />
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">{{
              $t("password")
            }}</label>
            <div class="col-md-7">
              <input
                v-model="form.password"
                type="password"
                name="password"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('password') }"
              />
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Remember Me -->
          <div class="form-group row">
            <div class="col-md-3"></div>
            <div class="col-md-7 d-flex">
              <b-form-checkbox v-model="remember" name="remember">
                {{ $t("remember_me") }}
              </b-form-checkbox>

              <router-link
                :to="{ name: 'admin.password.request' }"
                class="small ml-auto my-auto"
              >
                {{ $t("forgot_password") }}
              </router-link>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <b-button
                type="submit"
                :loading="form.busy"
              >
                {{ $t("login") }}
              </b-button>
            </div>
          </div>
        </form>
      </b-card>
    </div>
  </div>
</template>

<script>
import Form from "vform";

export default {
  middleware: "guest",
  layout: 'sign',
  metaInfo() {
    return { title: this.$t("login") };
  },

  data: () => ({
    form: new Form({
      email: "",
      password: ""
    }),
    remember: false
  }),

  methods: {
    async login() {
      const { data } = await this.form.post("login");
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember
      });
      await this.$store.dispatch("auth/fetchUser");
      this.$router.push({ name: 'admin.dashboard' });
    }
  }
};
</script>
