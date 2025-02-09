<template>
  <div class="container">
    <button class="back-button" @click="goBack"> &lt; </button> <!-- Back button -->
    <div class="login-box">
      <h2>Login</h2>
      <form @submit.prevent="handleLogin">
        <div class="input-group">
          <label for="email">Email Address</label>
          <input type="email" v-model="email" placeholder="Email Address" required />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" v-model="password" placeholder="Password" required />
        </div>
        <button type="submit" class="sign-in-btn">Sign In</button>
      </form>
      <p>Don't have an account? <router-link to="/signup" class="signup-link">Signup</router-link></p>
    </div>

    <router-link to="/adminlog" class="admin-link">
      <button class="admin-button" id="adminBtn">Admin</button>
    </router-link>
  </div>
</template>

<script>
import axios from "axios"; // Import axios to make API requests

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1); // Go back to the previous page
    },
    async handleLogin() {
      try {
        const response = await axios.post("/login", {
          email: this.email,
          password: this.password,
        });

        if (response.data.message === "Login successful") {
          const user = response.data.user;

          // Store complete user data in localStorage
          localStorage.setItem("0", JSON.stringify(user));

          // Redirect based on user role
          if (user.role === "1") {
            this.$router.push("/surdash");
          } else {
            this.$router.push("/");
          }
        } else {
          alert(response.data.message || "Login failed, please try again.");
        }
      } catch (error) {
        alert(error.response?.data?.message || "An error occurred while logging in.");
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
@import "/css/style.css";
</style>
