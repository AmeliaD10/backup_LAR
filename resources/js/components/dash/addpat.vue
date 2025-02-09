<template>
  <div>
    <!-- Sidebar Menu -->
    <aside class="sidebar">
      <div class="sidebar-logo">
        <img src="img/ball.png" alt="" />
        <h1>PurrfectPaw</h1>
  </div>

      <div class="menu-title">
        <h2>Menu</h2>
      </div>

 <!-- Dashboard Navigation -->
<nav class="dashboard-container">
<div class="dashboard-item">
  <router-link to="/surdash">
    <img
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/6e8bd773eacc25a5a7c40ef9519fa49fa25227792ae45f3bbde5bffe096108dc?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
      alt="Dashboard Icon"
      class="dashboard-icon"
    />
    <span class="dashboard-text">Dashboard</span>
  </router-link>
</div>

      <!--CLINIC-->
<div class="dashboard-item">
  <router-link to="/clinic">
    <img
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/0c81f4896780ee5fff882420cda3496b54a0b384d49af9f6ad84b888fc0a6f14?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
      alt="Appointments Icon"
      class="dashboard-icon"
    />
    <span class="dashboard-text">Clinic Management</span>
  </router-link>
</div>

      <!--APPOINTMENT-->
<div class="dashboard-item">
  <router-link to="/dashappoint">
    <img
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/0c81f4896780ee5fff882420cda3496b54a0b384d49af9f6ad84b888fc0a6f14?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
      alt="Appointments Icon"
      class="dashboard-icon"
    />
    <span class="dashboard-text">Appointments</span>
  </router-link>
</div>
<div class="dashboard-item">
  <router-link to="/dashdoctors">
    <img
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/0c81f4896780ee5fff882420cda3496b54a0b384d49af9f6ad84b888fc0a6f14?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
      alt="Doctors Icon"
      class="dashboard-icon"
    />
    <span class="dashboard-text">Doctors</span>
  </router-link>
</div>
<div class="dashboard-item">
  <router-link to="/patientrecord">
    <img
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f4ba720e3eb36f88cbeeb39506756fb59283ea9643aba3db323aa6e8f900afe?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
      alt="Patients Record Icon"
      class="dashboard-icon"
    />
    <span class="dashboard-text">Patients Record</span>
  </router-link>
</div>
</nav>
</aside>


   
    <div class="main-content">
      <header class="header">
        <div class="search-container">
          <input type="text" placeholder="Search" class="search-input" />
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/cd078eb6f9ce86265999269e4046c2dcec9bec7d140ae886d7ae3f419a2c7a16?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
            alt="Search icon"
            class="search-icon"
            loading="lazy"
          />
        </div>

<!--users-->

        <section class="dash-user-profile">
          <div class="user-info">
            <img
              src="img/clarenceadmin.jpg"
              alt="Moni Roy's profile picture"
              class="user-avatar"
            />
            <div class="user-details">
              <h2 class="user-name">Gumball</h2>
              <p class="user-role">Admin</p>
            </div>
            <img src="img/dropdown.png" alt="Dropdown icon" class="dropdown-icon" />
          </div>
          <button class="logout-button hidden" id="logout-button">
            <span class="logout-text">Logout</span>
          </button>
        </section>
      </header>


      <!-- end of users-->
  
        <!-- Add Patient Record Form -->
        <h1 class="section-title">Add Patient Record</h1>
        <div class="addpat-form-container">
          <form class="addpat-form" @submit.prevent="submitForm">
            <div class="form-column">
              <label for="addpat-name">Name</label>
              <input
                type="text"
                id="addpat-name"
                v-model="formData.name"
                placeholder="Full Name"
                required
              />
  
              <label for="addpat-phone">Phone Number</label>
              <input
                type="text"
                id="addpat-phone"
                v-model="formData.phone"
                placeholder="09*********"
                required
              />
  
              <label for="pet">Pet</label>
              <select id="pet" v-model="formData.pet" required>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
              </select>
  
              <label for="addpat-breed">Breed</label>
              <input
                type="text"
                id="addpat-breed"
                v-model="formData.breed"
                placeholder="Ex. Husky"
                required
              />
            </div>
  
            <div class="form-column">
              <label for="addpat-treatment">Treatment</label>
              <select id="addpat-treatment" v-model="formData.treatment" required>
                <option value="rabies">Rabies</option>
                <option value="vaccination">Vaccination</option>
                <option value="checkup">Checkup</option>
                <option value="immunization">Immunization</option>
              </select>
  
              <label for="addpat-petname">Pet's Name</label>
              <input
                type="text"
                id="addpat-petname"
                v-model="formData.pet_name"
                required
              />
  
              <label for="addpat-time">Time</label>
              <select id="addpat-time" v-model="formData.time" required>
                <option value="9am">9 AM</option>
                <option value="11am">11 AM</option>
                <option value="1pm">1 PM</option>
                <option value="3pm">3 PM</option>
                <option value="5pm">5 PM</option>
              </select>
  
              <label for="addpat-date">Date</label>
              <input type="date" id="addpat-date" v-model="formData.date" required />
            </div>
            <button type="submit" class="addpat-button">Add</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      formData: {
        name: "",
        phone: "",
        pet: "dog",
        breed: "",
        treatment: "rabies",
        petName: "",
        time: "9am",
        date: "" // Ensure this is a valid date format (YYYY-MM-DD)
      }
    };
  },
  methods: {
    async submitForm() {
      try {
        console.log("Form Data:", this.formData); // Debug data sent
        const response = await axios.post('/api/patient-records', this.formData);
        console.log("Patient record added:", response.data);
        
        // Success notification
        Swal.fire({
          title: 'Success!',
          text: 'Patient record added successfully!',
          icon: 'success',
          confirmButtonText: 'OK'
        });
      } catch (error) {
        console.error("Error adding the patient record:", error.response?.data || error);
        
        // Handling validation errors
        if (error.response?.status === 422) {
          const errors = error.response.data.errors || {};
          console.log("Validation Errors:", errors);

          Swal.fire({
            title: 'Error!',
            text: Object.values(errors).flat().join("\n"),
            icon: 'error',
            confirmButtonText: 'Try Again'
          });
        } else {
          // General error notification
          Swal.fire({
            title: 'Error!',
            text: 'An unexpected error occurred. Please try again.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }
    }
  }
};
</script>

  
<style scoped>
 /* Sidebar Menu */

 body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    display: flex;
    background-color: #f0f0f0;
}

.sidebar {
    width: 250px;
    background-color: #ffddd2;
    padding: 20px;
    position: fixed;
    height: 100%;
    top: 0;
    left: 0;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar-logo {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.sidebar-logo img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.sidebar-logo h1 {
    font-size: 24px;
    color: #333;
    font-weight: bold;
}

.menu-title {
    margin-bottom: 20px;
}

.menu-title h2 {
    font-size: 18px;
    color: #333;
}

.dashboard-container {
    display: flex;
    flex-direction: column;
}

.dashboard-item {
    margin: 10px 0;
}

.dashboard-item a {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.dashboard-icon {
    width: 24px;
    height: 24px;
    margin-right: 10px;
}

.dashboard-text {
    font-size: 16px;
    color: #333;
}

/* search */
.search-container {
    display: flex;
    align-items: center;
    background-color: #f0f0f0;
    margin-left: 20px;
}

.search-input {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
    border-color: #333;
}

.search-icon {
    width: 24px;
    height: 24px;
}

.dash-user-profile {
    display: flex;
    align-items: center;
}

.user-info {
  display: flex;
  align-items: center;
}

.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-details {
  margin-right: 10px;
}

.user-name {
  font-size: 18px;
  color: #333;
}

.user-role {
  font-size: 14px;
  color: #666;
}




/* Main Content */
.main-content {
    margin-left: 250px;
    padding: 20px;
    padding-bottom: 500px;
    background-color:#f0f0f0;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.dropdown-icon {
    width: 20px;
    height: 20px;
}

.logout-button {
    padding: 10px 20px;
    background-color: #ff4d4d;
    color: white;
    border: none;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
}

.logout-button.hidden {
    display: none;
}
.addpat-form-container {
    margin-top: 50px;
    width: 90%; /* Changed to 100% to allow full width usage for 2 columns */
    max-width: 800px; /* Set a max-width for better responsiveness */
    margin: 100px auto; 
    padding: 30px;
    background-color: white;
    border-radius: 30px; 
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1); 
    border: 1px solid black; 
}

.addpat-form {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two equal columns */
    gap: 30px; /* Space between the columns */
}

.addpat-form label {
    margin-bottom: 10px;
    font-size: 14px;
    font-weight: 500;
}

.addpat-form input,
.addpat-form select {
    padding: 10px;
    font-size: 14px;
    border-radius: 8px; /* Rounded input field */
    border: 1px solid #ccc;
    width: 100%; /* Ensures inputs take up full width in their column */
    box-sizing: border-box; /* Ensure padding is included in the width */
    margin-bottom: 20px;
}

.addpat-button {
    padding: 10px 20px;
    background-color: black; 
    color: white;
    border: none;
    border-radius: 20px; 
    font-size: 16px;
    cursor: pointer;
    text-align: center;
    display: block;
    margin: 0 auto; 
    width: 100px; 
    grid-column: span 2;
}
.addpat-button:hover {
    background-color: #333;
}

.addpat-name {
    text-align: center;
    align-self: stretch;
}

.action-icon {
    aspect-ratio: 1;
    object-fit: contain;
    object-position: center;
    width: 24px;
}

.form-group {
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #666;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.addpat-form select {
    padding: 10px;
    font-size: 14px;
    border-radius: 8px; 
    border: 1px solid #ccc; 
    margin-bottom: 20px;
    background-color: white; 
    width: 100%; 
}
</style>
  