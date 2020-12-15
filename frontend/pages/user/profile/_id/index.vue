<template>
  <b-container class="bv-example-row">
    <b-row>
      <b-col class="mt-3" md="4" offset-md="4">
        <b-card no-body v-if="this.userData" style="max-width: 20rem;">
          <b-card-body>
            <b-card-title>Details</b-card-title>
            <b-card-text
              ><br />
              Username : {{ userData.username }} <br /><br />
              Email : {{ userData.email }} <br /><br />
              contact : {{ userData.contact }} <br />

            </b-card-text>
          </b-card-body>
        </b-card>
      </b-col>
      <b-overlay :show="show" no-wrap></b-overlay>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      userData: {},
      show: true
    };
  },
  methods: {
    async getUserDetails() {
      try {
        let response = await this.$axios.get(`user/profile/${this.loggedInUser}`);

        this.userData = response.data;
        this.show = false;

        // gaya
        // baster

       // console.log(this.userData);
      } catch (error) {
       // console.log(error);
        return false;
      }
    },
  },
  mounted() {    
    //this.isUserLoggedIn();
     this.getUserDetails();   
  },
  computed: {
    ...mapGetters(["loggedInUser"])
  }
};
</script>
