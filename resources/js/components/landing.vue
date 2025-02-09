<template>
  <div>
    <header>
        <nav class="topnav">
          <div class="logo-container">
            <img src="img/logo.png" alt="PurfectPaw Logo" class="logo" />
          </div>
          <ul class="nav-links">
            <li><router-link to="/" class="active" >Home</router-link></li>
            <li><router-link to="/appointment">Appointment</router-link></li>
            <li><router-link to="/gallery">Gallery</router-link></li>
            <li><router-link to="/aboutus">About Us</router-link></li>
          </ul>
          <div class="profile">
            <img :src="profilePic" alt="Profile" class="profile-pic" />
            <a href="#" class="admin-link" id="profileLink">
              <p style="color: black;">{{ fullName }} <i class="fas fa-caret-down"></i></p>
            </a>
            <div class="dropdown-menu" id="dropdownMenu">
              <a href="#" @click.prevent="logout">Logout</a>
              <router-link to="/account">Account</router-link>
            </div>
          </div>
        </nav>
      </header>

    <!-- Main Welcome Section -->
    <section class="welcome-section">
      <div class="welcome-container">
        <img src="/img/lan1.png" alt="PurrfectPaw Illustration" class="welcome-image" />
        <div class="welcome-text">
          <h1>Welcome to PurrfectPaw</h1>
          <p>
            The easy way to book vet appointments online! Skip the long clinic
            waits and schedule vaccines, rabies shots, or check-ups in advance.
            Stress-free visits for you and your pet, every time.
          </p>
          <router-link to="/appointment" class="get-started-btn">Get Started</router-link>
        </div>
      </div>

      <!-- Guarantee Section -->
      <div class="guarantee-section">
        <h2>Purfect Pet Guarantee</h2>
        <div class="guarantee-cards">
          <div class="cardG">
            <img src="/img/lan2.png" alt="Scheduler Icon" />
            <h3>Stress-Free Vet Appointment Scheduler</h3>
          </div>
          <div class="cardG">
            <img src="/img/lan3.png" alt="Appointments Icon" />
            <h3>Book Appointments for Vaccines, Check-ups, and More!</h3>
          </div>
          <div class="cardG">
            <img src="/img/lan4.png" alt="Information Icon" />
            <h3>Stay Informed on Upcoming Appointments and Services</h3>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer>
      <div class="footer-container">
        <div class="footer-logo">
          <img src="/img/logo2.png" alt="PurrfectPaw Logo" />
          <p>PurrfectPaw</p>
        </div>
        <div class="footer-center">
          <p class="slogan">SIMPLE. EFFICIENT. ACCESSIBLE</p>
          <p class="description">
            We're a diverse and passionate team that takes ownership of your
            <br />
            design and empowers you to execute the roadmap. We stay light on
            <br />
            our feet and truly enjoy delivering great work.
          </p>
          <p>© 2024 PetalloDulis. All Rights Reserved.</p>
        </div>
        <div class="footer-contact">
          <p>Contact Us</p>
          <p><a href="mailto:info@adopt-a-pal.com">info@adopt-a-pal.com</a></p>
          <div class="social-icons">
            <a href="#"><i class="fas fa-envelope"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      firstName: "",
      lastName: "",
      profilePic: "/img/default-profile.jpg",
    };
  },
  computed: {
    fullName() {
      return `${this.firstName} ${this.lastName}`.trim() || 'User';
    }
  },
  created() {
    // Check if user data exists in localStorage
    const userData = localStorage.getItem("0");
    if (userData) {
      const user = JSON.parse(userData);
      this.firstName = user.first_name;
      this.lastName = user.last_name;
      this.profilePic = user.profile_picture || "/img/default-profile.jpg";
    }
    
    // Also fetch latest data from API
    this.getUserProfile();
  },
  methods: {
    async getUserProfile() {
      try {
        const response = await axios.get("/api/user");
        if (response.data) {
          this.firstName = response.data.first_name;
          this.lastName = response.data.last_name;
          this.profilePic = response.data.profile_picture || "/img/default-profile.jpg";
        }
      } catch (error) {
        console.error("Error fetching user profile:", error);
      }
    },
    async logout() {
      try {
        await axios.post("/logout");
        localStorage.removeItem("0"); // Clear stored user data
        this.$router.push("/login");
      } catch (error) {
        console.error("Error logging out:", error);
      }
    }
  }
};
</script>

<style scoped>
@import '/css/style.css';
</style>
