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
<div class="dashboard-item">
  <router-link to="/usermag">
    <img
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f4ba720e3eb36f88cbeeb39506756fb59283ea9643aba3db323aa6e8f900afe?placeholderIfAbsent=true&apiKey=02853cff8a504be0a91f61afb8cdbbcd"
      alt="Patients Record Icon"
      class="dashboard-icon"
    />
    <span class="dashboard-text">User Management</span>
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

    <!-- Main Content -->
    <section class="patient-overview">
        <div class="dash-card">
          <img src="img/ball.png" alt="Paw print icon" />
          <div class="dash-card-content">
            <h2>NUMBER OF PATIENTS</h2>
            <p>SURIGAO PET DOCTORS</p>
            <span>{{ appointmentCount }} Patients</span>
          </div>
        </div>
      </section>

      <section class="doctors-section">
<h2>Available doctors:</h2>
<div class="doctor-list">
  <!-- Dynamically display doctors with a button that redirects to a specific page -->
  <button 
    v-for="doctor in doctors" 
    :key="doctor.id" 
    class="doctor-card"
    @click="goToDoctorProfile(doctor.id)"
  >
    {{ doctor.name }}
  </button>
</div>
</section>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "SurDash",
  data() {
    return {
      doctors: [],
      appointmentCount: 0, // Holds the appointment count
    };
  },
  mounted() {
    this.fetchDoctors();
    this.fetchAppointmentCount();
  },
  methods: {
    goToDoctorProfile(doctorId) {
      this.$router.push(`/doctor/${doctorId}`);
    },
    fetchDoctors() {
      axios.get('/api/doctors')
        .then((response) => {
          this.doctors = response.data;
        })
        .catch((error) => {
          console.error("Error fetching doctors:", error);
        });
    },
    fetchAppointmentCount() {
  axios.get('/api/appointments/count')
    .then((response) => {
      console.log("API Response:", response.data); // Debugging
      if (response.data && response.data.count !== undefined) {
        this.appointmentCount = response.data.count;
      } else {
        console.error("Invalid response structure:", response.data);
        this.appointmentCount = 0; // Fallback value
      }
    })
    .catch((error) => {
      console.error("Error fetching appointment count:", error);
      this.appointmentCount = 0;
    });
},


  },
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

/* Patients Section */
.patient-overview {
  margin: 60px 0;
  display: flex;
  justify-content: center;
}

.dash-card {
  background-color: #DCC4E4;
  padding: 25px;
  border-radius: 15px;
  width: 300px;
  display: flex;
  align-items: center;
  gap: 20px; /* Add spacing between icon and content */
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
  transition: transform 0.2s ease; /* Smooth hover effect */
}

.dash-card:hover {
  transform: translateY(-3px); /* Slight lift on hover */
}

.dash-card img {
  width: 50px;
  height: 50px;
  padding: 10px;
  background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent background */
  border-radius: 12px;
}

.dash-card-content {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.dash-card-content h2 {
  font-size: 16px;
  font-weight: 600;
  color: #5B392C;
  margin: 0;
  margin-bottom: 4px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.dash-card-content p {
  font-size: 13px;
  color: #666;
  margin: 0;
  margin-bottom: 8px;
}

.dash-card-content span {
  font-size: 24px;
  font-weight: 700;
  color: #5B392C;
  background-color: rgba(255, 255, 255, 0.4);
  padding: 4px 12px;
  border-radius: 8px;
}

/* Doctors Section */
.doctors-section {
  margin-top: 40px;
}
.doctors-section h2 {
  margin-top: 100px;
  font-size: 24px;
  color: #5B392C;
  margin-bottom: 20px;
  margin-left: 50px;
}


.doctor-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.doctor-card {
  background-color: rgb(247, 217, 243);
  color: rgb(0, 0, 0);
  border: none;
  padding: 20px;
  font-size: 16px;
  border-radius: 10px;
  width: calc(50% - 10px); 
  text-align: center;
  cursor: pointer;
}
.doctor-card:hover {
  background-color: #FF7F50;
}

</style>

