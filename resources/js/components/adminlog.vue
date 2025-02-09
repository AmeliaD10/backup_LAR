<template>
    <div class="container">
      <router-link to="/login" class="admin-link">
        <button class="back-button">&lt;</button>
      </router-link>
  
      <div class="admin-box">
        <h2>Admin</h2>
        <form @submit.prevent="signIn">
          <div class="input-group">
            <label for="email">Email Address</label>
            <input type="email" v-model="email" placeholder="Email Address" required />
          </div>
          <div class="admin-group">
            <label for="password">Password</label>
            <input type="password" v-model="password" placeholder="Password" required />
          </div>
          
          <router-link to="/surdash" class="admin">Sign In</router-link>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      signIn() {
        // Handle sign in logic here
        alert(`Email: ${this.email}, Password: ${this.password}`);
        // Replace the alert with your actual sign-in logic (e.g., API call)
        // Redirect to the admin dashboard upon successful sign-in
        this.$router.push('/dash/surdash'); // Redirect to the admin dashboard
      },
    },
  };
  </script>
  
  <style scoped>
 @import "/css/style.css";
  </style>
  