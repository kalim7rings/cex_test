export const state = () => ({   
    user: localStorage.getItem('loggedInUser') > 0 ? localStorage.getItem('loggedInUser') : 0,
});

export const getters = {
     isAuthenticated(state) {
        return state.user > 0 ? true : false;
    },
    
    loggedInUser(state) {
        return state.user;
    }
};

export const mutations = {
    SET_USER(state, payload) {
        state.user = payload;
    }
};

export const actions = {   
    async login({ commit }, { username, password }) {

         try {
            const response = await this.$axios.$post("/user/login", { username, password });

            localStorage.setItem('loggedInUser', response.user);            
            commit("SET_USER", response.user);
            this.$router.push(`/user/profile/${response.user}`);

        } catch (error) {
           
            this._vm.$bvToast.toast('Username or password is wrong.', {
                title: `Error`,
                variant: 'danger',
                toaster: 'b-toaster-top-center',
                solid: true
            }); 
        } 
    },
    async register({ commit }, { password,email,username, contact }) {

        try {
          await this.$axios.$post("/user/register", { password,email,username, contact});

            this._vm.$bvToast.toast('User registered successfully.', {
                title: `Success`,
                variant: 'success',
                toaster: 'b-toaster-top-center',
                solid: true
            }); 

            setTimeout(() => {
                this.$router.push(`/user/login`);
            }, 100);          

       } catch (error) {
           
           this._vm.$bvToast.toast(error.data.message || 'Some error occured, Try again later!', {
                title: `Error`,
                variant: 'danger',
                toaster: 'b-toaster-top-center',
                solid: true
            }); 
       } 
   },
    async logout({ commit }) {
       localStorage.setItem('loggedInUser', 0);
        commit("SET_USER", 0);
        this.$router.push(`/user/login`);
    }
};