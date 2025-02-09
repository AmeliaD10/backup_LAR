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
  
       <!-- Appointments Section -->
       <div class="container">
        <h1>Surigao Pet Doctors</h1>
        <table class="appointment-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Appointment Date & Time</th>
              <th>Treatment</th>
              <th>Status</th>
              <th>Clinic ID</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="appointment in appointments" :key="appointment.id">
              <td>{{ appointment.name }}</td>
              <td>{{ appointment.phone }}</td>
              <td>{{ appointment.date }} {{ appointment.time }}</td>
              <td>{{ appointment.treatment }}</td>
              <td><span class="status">{{ appointment.status }}</span></td>
              <td>{{ appointment.clinic_id }}</td>
              
              <td>
                <button class="assign-btn" @click="toggleDoctorDropdown(appointment)">
                  Assign
                </button>
                <div v-if="appointment.showDoctorDropdown" class="doctor-dropdown">
                  <ul>
                    <li v-for="doctor in doctors" :key="doctor.id" @click="assignDoctor(appointment, doctor)">
                      {{ doctor.name }}
                    </li>
                  </ul>
                </div>
                <button class="cancel-btn" @click="cancelAppointment(appointment)">Cancel</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      appointments: [], // This will hold the fetched appointments
      doctors: [] // This will hold the fetched list of doctors
    };
  },
  mounted() {
    // Fetch appointments from the API when the component is mounted
    axios.get('/api/appointments')
      .then(response => {
        this.appointments = response.data; // Set the appointments data
      })
      .catch(error => {
        console.error('There was an error fetching appointments:', error);
      });

    // Fetch doctors from the API
    axios.get('/api/doctors')
      .then(response => {
        this.doctors = response.data; // Set the doctors data
      })
      .catch(error => {
        console.error('There was an error fetching doctors:', error);
      });
  },
  methods: {
    toggleDoctorDropdown(appointment) {
      // Toggle the visibility of the doctor dropdown for the selected appointment
      this.appointments.forEach(app => {
        if (app.id !== appointment.id) {
          app.showDoctorDropdown = false; // Close other dropdowns
        }
      });
      appointment.showDoctorDropdown = !appointment.showDoctorDropdown;
    },
    assignDoctor(appointment, doctor) {
      // Assign the selected doctor to the appointment
      appointment.doctor = doctor.name; // Using doctor name here
      appointment.showDoctorDropdown = false; // Close the dropdown after assigning
    },
    cancelAppointment(appointment) {
      // Change the appointment status to 'Cancelled'
      appointment.status = 'Cancelled';
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
  background-color: #e74c3c;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  }
  
  .logout-button.hidden {
  display: none;
  }
  
  .container {
  margin: 50px auto;
  max-width: 800px;
  }
  
  .appointment-table {
  width: 100%;
  border-collapse: collapse;
  }
  
  .appointment-table th, .appointment-table td {
  padding: 20px;
  text-align: left;
  border: 1px solid #ddd;
  padding-left: 30px;
  }
  
  .appointment-table th {
  background-color: #f4f4f4;
  }
  
  .status {
  display: inline-block;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background-color: green; /* Example status color */
  }
  
  .assign-btn {
  background-color: #3498db;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  }
  
  .assign-btn:hover {
  background-color: #2980b9;
  }
  
  .doctor-dropdown {
  display: none;
  position: absolute;
  background-color: white;
  border: 1px solid #ddd;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  padding: 10px;
  }
  
  .doctor-dropdown ul {
  list-style: none;
  padding: 0;
  }
  
  .doctor-dropdown li {
  padding: 5px 0;
  cursor: pointer;
  }
  
  .doctor-dropdown li:hover {
  background-color: #f1f1f1;
  }
  
  .cancel-btn {
  background-color: #e74c3c;
  color: white;
  padding: 5px 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  }
  
  .cancel-btn:hover {
  background-color: #c0392b;
  }
</style>