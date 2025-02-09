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
  
       
    <!-- Add Doctor Form -->
    <h1 class="section-title">Add Doctor</h1>
    <div class="doctor-form-container">
      <form @submit.prevent="addDoctor" class="doctor-form">
        <label for="doctor-name">Full Name</label>
        <input v-model="doctorName" type="text" id="doctor-name" required />

        <label for="doctor-number">Number</label>
        <input v-model="doctorNumber" type="text" id="doctor-number" required />

        <label for="doctor-email">Email Address</label>
        <input v-model="doctorEmail" type="email" id="doctor-email" required />

        <label for="doctor-address">Address</label>
        <input v-model="doctorAddress" type="text" id="doctor-address" required />

        <button type="submit" class="add-doctor-button">Add</button>
      </form>
    </div>
  </div>
</div>
</template>

<script>

import Swal from 'sweetalert2';

export default {
  data() {
    return {
      doctorName: '',
      doctorNumber: '',
      doctorEmail: '',
      doctorAddress: '',
    };
  },
  methods: {
    async addDoctor() {
      try {
        const response = await axios.post('/api/doctors', {
          name: this.doctorName,
          number: this.doctorNumber,
          email: this.doctorEmail,
          address: this.doctorAddress,
        });

        console.log('Doctor added:', response.data);
        
        // Using SweetAlert for success message
        Swal.fire({
          title: 'Success!',
          text: 'Doctor added successfully!',
          icon: 'success',
          confirmButtonText: 'OK',
        });
      } catch (error) {
        console.error('Error adding doctor:', error.response.data);
        
        // Using SweetAlert for error message
        Swal.fire({
          title: 'Error!',
          text: 'Failed to add doctor. Please try again.',
          icon: 'error',
          confirmButtonText: 'OK',
        });
      }
    }
  }
};
</script>
  
<style scoped>

.main-content {
    margin-left: 250px;
    padding: 20px;
    padding-bottom: 500px;
    background-color:#f0f0f0;
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


.dropdown-icon {
    width: 20px;
    height: 20px;
}


.logout-button {
  background-color: #f44336;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: none;
}

.logout-button:hover {
  background-color: #e53935;
}

/* Doctor Form */
.doctor-form-container {
  margin-top: 20px;
}

.doctor-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.doctor-form label {
  font-size: 14px;
  color: #333;
}

.doctor-form input {
  padding: 8px 12px;
  border-radius: 5px;
  border: 1px solid #ccc;
  outline: none;
  font-size: 14px;
}

.add-doctor-button {
  background-color: #4caf50;
  color: white;
  padding: 10px 15px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}

.add-doctor-button:hover {
  background-color: #45a049;
}

</style>
  