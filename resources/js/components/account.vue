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
            ref="profileInput"
            @change="previewProfilePicture" 
            accept="image/*"
          />
        </div>
  
        <form @submit.prevent="updateAccount">
          <div class="acc-group">
            <label for="firstName">First Name</label>
            <input type="text" v-model="firstName" placeholder="First Name" required />
          </div>
          
          <div class="acc-group">
            <label for="middleName">Middle Name</label>
            <input type="text" v-model="middleName" placeholder="Middle Name" />
          </div>
  
          <div class="acc-group">
            <label for="lastName">Last Name</label>
            <input type="text" v-model="lastName" placeholder="Last Name" required />
          </div>
  
          <div class="acc-group">
            <label for="email">Email Address</label>
            <input type="email" v-model="email" placeholder="Email Address" required />
          </div>
  
          <div class="acc-group">
            <label for="password">New Password (optional)</label>
            <input type="password" v-model="password" placeholder="Leave blank to keep current password" />
          </div>
          
          <button type="submit" class="sign-in-btn">Update Profile</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        firstName: '',
        middleName: '',
        lastName: '',
        email: '',
        password: '',
        profilePicture: '/img/default-profile.jpg',
        userId: null,
        selectedFile: null
      };
    },
    created() {
      // Load user data from localStorage
      const userData = localStorage.getItem('0');
      if (userData) {
        const user = JSON.parse(userData);
        this.firstName = user.first_name;
        this.lastName = user.last_name;
        this.email = user.email;
        this.profilePicture = user.profile_picture || '/img/default-profile.jpg';
        this.userId = user.id;
      }
      
      // Fetch latest user data
      this.fetchUserData();
    },
    methods: {
      goBack() {
        this.$router.go(-1); // Go back to the previous page
      },
      async fetchUserData() {
        try {
          const response = await axios.get('/api/user');
          const userData = response.data;
          
          this.firstName = userData.first_name;
          this.lastName = userData.last_name;
          this.email = userData.email;
          this.profilePicture = userData.profile_picture || '/img/default-profile.jpg';
        } catch (error) {
          console.error('Error fetching user data:', error);
        }
      },
      previewProfilePicture(event) {
        const file = event.target.files[0];
        if (file) {
          this.selectedFile = file;
          const reader = new FileReader();
          reader.onload = (e) => {
            this.profilePicture = e.target.result; // Update profile picture
          };
          reader.readAsDataURL(file); // Read the file as a data URL
        }
      },
      async updateAccount() {
        try {
          // First, get the CSRF cookie
          await axios.get('/sanctum/csrf-cookie');
          
          const formData = new FormData();
          formData.append('first_name', this.firstName);
          formData.append('middle_name', this.middleName);
          formData.append('last_name', this.lastName);
          formData.append('email', this.email);
          
          if (this.password) {
            formData.append('password', this.password);
          }
          
          if (this.selectedFile) {
            formData.append('profile_picture', this.selectedFile);
          }
  
          // Log the formData contents
          for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
          }
  
          const response = await axios.post('/api/user/update', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            withCredentials: true
          });
  
          console.log('Response:', response.data); // Add logging
  
          if (response.data.success) {
            // Update localStorage with new user data
            const updatedUser = {
              ...JSON.parse(localStorage.getItem('0')),
              first_name: this.firstName,
              last_name: this.lastName,
              email: this.email,
              profile_picture: response.data.profile_picture || this.profilePicture
            };
            localStorage.setItem('0', JSON.stringify(updatedUser));
  
            alert('Profile updated successfully!');
            this.$router.push('/');
          }
        } catch (error) {
          console.error('Error updating profile:', error);
          console.error('Error response:', error.response?.data); // Add detailed error logging
          alert(error.response?.data?.message || 'Error updating profile');
        }
      }
    }
  };
  </script>
  
  <style scoped>
 @import "/css/style.css";
  </style>
  