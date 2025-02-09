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

        <!-- Clinic Management -->
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

        <!-- Appointments -->
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

      <!-- Main Content -->
      <div class="action-bar">
        <div class="add-doctor-btn">
          <router-link to="/adddoctors" class="btn-text">Add Doctor</router-link>
        </div>
        
      </div>
     
      <!-- Doctors List -->
      <div class="doctor-list">
        <h1 class="section-title">Doctors</h1>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Number</th>
              <th>Email</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="doctor in filteredDoctors" :key="doctor.id">
              <td>{{ doctor.name }}</td>
              <td>{{ doctor.number }}</td>
              <td>{{ doctor.email }}</td>
              <td>{{ doctor.address }}</td>
              <td>
             <button @click="editDoctor(doctor.id)" class="edit-button">Edit</button>
              <button @click="deleteDoctor(doctor.id)" class="delete-button">Delete</button>
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
      doctors: [],
      searchTerm: '',
    };
  },
  computed: {
    filteredDoctors() {
      return this.doctors.filter(doctor =>
        doctor.name.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    },
  },
  methods: {
  async fetchDoctors() {
    try {
      const response = await axios.get('/api/doctors');
      this.doctors = response.data;
    } catch (error) {
      console.error('Error fetching doctors:', error);
    }
  },
  async deleteDoctor(id) {
    try {
      if (confirm('Are you sure you want to delete this doctor?')) {
        await axios.delete(`/api/doctors/${id}`);
        this.fetchDoctors(); // Refresh the list after deletion
        alert('Doctor deleted successfully');
      }
    } catch (error) {
      console.error('Error deleting doctor:', error);
    }
  },
  editDoctor(id) {
    // Redirect to an edit page with the doctor's ID
    this.$router.push({ name: 'EditDoctor', params: { id } });
  },
},

  mounted() {
    this.fetchDoctors();
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

/* Doctors Section */
.action-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  margin-left: 100px;
}

.add-doctor-btn a {
  padding: 10px 20px;
  background-color: #4caf50;
  color: white;
  border-radius: 5px;
  text-decoration: none;
  font-size: 14px;
}

.add-doctor-btn a:hover {
  background-color: #45a049;
}

.section-title {
  font-size: 24px;
  color: #333;
  font-weight: bold;
  margin-left: 80px;
}

.doctors-table-doc {
    width: 90%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-left: 70px;
}

/* Table Header */
.table-header-doc {
    background-color: #f7f7f7;
    padding: 10px 0;
    font-weight: 600;
    color: #333;
}

.header-row-doc {
    display: flex;
    padding: 10px;
    border-bottom: 2px solid #e5e5e5;
}

/* Header Cells */
.header-cell-doc {
    flex: 1;
    padding: 10px 10px;
    text-align: left;
    font-size: 14px;
    color: #555;
}

/* Table Row */
.table-row-doc {
    display: flex;
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    transition: background-color 0.3s;
}

.table-row-doc:hover {
    background-color: #f9f9f9;
}

/* Row Content Cells */
.name-doc, .patients-doc, .action-doc {
    flex: 1;
    padding: 10px 15px;
    font-size: 14px;
    color: #333;
}

.name-doc {
    font-weight: 500;
}

.patients-doc {
    text-align: center;
}

.action-doc {
    text-align: center;
}

/* Delete Icon */
.delete-icon-doc {
    width: 20px;
    height: 20px;
    cursor: pointer;
    transition: transform 0.2s;
}

.delete-icon-doc:hover {
    transform: scale(1.1);
}
.btn-text {
    background-color:#624DE3;
    color: white;
    border: none;
    padding: 10px;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    border-radius: 10px;
    margin-left: 50px;
  }
  .doctor-list {
  padding: 15px;
  margin-left: 100px;
  background-color: #fafafa;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.doctor-list table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.doctor-list th,
.doctor-list td {
  padding: 12px 15px;
  border: 1px solid #e0e0e0;
  text-align: left;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.doctor-list td {
  padding: 12px 15px;
  border: 1px solid #e0e0e0;
  text-align: left;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin-right: 100px;
}


.doctor-list th {
  background-color: #f7f7f7;
  font-weight: 600;
  color: #333;
  padding-right: 50px;
}

.doctor-list tr {
  transition: background-color 0.3s;
}

.doctor-list tr:hover {
  background-color: #f1f1f1;
}

.doctor-list td {
  color: #555;
}

.doctor-list tr:last-child td {
  border-bottom: none;
}

.doctor-list th:first-child,
.doctor-list td:first-child {
  padding-left: 20px;
}

.doctor-list th:last-child,
.doctor-list td:last-child {
  padding-right: 50px;
}

.edit-button,
.delete-button {
  padding: 6px 15px;
  border: none;
  border-radius: 5px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s;
  
}
.edit-button {
  background-color: #4caf50;
  color: white;
  margin-bottom: 5px;
  margin-left: 50px
}

.edit-button:hover {
  background-color: #45a049;
}

.delete-button {
  background-color: #f44336;
  color: white;
  margin-left: 40px;
}

.delete-button:hover {
  background-color: #e53935;
}


</style>
  