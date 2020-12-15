/* eslint-disable */
import { extend, ValidationObserver, ValidationProvider } from "vee-validate";
import Vue from "vue";
import {
    required,
    email,
    length
} from "vee-validate/dist/rules";

Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);

extend("required", {
    ...required,
    message: "This field is required"
});

extend("email", {
    ...email,
    message: "This field must be a valid email"
});

extend("length", {
    ...length,
    message: "This field must have 2 options"
});

extend("min", {
    validate(value, args) {
        return value.length >= args.length;
    },
    params: ["length"],
    message: "This must be at least {length} caracters"
});

extend("max", {
    validate(value, args) {
        return value.length <= args.length;
    },
    params: ["length"],
    message: "This must be less than {length} caracters."
});

extend('username', {
    validate: value => value.match(/^[A-Za-z0-9]{3,15}$/g) !== null,     
    message: 'Username contain alphabets and numbers only.'
});

extend('contact', {
    validate: value => value.match(/^\d{8,10}$/g) !== null,
    message: 'Contact number must contains numbers only.'
});

extend('password', {      
    validate: value => value.match(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%&])[A-Za-z\d!@#$%&]{6,15}$/g) !== null,     
    message: 'Password must contain alphabets, numbers and special(! @ # $ % &) characters.'
});