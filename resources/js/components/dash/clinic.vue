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
          <div class="gifcontainer">
        <div class="signup-box">
          <h2>Add Clinic</h2>
          <div class="profile-picture-container">
            <img
              id="profile-picture-preview"
              :src="profilePicture"
              alt="Logo"
              class="profile-picture"
            />
            <input type="file" @change="previewProfilePicture" accept="image/*" required />
          </div>
          <form @submit.prevent="handleSignup">
            <div class="signup-group">
              <label for="fullName">Clinic Name</label>
              <input type="text" v-model="fullName" placeholder="Surigao Doc" required />
            </div>
            <div class="signup-group">
              <label for="email">Address</label>
              <input type="text" v-model="address" placeholder="Roxas Street,Brgy Washington" required />
            </div>
            <div class="signup-group">
              <label for="password">Tell Number</label>
              <input type="number" v-model="tellnum" placeholder="0876589" required />
            </div>

            <div class="signup-group">
              <label for="password">Email</label>
              <input type="email" v-model="email" placeholder="Email" required />
            </div>

            <div class="signup-group">
              <label for="password">Contact Number</label>
              <input type="number" v-model="contactNumber" placeholder="ContactNumber" required />
            </div>

            <button type="submit" class="sign-in-btn">Add Clinic</button>
          </form>
        </div>
      </div>
        </div>
      </div>
    </template>
    
    <script>
    import axios from 'axios';
    import Swal from "sweetalert2";
    
    export default {
      name: "SurDash",
      data() {
        return {
          fullName: '',
          email: '',
          address: '',
          contactNumber: '',
          profilePicture: null,
          logoFile: null,
        };
      },
      methods: {
    previewProfilePicture(event) {
      const file = event.target.files[0];
      if (file) {
        this.logoFile = file;
        this.profilePicture = URL.createObjectURL(file);
      }
    },
    async handleSignup() {
      const formData = new FormData();
      formData.append('name', this.fullName);
      formData.append('email', this.email);
      formData.append('address', this.address);
      formData.append('contact_number', this.contactNumber);
      if (this.logoFile) {
        formData.append('logo', this.logoFile);
      }

      try {
        const response = await axios.post('/api/clinics', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        // Use SweetAlert2 for success
        Swal.fire({
          title: 'Success!',
          text: response.data.message,  // Adjust the message from your API response
          icon: 'success',
        });

        // Reset form after successful submission
        this.fullName = '';
        this.email = '';
        this.address = '';
        this.contactNumber = '';
        this.logoFile = null;
        this.profilePicture = null;
      } catch (error) {
        console.error(error.response.data);

        // Use SweetAlert2 for error
        Swal.fire({
          title: 'Error!',
          text: 'Failed to add clinic. Please check your inputs.',
          icon: 'error',
        });
      }
    },
  },
    }
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

  .signup-box {
      background-color: white;
      padding: 70px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: auto;
      text-align: center;
      margin-top: 100px;
      margin-bottom: auto;
      height: 400px;
      padding-bottom: 250px;
      gap: 50px;
  }

  .signup-box h2{
      margin-bottom: 20px;
      margin-top: 0px;
  }


  .signup-group {
      margin-bottom: 15px;
      text-align: left;
      margin-left: 5px;
      margin-right: 20px;
  }

  label {
      display: block;
      font-size: 14px;
      margin-bottom: 5px;
  }

  input {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
  }

  .signup-btn {
      width: 40%;
      background-color: black;
      color: white;
      padding: 15px;
      border-radius: 25px;
      border: none;
      cursor: pointer;
      margin-top: 20px;
  }

  .signup-link {
      color: red;
      text-decoration: none;

  }


  </style>
    
    