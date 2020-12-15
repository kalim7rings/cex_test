<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col class="mt-3" md="4" offset-md="4">
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
          <b-form @submit.stop.prevent="handleSubmit(login)">
           <h3>Login</h3><br>
            <validation-provider
              name="Username"
              rules="required|min:3|max:15|username"
              v-slot="validationContext"
            >
              <b-form-group
                id="example-input-group-username"
                label="Username"
                label-for="example-input-username"
              >
                <b-form-input
                  id="example-input-username"
                  name="example-input-username"
                  v-model="form.username"
                  :state="getValidationState(validationContext)"
                  aria-describedby="input-1-live-feedback"
                ></b-form-input>

                <b-form-invalid-feedback id="input-username-live-feedback">{{
                  validationContext.errors[0]
                }}</b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
              name="Password"
              rules="required|min:6|max:15"
              v-slot="validationContext"
            >
              <b-form-group
                id="example-input-group-password"
                label="Password"
                label-for="example-input-password"
              >
                <b-form-input
                  id="example-input-password"
                  name="example-input-password"
                  v-model="form.password"
                  type="password"
                  :state="getValidationState(validationContext)"
                  aria-describedby="input-password-live-feedback"
                ></b-form-input>

                <b-form-invalid-feedback id="input-password-live-feedback">{{
                  validationContext.errors[0]
                }}</b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <b-button type="submit" variant="primary">Login</b-button>
            <span class="text-right">
              <router-link to="/user/register/">Register</router-link>
            </span>
          </b-form>
        </validation-observer>
      </b-col>
      <b-overlay :show="show" no-wrap></b-overlay>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        password: null,
        username: null,
      },
      show: false
    };
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
     login() {   
     this.show = true;
        this.$store.dispatch("login", this.form)
        .then(response => {})
        .catch(error => {})
        .finally(() => {
           this.show = false;
        });
    }
  }
};
</script>
