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
            <input type="text" v-model="searchQuery" @input="filterDoctors" placeholder="Search" class="search-input" />
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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through doctors -->
              <template v-for="doctor in displayedDoctors">
                <!-- Doctor row -->
                <tr :key="doctor.id">
                  <td>{{ doctor.name }}</td>
                  <td>{{ doctor.number }}</td>
                  <td>{{ doctor.email }}</td>
                  <td>{{ doctor.address }}</td>
                  <td class="action-buttons">
                    <div class="button-group">
                      <button @click="editDoctor(doctor.id)" class="action-btn edit">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                      <button @click="deleteDoctor(doctor.id)" class="action-btn delete">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                      <button @click="togglePatients(doctor)" class="action-btn view">
                        <i :class="doctor.showPatients ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
                        {{ doctor.showPatients ? 'Hide Patients' : 'View Patients' }}
                      </button>
                    </div>
                  </td>
                </tr>
                <!-- Patients row -->
                <tr v-if="doctor.showPatients" :key="`patients-${doctor.id}`" class="patients-row">
                  <td colspan="5">
                    <div class="assigned-patients">
                      <div class="patients-header">
                        <h3>Assigned Patients</h3>
                        <span class="patient-count">{{ doctor.appointments.length }} patients</span>
                      </div>
                      <div class="patients-table-wrapper">
                        <table class="patients-table">
                          <thead>
                            <tr>
                              <th>Patient Name</th>
                              <th>Appointment Date</th>
                              <th>Treatment</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="appointment in doctor.appointments" :key="appointment.id">
                              <td>{{ appointment.name }}</td>
                              <td>{{ appointment.date }} {{ appointment.time }}</td>
                              <td>{{ appointment.treatment }}</td>
                              <td>
                                <span :class="['status-badge', appointment.status.toLowerCase()]">
                                  {{ appointment.status }}
                                </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </td>
                </tr>
              </template>
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
        displayedDoctors: [],
        searchQuery: '',
      };
    },
    
    methods: {
      async fetchDoctors() {
        try {
          const response = await axios.get('/api/doctors');
          // Initialize each doctor with appointments array and showPatients flag
          this.doctors = response.data.map(doctor => ({
            ...doctor,
            appointments: [],
            showPatients: false
          }));
          this.displayedDoctors = [...this.doctors]; // Create a new array reference
          console.log('Doctors fetched:', this.displayedDoctors); // Debug log
        } catch (error) {
          console.error('Error fetching doctors:', error);
        }
      },
  
      filterDoctors() {
        if (!this.searchQuery) {
          this.displayedDoctors = this.doctors;
          return;
        }
  
        const query = this.searchQuery.toLowerCase();
        this.displayedDoctors = this.doctors.filter(doctor => {
          return (
            doctor.name?.toLowerCase().includes(query) ||
            doctor.email?.toLowerCase().includes(query) ||
            doctor.number?.toLowerCase().includes(query) ||
            doctor.address?.toLowerCase().includes(query)
          );
        });
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
  
      async togglePatients(doctor) {
        try {
          doctor.showPatients = !doctor.showPatients;
          
          if (doctor.showPatients) {
            console.log('Fetching appointments for doctor:', doctor.id);
            const response = await axios.get(`/api/doctors/${doctor.id}/appointments`);
            console.log('Appointments response:', response.data);
            
            if (Array.isArray(response.data)) {
              doctor.appointments = response.data;
            } else {
              doctor.appointments = [];
              console.warn('No appointments found for doctor');
            }
          }
        } catch (error) {
          console.error('Error fetching appointments:', error);
          doctor.appointments = [];
          doctor.showPatients = false;
          alert('Failed to fetch appointments');
        }
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
    padding-bottom: 50px;
    background-color: #f0f0f0;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center; /* Center content horizontally */
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
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    display: flex;
    justify-content: flex-end; /* Align to the right */
    padding: 0;
  }
  
  .add-doctor-btn {
    margin: 0; /* Remove any existing margins */
  }
  
  .section-title {
    font-size: 28px;
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
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
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin: 20px auto;
    padding: 30px;
    width: 90%;
    max-width: 1200px;
  }
  
  .doctor-list table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
    background-color: #F8F9FF;
    box-shadow: 0 4px 20px rgba(98, 77, 227, 0.1);
  }
  
  .doctor-list th {
    background-color: #624DE3;
    color: white;
    font-weight: 600;
    padding: 20px 24px;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 0.5px;
    border: none;
    text-align: left;
  }
  
  .doctor-list td {
    padding: 20px 24px;
    font-size: 15px;
    color: #2D3748;
    background-color: #E8EAFF;
    border-bottom: 2px solid #FFFFFF;
    transition: all 0.2s ease;
    position: relative;
  }
  
  .doctor-list tr:nth-child(even) td {
    background-color: #F3F4FF;
  }
  
  .doctor-list tr:hover td {
    background-color: #FFFFFF !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(98, 77, 227, 0.1);
  }
  
  .doctor-list td:first-child {
    font-weight: 500;
    color: #1a202c;
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
  
  .view-patients-button {
    background-color: #2196F3;
    color: white;
    padding: 6px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
  }
  
  .view-patients-button:hover {
    background-color: #1976D2;
  }
  
  .patients-row {
    background-color: #f8fafc;
  }
  
  .assigned-patients {
    padding: 25px;
    background-color: #FAFBFF;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    margin: 15px;
  }
  
  .patients-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #E6E8F7;
  }
  
  .patients-header h3 {
    color: #2c3e50;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
  }
  
  .patient-count {
    background-color: #e0f2fe;
    color: #0284c7;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(2, 132, 199, 0.1);
  }
  
  .patients-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    margin-top: 10px;
  }
  
  .patients-table th {
    background-color: #5A45DD;
    color: white;
    font-weight: 600;
    padding: 14px 20px;
    text-align: left;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
  }
  
  .patients-table tr:nth-child(even) td {
    background-color: #F8F9FF;
  }
  
  .patients-table tr:nth-child(odd) td {
    background-color: white;
  }
  
  .patients-table td {
    padding: 16px 20px;
    background-color: #E8EAFF;
    border-bottom: 2px solid #FFFFFF;
    color: #2D3748;
    font-size: 14px;
  }
  
  .patients-table tr:hover td {
    background-color: #FFFFFF !important;
    transform: translateY(-1px);
  }
  
  /* Status badge styles */
  .status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    min-width: 100px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }
  
  .pending {
    background-color: #FFF4DE;
    color: #FFA043;
  }
  
  .completed {
    background-color: #E6F7E9;
    color: #34C759;
  }
  
  .cancelled {
    background-color: #FFE6E6;
    color: #FF3B30;
  }
  
  .ongoing {
    background-color: #E6EDFE;
    color: #624DE3;
  }
  
  /* Enhanced button styling */
  .button-group {
    display: flex;
    gap: 10px;
    justify-content: flex-start;
    flex-wrap: wrap;
  }
  
  .action-btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    gap: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }
  
  .action-btn i {
    font-size: 16px;
  }
  
  .action-btn.edit {
    background-color: #624DE3;
    color: white;
  }
  
  .action-btn.edit:hover {
    background-color: #5A45DD;
    transform: translateY(-1px);
  }
  
  .action-btn.delete {
    background-color: #FF3B30;
    color: white;
  }
  
  .action-btn.delete:hover {
    background-color: #E6352B;
    transform: translateY(-1px);
  }
  
  .action-btn.view {
    background-color: #34C759;
    color: white;
  }
  
  .action-btn.view:hover {
    background-color: #2FB350;
    transform: translateY(-1px);
  }
  
  /* Add doctor button enhancement */
  .add-doctor-btn {
    margin-bottom: 20px;
  }
  
  .btn-text {
    background-color: #3b82f6;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
  }
  
  .btn-text:hover {
    background-color: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
  }
  
  /* ... rest of existing styles ... */
  </style>
    
    