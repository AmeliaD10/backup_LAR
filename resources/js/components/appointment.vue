<template>
  <div>
    <header>
      <nav class="topnav">
        <div class="logo-container">
          <img src="img/logo.png" alt="PurfectPaw Logo" class="logo" />
        </div>
        <ul class="nav-links">
          <li><router-link to="/" >Home</router-link></li>
          <li><router-link to="/appointment" class="active">Appointment</router-link></li>
          <li><router-link to="/gallery">Gallery</router-link></li>
          <li><router-link to="/aboutus">About Us</router-link></li>
        </ul>

        <div class="auth-section">
          <template v-if="isLoggedIn">
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
          </template>
          <template v-else>
            <router-link to="/login" class="auth-btn login-btn">Login</router-link>
            <router-link to="/signup" class="auth-btn signup-btn">Sign Up</router-link>
          </template>
        </div>
      </nav>
    </header>

    <section class="main-section">
      <div class="cards-container">
        <div class="card" v-for="clinic in clinics" :key="clinic.id">
          <router-link :to="'/appointment/' + clinic.id">
            <img :src="clinic.logo" :alt="clinic.name + ' Logo'" class="sur" />
            <h3>{{ clinic.name }}</h3>
          </router-link>
        </div>
      </div>
    </section>

    <footer>
      <div class="footer-container">
        <div class="footer-logo">
          <img src="img/logo2.png" alt="PurrfectPaw Logo" />
          <p>PurrfectPaw</p>
        </div>
        <div class="footer-center">
          <p class="slogan">SIMPLE. EFFICIENT. ACCESSIBLE</p>
          <p class="description">
            We're a diverse and passionate team that takes ownership of your design and empowers
            <br />
            you to execute the roadmap. We stay light on our feet and truly enjoy delivering great work.
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
export default {
  data() {
    return {
      clinics: [],
      firstName: "",
      lastName: "",
      profilePic: "/img/default-profile.jpg",
      isLoggedIn: false,
    };
  },
  computed: {
    fullName() {
      return `${this.firstName} ${this.lastName}`.trim() || 'User';
    }
  },
  created() {
    this.fetchClinics();
    const userData = localStorage.getItem("0");

    if (userData) {
      const user = JSON.parse(userData);
      this.firstName = user.first_name;
      this.lastName = user.last_name;
      this.profilePic = user.profile_picture || "/img/default-profile.jpg";
      this.isLoggedIn = true;
    }
    
    this.getUserProfile();
  },
  methods: {
    fetchClinics() {
      axios.get('/api/clinics')
        .then(response => {
          this.clinics = response.data;
        })
        .catch(error => {
          console.error("Error fetching clinics:", error);
        });
    },
    async getUserProfile() {
      try {
        const response = await axios.get("/api/user");
        if (response.data) {
          this.firstName = response.data.first_name;
          this.lastName = response.data.last_name;
          this.profilePic = response.data.profile_picture || "/img/default-profile.jpg";
          this.isLoggedIn = true;
        }
      } catch (error) {
        console.error("Error fetching user profile:", error);
      }
    },
    async logout() {
      try {
        await axios.post("/logout");
        localStorage.removeItem("0");
        this.isLoggedIn = false;
        this.$router.push("/login");
      } catch (error) {
        console.error("Error logging out:", error);
      }
    }
  }
};
</script>

<style scoped>
.auth-section {
  display: flex;
  align-items: center;
}

.auth-btn {
  padding: 8px 15px;
  border-radius: 5px;
  text-decoration: none;
  color: white;
  margin-left: 10px;
}

.login-btn,
.signup-btn {
  background-color: #e07a9d;
  color: white;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border: none;
  cursor: pointer;
}

.signup-btn {
  background-color: #62c178;
  margin-top: 0px;
}

.login-btn:hover {
  background-color: #d15595;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.signup-btn:hover {
  background-color: #28a745;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}
</style>
