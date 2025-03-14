<template>
  <div>
    <header>
      <nav class="topnav">
        <div class="logo-container">
          <img src="img/logo.png" alt="PurfectPaw Logo" class="logo" />
        </div>
        <ul class="nav-links">
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/appointment">Appointment</router-link></li>
          <li><router-link to="/gallery">Gallery</router-link></li>
          <li><router-link to="/aboutus">About Us</router-link></li>
        </ul>

        <!-- Conditional Rendering for Login/Signup or Profile -->
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

    <!-- Main Welcome Section -->
    <main>
      <div class="form-container">
        <form @submit.prevent="handleSubmit">
          <h2>Appointment Formmm</h2>
          <div class="form-content">
            <div class="form-column">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="formData.name" placeholder="Full Name" required />
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" v-model="formData.phone" placeholder="09*********" required />
              </div>
              <div class="form-group">
                <label for="pet">Pet</label>
                <select v-model="formData.pet" required>
                  <option value="dog">Dog</option>
                  <option value="cat">Cat</option>
                  <option value="rabbit">Rabbit</option>
                </select>
              </div>
              <div class="form-group">
                <label for="breed">Breed</label>
                <input type="text" v-model="formData.breed" placeholder="Ex. Husky" required />
              </div>
            </div>

            <div class="form-column">
              <div class="form-group">
                <label for="treatment">Treatment</label>
                <select v-model="formData.treatment" required>
                  <option value="rabies">Rabies</option>
                  <option value="vaccination">Vaccination</option>
                  <option value="checkup">Checkup</option>
                </select>
              </div>
              <div class="form-group">
                <label for="petName">Pet's Name</label>
                <input type="text" v-model="formData.petName" placeholder="Koko" required />
              </div>
              <div class="form-group">
                <label for="time">Time</label>
                <select v-model="formData.time" required>
                  <option value="9am">9 AM</option>
                  <option value="11am">11 AM</option>
                  <option value="1pm">1 PM</option>
                  <option value="3pm">3 PM</option>
                  <option value="5pm">5 PM</option>
                </select>
              </div>
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" v-model="formData.date" required />
              </div>
              <div class="form-buttons">
                <button type="button" @click="cancelForm">Cancel</button>
                <button type="submit">Confirm</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </main>

    <!-- Footer -->
    <footer>
      <div class="footer-container">
        <div class="footer-logo">
          <img src="img/logo2.png" alt="PurrfectPaw Logo" />
          <p>PurrfectPaw</p>
        </div>

        <div class="footer-center">
          <p class="slogan">SIMPLE. EFFICIENT. ACCESSIBLE</p>
          <p class="description">
            We're a diverse and passionate team that takes ownership of your design and empowers you to execute the roadmap.
            We stay light on our feet and truly enjoy delivering great work.
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
import Swal from "sweetalert2";

export default {
  data() {
    return {
      formData: {
        name: '',
        phone: '',
        pet: '',
        breed: '',
        treatment: '',
        petName: '',
        time: '',
        date: '',
      },
      firstName: "",
      lastName: "",
      profilePic: "/img/default-profile.jpg",
      isLoggedIn: false, // Track if user is logged in
      dropdownVisible: false,
    };
  },
  computed: {
    fullName() {
      return `${this.firstName} ${this.lastName}`.trim() || 'User';
    }
  },
  created() {
    const userData = localStorage.getItem("0");

    if (userData) {
      const user = JSON.parse(userData);
      this.firstName = user.first_name;
      this.lastName = user.last_name;
      this.profilePic = user.profile_picture || "/img/default-profile.jpg";
      this.isLoggedIn = true; // Set user as logged in
    }
    
    // Fetch latest user data
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
          this.isLoggedIn = true; // User is logged in
        }
      } catch (error) {
        console.error("Error fetching user profile:", error);
      }
    },
    async logout() {
      try {
        await axios.post("/logout");
        localStorage.removeItem("0"); // Clear stored user data
        this.isLoggedIn = false; // User is now logged out
        this.$router.push("/login");
      } catch (error) {
        console.error("Error logging out:", error);
      }
    },
    toggleDropdown() {
      this.dropdownVisible = !this.dropdownVisible;
    },
    cancelForm() {
      Swal.fire({
        title: "Are you sure you want to cancel?",
        text: "Any unsaved data will be lost.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$router.push('/appointment');
        }
      });
    },
    handleSubmit() {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, confirm appointment!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post('/api/appointments', this.formData)
            .then(() => {
              Swal.fire({
                title: "Success!",
                text: "Your appointment has been confirmed.",
                icon: "success",
                confirmButtonText: "Great!",
              });
              this.$router.push('/appointment');
            })
            .catch(() => {
              Swal.fire({
                title: "Error",
                text: "There was an issue submitting your appointment.",
                icon: "error",
                confirmButtonText: "Try Again",
              });
            });
        } else {
          Swal.fire({
            title: "Cancelled",
            text: "Your appointment has not been confirmed.",
            icon: "error",
            confirmButtonText: "Okay",
          });
        }
      });
    },
  }
};
</script>


<style scoped>
@import "/css/style.css";

.admin-link p {
  font-size: 16px !important;
  color: black !important;
  margin: 0;
  padding: 0;
}

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
  background-color: #e07a9d; /* Soft pink for login */
  color: white;
  padding: 6px 14px; /* Smaller padding */
  border-radius: 6px; /* Smooth edges */
  font-size: 14px; /* Slightly smaller text */
  font-weight: 500;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border: none;
  cursor: pointer;
}

.signup-btn {
  background-color: #62c178; /* Soft green for signup */
  margin-top: 0px;
}

.login-btn:hover {
  background-color: #d15595; /* Slightly darker pink */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.signup-btn:hover {
  background-color: #28a745; /* Slightly darker green */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}
</style>
