<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col class="mt-3" md="4" offset-md="4">
        <validation-observer ref="observer" v-slot="{ handleSubmit }">
          <b-form @submit.stop.prevent="handleSubmit(register)">
           <h3>Register</h3><br>
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
              name="Email"
              rules="required|email|min:3"
              v-slot="validationContext"
            >
              <b-form-group
                id="example-input-group-email"
                label="Email"
                label-for="example-input-email"
              >
                <b-form-input
                  id="example-input-email"
                  name="example-input-email"
                  type="email"
                  v-model="form.email"
                  :state="getValidationState(validationContext)"
                  aria-describedby="input-email-live-feedback"
                ></b-form-input>

                <b-form-invalid-feedback id="input-email-live-feedback">{{
                  validationContext.errors[0]
                }}</b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <validation-provider
              name="Password"
              rules="required|min:6|max:15|password"
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

            <validation-provider
              name="Contact"
              rules="required|contact"
              v-slot="validationContext"
            >
              <b-form-group
                id="example-input-group-contact"
                label="Contact"
                label-for="example-input-contact"
              >
                <b-form-input
                  id="example-input-contact"
                  name="example-input-contact"
                  maxlength="10"
                  v-model="form.contact"
                  :state="getValidationState(validationContext)"
                  aria-describedby="input-contact-live-feedback"
                ></b-form-input>

                <b-form-invalid-feedback id="input-contact-live-feedback">{{
                  validationContext.errors[0]
                }}</b-form-invalid-feedback>
              </b-form-group>
            </validation-provider>

            <b-button type="submit" variant="primary">Submit</b-button>
            <span class="text-right">
              <router-link to="/user/login/">Login</router-link>
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
      show: false,
      form: {
        password: null,
        email: null,
        username: null,
        contact: null
      }
    };
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },
    register() {      
        this.show = true;
        this.$store.dispatch("register", this.form)
        .then(response => {})
        .catch(error => {})
        .finally(() => {
           this.show = false;
        });
    }
  }
};
</script>
