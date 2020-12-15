<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#">Cex User</b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
          <b-navbar-nav v-if="isAuthenticated">
            <b-nav-item @click="logout">Logout</b-nav-item>
          </b-navbar-nav>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>

import { mapGetters } from "vuex";

export default {
  methods:{
    logout() {    
      this.$store.dispatch("logout");
    },
    isUserLoggedIn(){

      if(this.loggedInUser == 0){

        this.$router.push(`${this.$route.path}`);
        return false;
      }

      this.$router.push(`/user/profile/${this.loggedInUser}`);   
    }
  },
   mounted() {    
    this.isUserLoggedIn();
  },
  computed: {
    ...mapGetters(["isAuthenticated", "loggedInUser"])
  }
};
</script>
