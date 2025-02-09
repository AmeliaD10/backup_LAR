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
  
        <!-- Patients Section -->
        <router-link to="/addpat" class="btn-text">Add Patient Record</router-link>
        <div class="patient-records">
          
    <h1 class="section-title">Patient Records</h1>
    <div v-if="loading" class="loading-spinner">Loading...</div>
    <div v-else>
      <table class="patient-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Pet</th>
            <th>Breed</th>
            <th>Treatment</th>
            <th>Pet Name</th>
            <th>Time</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="patient in patients" :key="patient.id">
            <td>{{ patient.name }}</td>
            <td>{{ patient.phone }}</td>
            <td>{{ patient.pet }}</td>
            <td>{{ patient.breed }}</td>
            <td>{{ patient.treatment }}</td>
            <td>{{ patient.pet_name }}</td>
            <td>{{ patient.time }}</td>
            <td>{{ patient.date }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  </div>
</template>
  
<script>
import axios from 'axios';

export default {
  data() {
    return {
      patients: [],
      loading: true,
    };
  },
  mounted() {
    this.fetchPatientRecords();
  },
  methods: {
    async fetchPatientRecords() {
      try {
        const response = await axios.get('/api/patient-records');
        this.patients = response.data;
      } catch (error) {
        console.error("Error fetching patient records:", error);
      } finally {
        this.loading = false;
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

.dashboard-ptext {
    font-size: 16px;
    color: #333;
    margin-left: 50px;
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
    padding-bottom: 550px;
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

/* Patients section */
.action-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.section-title {
  font-size: 24px;
  font-weight: bold;
  margin-left: 50px;
}

.btn-text {
    background-color:#4caf50;
    color: white;
    border: none;
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;
    border-radius: 10px;
    margin-left: 50px;
    margin-bottom: 50px;
  }

  .patients-table-pet {
    width: 95%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-left: 50px;
}

.table-content-pet {
    display: flex;
    flex-direction: column;
}

.table-header-pet {
    display: flex;
    background-color: #f7f7f7;
    padding: 10px 0;
    font-weight: 600;
    color: #333;
}

.header-row-pet, .table-row-pet {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.header-cell-pet, .cell-content-pet {
    flex: 1;
    padding: 10px 15px;
    text-align: left;
    font-size: 14px;
    color: #555;
}

.table-row-pet {
    background-color: #ffffff;
    border-bottom: 1px solid #e5e5e5;
    transition: background-color 0.3s;
}

.table-row-pet:hover {
    background-color: #f9f9f9;
}

.bold-text-pet {
    font-weight: bold;
}

.table-row-pet:nth-child(even) {
    background-color: #f1f1f1;
}
.patient-records {
  padding: 15px;
  margin-left: 50px;
  background-color: #fafafa;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  margin-top: 50px;
}

.patient-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.patient-table th,
.patient-table td {
  padding: 12px 15px;
  border: 1px solid #e0e0e0;
  text-align: left;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.patient-table th {
  background-color: #f7f7f7;
  font-weight: 600;
  color: #333;
}

.patient-table tr {
  transition: background-color 0.3s;
}

.patient-table tr:hover {
  background-color: #f1f1f1;
}

.patient-table td {
  color: #555;
}

.patient-table tr:last-child td {
  border-bottom: none;
}

.patient-table th:first-child,
.patient-table td:first-child {
  padding-left: 20px;
}

.patient-table th:last-child,
.patient-table td:last-child {
  padding-right: 20px;
}

</style>
  