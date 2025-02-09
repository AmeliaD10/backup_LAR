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
        <div class="profile">
          <img src="img/cat.jpg" alt="Profile" class="profile-pic" />
          <a href="#" class="admin-link" @click="toggleDropdown">
            <p>Arabella Mee <i class="fas fa-caret-down"></i></p>
          </a>

          <!-- Dropdown content -->
          <div class="dropdown-menu" v-if="dropdownVisible">
            <router-link to="/logout">Logout</router-link>
            <router-link to="/account">Account</router-link>
          </div>
        </div>
      </nav>
    </header>

    <!-- Main Welcome Section -->
    <main>
      <div class="form-container">
        <form @submit.prevent="handleSubmit">
          <h2>Appointment Formssa</h2>
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
import axios from 'axios';
import Swal from 'sweetalert2';

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
      dropdownVisible: false,
    };
  },
  methods: {
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
            .then((response) => {
              Swal.fire({
                title: "Success!",
                text: "Your appointment has been confirmed.",
                icon: "success",
                confirmButtonText: "Great!",
              });
              this.$router.push('/appointment');
            })
            .catch((error) => {
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
  },
};
</script>

<style scoped>
@import "/css/style.css";
</style>
