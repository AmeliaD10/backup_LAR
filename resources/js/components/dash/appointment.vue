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
             <input 
               type="text" 
               v-model="searchQuery" 
               @input="filterAppointments"
               placeholder="Search by name, phone, treatment..." 
               class="search-input" 
             />
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
               <th>Action</th>
             </tr>
           </thead>
           <tbody>
             <tr v-for="appointment in displayedAppointments" :key="appointment.id">
               <td>{{ appointment.name }}</td>
               <td>{{ appointment.phone }}</td>
               <td>{{ appointment.date }} {{ appointment.time }}</td>
               <td>{{ appointment.treatment }}</td>
               <td>
                 <span :class="['status-badge', appointment.status.toLowerCase()]">
                   {{ appointment.status }}
                 </span>
               </td>
               <td>
                 <div class="action-buttons">
                   <button class="assign-btn" @click="toggleDoctorDropdown(appointment)">
                     Assign
                   </button>
                   <div v-if="appointment.showDropdown" class="doctor-dropdown">
                     <ul>
                       <li v-for="doctor in doctors" :key="doctor.id" @click="assignDoctor(appointment, doctor)">
                         {{ doctor.name }}
                       </li>
                     </ul>
                   </div>
                   <button class="cancel-btn" @click="cancelAppointment(appointment)">Cancel</button>
                 </div>
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
       appointments: [],
       displayedAppointments: [],
       doctors: [],
       searchQuery: '',
     };
   },
   mounted() {
     this.fetchAppointments();
     this.fetchDoctors();
   },
   methods: {
     async fetchAppointments() {
       try {
         const response = await axios.get('/api/appointments');
         this.appointments = response.data;
         this.displayedAppointments = response.data;
       } catch (error) {
         console.error('Error fetching appointments:', error);
       }
     },
 
     async fetchDoctors() {
       try {
         const response = await axios.get('/api/doctors');
         this.doctors = response.data;
         console.log('Doctors fetched:', this.doctors); // Debug log
       } catch (error) {
         console.error('Error fetching doctors:', error);
       }
     },
 
     toggleDoctorDropdown(appointment) {
       this.appointments.forEach(app => {
         if (app !== appointment) {
           this.$set(app, 'showDropdown', false);
         }
       });
       this.$set(appointment, 'showDropdown', !appointment.showDropdown);
     },
 
     async assignDoctor(appointment, doctor) {
       try {
         console.log('Assigning doctor:', { appointmentId: appointment.id, doctorId: doctor.id });
         
         const response = await axios.put(`/api/appointments/${appointment.id}`, {
           doctor_id: doctor.id,
           status: 'Assigned'
         });
 
         console.log('Assignment response:', response.data);
 
         if (response.data.success) {
           // Update the appointment locally
           appointment.doctor_id = doctor.id;
           appointment.status = 'Assigned';
           appointment.showDropdown = false;
 
           // Show success message
           alert('Doctor assigned successfully!');
           
           // Refresh the appointments list
           await this.fetchAppointments();
         } else {
           throw new Error(response.data.message);
         }
       } catch (error) {
         console.error('Assignment error:', error);
         alert('Failed to assign doctor: ' + (error.response?.data?.message || error.message));
       }
     },
 
     async cancelAppointment(appointment) {
       if (!confirm('Are you sure you want to cancel this appointment?')) {
         return;
       }
 
       try {
         const response = await axios.put(`/api/appointments/${appointment.id}`, {
           status: 'Cancelled'
         });
 
         if (response.data.success) {
           appointment.status = 'Cancelled';
           alert('Appointment cancelled successfully!');
           await this.fetchAppointments();
         } else {
           throw new Error(response.data.message);
         }
       } catch (error) {
         console.error('Cancel error:', error);
         alert('Failed to cancel appointment: ' + (error.response?.data?.message || error.message));
       }
     },
 
     filterAppointments() {
       if (!this.searchQuery) {
         this.displayedAppointments = this.appointments;
         return;
       }
 
       const query = this.searchQuery.toLowerCase();
       this.displayedAppointments = this.appointments.filter(appointment => {
         return (
           appointment.name?.toLowerCase().includes(query) ||
           appointment.phone?.toLowerCase().includes(query) ||
           appointment.treatment?.toLowerCase().includes(query) ||
           appointment.status?.toLowerCase().includes(query) ||
           appointment.date?.toLowerCase().includes(query)
         );
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
   margin: 20px auto;
   width: 90%;
   max-width: 1200px;
   background-color: white;
   border-radius: 16px;
   box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
   padding: 30px;
   }
   
   .container h1 {
   font-size: 28px;
   color: #2c3e50;
   font-weight: 600;
   margin-bottom: 25px;
   padding-bottom: 15px;
   border-bottom: 2px solid #f0f0f0;
   }
   
   .appointment-table {
   width: 100%;
   border-collapse: separate;
   border-spacing: 0;
   border-radius: 12px;
   overflow: hidden;
   background-color: #F8F9FF;
   box-shadow: 0 4px 20px rgba(98, 77, 227, 0.1);
   }
   
   .appointment-table th {
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
   
   .appointment-table td {
   padding: 20px 24px;
   font-size: 15px;
   color: #2D3748;
   background-color: #E8EAFF;
   border-bottom: 2px solid #FFFFFF;
   transition: all 0.2s ease;
   position: relative;
   }
   
   .appointment-table tr:nth-child(even) td {
   background-color: #F3F4FF;
   }
   
   .appointment-table tr:hover td {
   background-color: #FFFFFF !important;
   transform: translateY(-1px);
   box-shadow: 0 2px 4px rgba(98, 77, 227, 0.1);
   }
   
   .status-badge {
   display: inline-flex;
   align-items: center;
   justify-content: center;
   padding: 8px 16px;
   border-radius: 20px;
   font-size: 14px;
   font-weight: 500;
   text-align: center;
   min-width: 100px;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
   }
   
   .assigned {
   background-color: #E6F7E9;
   color: #34C759;
   border: 1px solid rgba(52, 199, 89, 0.1);
   }
   
   .pending {
   background-color: #FFF4DE;
   color: #FFA043;
   border: 1px solid rgba(255, 160, 67, 0.1);
   }
   
   .cancelled {
   background-color: #FFE6E6;
   color: #FF3B30;
   border: 1px solid rgba(255, 59, 48, 0.1);
   }
   
   .completed {
   background-color: #E6EDFE;
   color: #624DE3;
   border: 1px solid rgba(98, 77, 227, 0.1);
   }
   
   .assign-btn, .cancel-btn {
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
   margin-right: 8px;
   }
   
   .assign-btn {
   position: relative;
   background-color: #624DE3;
   color: white;
   z-index: 999;
   }
   
   .assign-btn:hover {
   background-color: #5A45DD;
   transform: translateY(-1px);
   box-shadow: 0 4px 6px rgba(98, 77, 227, 0.2);
   }
   
   .cancel-btn {
   background-color: #FF3B30;
   color: white;
   }
   
   .cancel-btn:hover {
   background-color: #E6352B;
   transform: translateY(-1px);
   box-shadow: 0 4px 6px rgba(255, 59, 48, 0.2);
   }
   
   .doctor-dropdown {
   position: absolute;
   top: calc(100% + 5px); /* Position below the button with a small gap */
   right: 0; /* Align to the right instead of left */
   background-color: #FFFFFF;
   border-radius: 12px;
   border: 1px solid rgba(98, 77, 227, 0.15);
   box-shadow: 0 8px 24px rgba(98, 77, 227, 0.15);
   padding: 8px 0;
   z-index: 1000;
   min-width: 220px;
   animation: dropdownFade 0.2s ease;
   /* Ensure the dropdown doesn't go off-screen on the right */
   max-width: 300px;
   /* Add max-height to prevent very long dropdowns */
   max-height: 400px;
   overflow-y: auto;
   }
   
   @keyframes dropdownFade {
   from {
     opacity: 0;
     transform: translateY(-10px);
   }
   to {
     opacity: 1;
     transform: translateY(0);
   }
   }
   
   .doctor-dropdown::before {
   content: '';
   position: absolute;
   top: -6px;
   right: 20px; /* Align arrow to the right */
   left: auto; /* Remove left positioning */
   width: 12px;
   height: 12px;
   background-color: #FFFFFF;
   border-left: 1px solid rgba(98, 77, 227, 0.15);
   border-top: 1px solid rgba(98, 77, 227, 0.15);
   transform: rotate(45deg);
   }
   
   .doctor-dropdown ul {
   list-style: none;
   padding: 0;
   margin: 0;
   max-height: 300px;
   overflow-y: auto;
   }
   
   .doctor-dropdown ul::-webkit-scrollbar {
   width: 8px;
   }
   
   .doctor-dropdown ul::-webkit-scrollbar-track {
   background: #F0F3FF;
   border-radius: 4px;
   }
   
   .doctor-dropdown ul::-webkit-scrollbar-thumb {
   background: #624DE3;
   border-radius: 4px;
   }
   
   .doctor-dropdown li {
   padding: 12px 16px;
   cursor: pointer;
   color: #2D3748;
   transition: all 0.2s ease;
   font-size: 14px;
   display: flex;
   align-items: center;
   position: relative;
   }
   
   .doctor-dropdown li:not(:last-child) {
   border-bottom: 1px solid rgba(98, 77, 227, 0.08);
   }
   
   .doctor-dropdown li:hover {
   background-color: #F0F3FF;
   color: #624DE3;
   padding-left: 20px;
   }
   
   .doctor-dropdown li::before {
   content: '';
   position: absolute;
   left: 0;
   width: 3px;
   height: 0;
   background-color: #624DE3;
   transition: height 0.2s ease;
   }
   
   .doctor-dropdown li:hover::before {
   height: 100%;
   }
   
   /* Add position relative to td containing the dropdown */
   .appointment-table td {
   position: relative;
   }
   
   /* Ensure the dropdown appears above other elements */
   .appointment-table tr:hover {
   z-index: 10;
   position: relative;
   }
 
   /* Adjust the action buttons container */
   .action-buttons {
     display: flex;
     gap: 8px;
     position: relative;
   }
 
   /* Updated dropdown positioning */
   .doctor-dropdown {
     position: absolute;
     top: calc(100% + 5px); /* Position below the button with a small gap */
     right: 0; /* Align to the right instead of left */
     background-color: #FFFFFF;
     border-radius: 12px;
     border: 1px solid rgba(98, 77, 227, 0.15);
     box-shadow: 0 8px 24px rgba(98, 77, 227, 0.15);
     padding: 8px 0;
     z-index: 1000;
     min-width: 220px;
     animation: dropdownFade 0.2s ease;
     /* Ensure the dropdown doesn't go off-screen on the right */
     max-width: 300px;
     /* Add max-height to prevent very long dropdowns */
     max-height: 400px;
     overflow-y: auto;
   }
 
   /* Adjust the arrow position for right alignment */
   .doctor-dropdown::before {
     content: '';
     position: absolute;
     top: -6px;
     right: 20px; /* Align arrow to the right */
     left: auto; /* Remove left positioning */
     width: 12px;
     height: 12px;
     background-color: #FFFFFF;
     border-left: 1px solid rgba(98, 77, 227, 0.15);
     border-top: 1px solid rgba(98, 77, 227, 0.15);
     transform: rotate(45deg);
   }
 
   /* Ensure the dropdown list is scrollable if too long */
   .doctor-dropdown ul {
     list-style: none;
     padding: 0;
     margin: 0;
     max-height: 300px;
     overflow-y: auto;
   }
 
   /* Add some spacing in the table cell for the dropdown */
   .appointment-table td:last-child {
     min-width: 200px; /* Ensure enough space for buttons */
     padding-right: 30px; /* Add some extra padding on the right */
   }
 
   /* Make sure the buttons stay visible */
   .assign-btn, .cancel-btn {
     position: relative;
     z-index: 998; /* Slightly lower than dropdown */
   }
 
   /* When dropdown is open, ensure it's above other elements */
   .doctor-dropdown {
     z-index: 1000;
   }
 
   /* Update table row z-index behavior */
   .appointment-table tr {
     position: relative;
     z-index: 1;
   }
 
   /* When row has active dropdown, bring it to front */
   .appointment-table tr:has(.doctor-dropdown) {
     z-index: 1000;
   }
 
   /* Action buttons container */
   .action-buttons {
     display: flex;
     gap: 8px;
     position: relative;
     z-index: 2; /* Base z-index for the container */
   }
 
   /* Update dropdown to ensure it's always on top */
   .doctor-dropdown {
     position: absolute;
     top: 100%;
     left: 0;
     background-color: #FFFFFF;
     border-radius: 8px;
     border: 1px solid rgba(98, 77, 227, 0.15);
     box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
     padding: 8px 0;
     z-index: 9999; /* Much higher z-index to ensure it's above everything */
     min-width: 200px;
     max-width: 300px;
     max-height: 300px;
     overflow-y: auto;
   }
 
   /* Ensure the table cell containing the dropdown has the correct stacking context */
   .appointment-table td:last-child {
     position: relative;
     z-index: 2;
   }
 </style>
 
 