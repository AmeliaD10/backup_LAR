<template>
  <div class="gifcontainer">
    <button class="back-button" @click="goBack"> &lt; </button> <!-- Back button -->
    <div class="signup-box">
      <h2>Create Account</h2>
      <!-- <div class="profile-picture-container">
        <img
          id="profile-picture-preview"
          :src="profilePicture || defaultProfilePicture"
          alt="Profile Picture"
          class="profile-picture"
        />
        <input 
          type="file" 
          ref="profilePictureInput" 
          @change="previewProfilePicture" 
          accept="image/*" 
        />
      </div> -->
      <form @submit.prevent="handleSignup">
        <div class="signup-group">
          <label for="firstName">First Name</label>
          <input v-model="firstname" placeholder="First Name" required />
        </div>

        <div class="signup-group">
          <label for="middleName">Middle Name</label>
          <input v-model="middlename" placeholder="Middle Name" />
        </div>

        <div class="signup-group">
          <label for="lastName">Last Name</label>
          <input v-model="lastname" placeholder="Last Name" required />
        </div>

        <div class="signup-group">
          <label for="email">Email Address</label>
          <input v-model="email" placeholder="Email" type="email" required />
        </div>

        <div class="signup-group">
          <label for="password">Password</label>
          <input v-model="password" placeholder="Password" type="password" required />
        </div>

        <button type="submit" class="sign-in-btn">Sign Up</button>
      </form>

      <p>
        Already have an account?
        <router-link to="/login" class="signup-link">Login</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      firstname: "",
      middlename: "",
      lastname: "",
      email: "",
      password: "",
      // profilePicture: null, // Holds the uploaded profile picture preview
      // defaultProfilePicture: "/img/default.png", // Path to default profile picture
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1); // Go back to the previous page
    },
    // previewProfilePicture(event) {
    //   const file = event.target.files[0];
    //   if (file) {
    //     const reader = new FileReader();
    //     reader.onload = (e) => {
    //       this.profilePicture = e.target.result; // Display preview
    //     };
    //     reader.readAsDataURL(file);
    //   }
    // },
    async handleSignup() {
      try {
        const formData = new FormData();
        formData.append("first_name", this.firstname); 
        formData.append("middle_name", this.middlename); 
        formData.append("last_name", this.lastname); 
        formData.append("email", this.email);
        formData.append("password", this.password);

        // const fileInput = this.$refs.profilePictureInput?.files[0];
        // if (fileInput) {
        //   formData.append("profile_picture", fileInput);
        // }

        const response = await axios.post("/register", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });

        alert(response.data.message || "Account created successfully!");
        this.$router.push("/login");
      } catch (error) {
        alert(
          error.response?.data?.message || "An error occurred while creating the account."
        );
        console.error(error);
      }
    },
    goToAdmin() {
      this.$router.push("/adminlog"); // Navigate to the admin page
    },
  },
};
</script>

<style scoped>
@import "/css/style.css";
</style>