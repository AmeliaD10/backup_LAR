<template>
  <div class="container">
    <button class="back-button" @click="goBack"> &lt; </button> <!-- Back button -->
    <div class="acc-box">
      <h2>Edit Account</h2>

      <div class="profile-picture-container">
        <img
          id="profile-picture-preview"
          :src="profilePicture"
          alt="Profile Picture"
          class="profile-picture"
        />
        <input
          type="file"
          @change="previewProfilePicture"
          accept="image/*"
          ref="profilePictureInput"
          :disabled="isSubmitting"
        />
      </div>

      <form @submit.prevent="updateUser">
        <div class="acc-group">
          <label for="first_name">First Name</label>
          <input
            type="text"
            v-model="user.first_name"
            placeholder="First Name"
            required
          />
        </div>

        <div class="acc-group">
          <label for="middle_name">Middle Name</label>
          <input
            type="text"
            v-model="user.middle_name"
            placeholder="Middle Name"
          />
        </div>

        <div class="acc-group">
          <label for="last_name">Last Name</label>
          <input
            type="text"
            v-model="user.last_name"
            placeholder="Last Name"
            required
          />
        </div>

        <div class="acc-group">
          <label for="email">Email Address</label>
          <input
            type="email"
            v-model="user.email"
            placeholder="Email Address"
            required
          />
        </div>

        <button type="submit" class="sign-in-btn" :disabled="isSubmitting">
          Update
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user: {
        first_name: "",
        middle_name: "",
        last_name: "",
        email: "",
        profile_picture: "",
      },
      profilePicture: "", // For the profile picture preview
      isSubmitting: false, // To disable the form during submission
    };
  },
  mounted() {
    this.fetchUser();
  },
  methods: {
    goBack() {
      this.$router.go(-1); // Go back to the previous page
    },
    fetchUser() {
      axios
        .get(`/api/users/${this.$route.params.id}`)
        .then((response) => {
          this.user = response.data;
          this.profilePicture = this.user.profile_picture
            ? `/img/${this.user.profile_picture}`
            : ""; // Set the profile picture preview if available
        })
        .catch((error) => {
          console.error("Error fetching user data:", error);
        });
    },
    previewProfilePicture(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          this.profilePicture = reader.result; // Update the profile picture preview
        };
        reader.readAsDataURL(file);
      }
    },
    updateUser() {
      this.isSubmitting = true; // Disable the form
      const formData = new FormData();
      formData.append("first_name", this.user.first_name);
      formData.append("middle_name", this.user.middle_name);
      formData.append("last_name", this.user.last_name);
      formData.append("email", this.user.email);

      if (this.$refs.profilePictureInput.files[0]) {
        formData.append(
          "profile_picture",
          this.$refs.profilePictureInput.files[0]
        );
      }

      axios
        .post(`/api/users/${this.$route.params.id}/update`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.isSubmitting = false; // Enable the form again
          alert("User updated successfully!"); // Add a success message
          this.$router.push("/profile"); // Redirect after successful update
        })
        .catch((error) => {
          this.isSubmitting = false; // Enable the form again
          console.error("Error updating user data:", error);
          alert("Failed to update user. Please try again."); // Add an error message
        });
    },
  },
};
</script>

<style scoped>
@import "/css/style.css";
</style>
