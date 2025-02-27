<template>
  <div>
    <header>
      <nav class="topnav">
        <div class="logo-container">
          <img src="img/logo.png" alt="PurfectPaw Logo" class="logo" />
        </div>
        <ul class="nav-links">
          <li><router-link to="/" >Home</router-link></li>
          <li><router-link to="/appointment">Appointment</router-link></li>
          <li><router-link to="/gallery" class="active">Gallery</router-link></li>
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

    <!-- Gallery Section -->
    <section class="gallery-section">
      <h1>Gallery</h1>
      <div class="gallery-container">
        <div v-for="pet in pets" :key="pet.name" class="gallery-card" @click="openModal(pet)">
          <img :src="pet.image" :alt="pet.name">
          <p>{{ pet.name }}</p>
          <span>{{ pet.breed }}</span>
          <h4 class="description" style="display: none;">{{ pet.description }}</h4>
        </div>
      </div>
    </section>

    <!-- Modal Structure for Animal Details -->
    <div v-if="selectedPet" id="animal-modal" class="gallery-modal" @click.self="closeModal">
      <div class="gallery-modal-content">
        <span class="gallery-close-btn" @click="closeModal">&times;</span>
        <div class="gallery-modal-body">
          <div class="gallery-modal-image">
            <img :src="selectedPet.image" alt="Animal Image" class="modal-image">
          </div>
          <div class="gallery-modal-text">
            <h2>{{ selectedPet.name }}</h2>
            <p>{{ selectedPet.breed }}</p>
            <h4>{{ selectedPet.description }}</h4>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div class="footer-container">
        <!-- Left: Logo and Brand Name -->
        <div class="footer-logo">
          <img src="img/logo2.png" alt="PurrfectPaw Logo">
          <p>PurrfectPaw</p>
        </div>

        <!-- Center: Slogan and Description -->
        <div class="footer-center">
          <p class="slogan">SIMPLE. EFFICIENT. ACCESSIBLE</p>
          <p class="description">
            We're a diverse and passionate team that takes ownership of your design and empowers <br>you to execute the roadmap. We stay light on our feet and truly enjoy delivering great work.
          </p>
          <p>© 2024 PetalloDulis. All Rights Reserved.</p>
        </div>

        <!-- Right: Contact Information -->
        <div class="footer-contact">
          <p>Contact Us</p>
          <p><a href="mailto:info@example.com">info@example.com</a></p>
          <p>+1 (555) 123-4567</p>
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
      dropdownVisible: false,
      selectedPet: null,
      pets: [
        {
          name: "Gary",
          breed: "Yorkshire Terrier",
          image: "img/gallery/dog2.jpg",
          description: "Gary is a lively Yorkshire Terrier with a charming personality. He loves to play fetch and enjoys long walks in the park. His affectionate nature makes him a delightful companion."
        },
        {
          name: "Alejandro",
          breed: "Unknown Breed",
          image: "img/gallery/dog1.jpg",
          description: "Alejandro is a curious and playful dog, always ready for an adventure. His unique looks and friendly demeanor endear him to everyone he meets. He's a loyal friend who loves cuddles and belly rubs."
        },
        {
          name: "Momi",
          breed: "Siberian Cat",
          image: "img/gallery/dog3.jpg",
          description: "Momi is a stunning Siberian cat known for her fluffy coat and vibrant personality. She enjoys lounging in sunny spots and chasing after her favorite toys. With her playful antics, Momi brings joy to everyone around her."
        },
        {
          name: "Whiffle",
          breed: "British Longhair",
          image: "img/gallery/dog4.jpeg",
          description: "Whiffle is a regal British Longhair cat with a calm and gentle demeanor. She enjoys quiet moments of relaxation, often perched in her favorite window. Her soft purring and affectionate nature make her a beloved member of the family."
        },
        {
          name: "Buggy",
          breed: "Jack Russell",
          image: "img/gallery/ydog1.jpg",
          description: "Buggy is an energetic Jack Russell with a zest for life. He loves to explore and is always up for a game of chase. His playful spirit and intelligence make him an entertaining companion."
        },
        {
          name: "Spike",
          breed: "Maine Coon",
          image: "img/gallery/ydog4.jpg",
          description: "Spike is a majestic Maine Coon known for his large size and friendly attitude. He enjoys socializing with his human friends and loves to be the center of attention. His playful nature and unique personality make him a joy to have around."
        },
        {
          name: "Celie",
          breed: "Welsh Corgi",
          image: "img/gallery/ydog2.jpeg",
          description: "Celie is a cheerful Welsh Corgi with a playful spirit. She loves to chase after her toys and is always ready to make new friends. Her adorable little face and energetic antics bring smiles to everyone she meets."
        },
        {
          name: "Kiwi",
          breed: "Yorkshire Terrier",
          image: "img/gallery/ydog3.jpg",
          description: "Kiwi is a spirited Yorkshire Terrier with a heart full of love. She enjoys snuggling with her favorite humans and exploring the outdoors. Her lively personality and playful nature make her a wonderful companion."
        },
        {
          name: "Kiwi",
          breed: "Yorkshire Terrier",
          image: "img/gallery/galcat1.jpg",
          description: "This adorable Kiwi is a friendly Yorkshire Terrier who loves to show off her playful side. Whether she's chasing after butterflies or lounging in the sun, she's always up for some fun. Her charm and affection make her a beloved pet."
        },
        {
          name: "Ricky",
          breed: "Yorkshire Terrier",
          image: "img/gallery/galcat2.jpg",
          description: "Ricky is a curious and playful Yorkshire Terrier who enjoys discovering new things. He has a heart of gold and loves to be around people. His friendly nature and adorable antics make him an instant favorite."
        },
        {
          name: "Allie",
          breed: "Yorkshire Terrier",
          image: "img/gallery/galcat3.jpg",
          description: "Allie is a sweet Yorkshire Terrier known for her playful spirit and love of adventure. She enjoys long walks and exploring new places. With her charming personality, Allie is always ready to make new friends."
        },
        {
          name: "Sam",
          breed: "Yorkshire Terrier",
          image: "img/gallery/galcat4.jpg",
          description: "Sam is a lively Yorkshire Terrier who loves to bring joy to those around him. He enjoys playing games and spending time with his family. His affectionate nature and playful antics make him a cherished companion."
        }
      ],
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
    toggleDropdown() {
      this.dropdownVisible = !this.dropdownVisible;
    },
    openModal(pet) {
      this.selectedPet = pet;
    },
    closeModal() {
      this.selectedPet = null;
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
@import "/css/style.css";

/* Update the profile link styling */
.admin-link p {
  font-size: 16px !important; /* Override any other styles */
  color: black !important;
  margin: 0;
  padding: 0;
}

/* Remove or update the conflicting style */
.profileLink p {
  font-size: 16px;
  color: gray;
}

/* Modal Styles */
.gallery-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.gallery-modal-content {
  background-color: white;
  border-radius: 20px;
  padding: 20px;
  width: 600px;
  max-width: 90%;
  display: flex;
  flex-direction: column;
  animation: zoomIn 0.3s ease-in-out;
  position: relative;
}

.gallery-modal-body {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 0;
  padding: 0;
  
}

.gallery-modal-image {
  width: 45%;
  flex-shrink: 0; 
}

.modal-image {
  width: 100%;
  border-radius: 15px;
}

.gallery-modal-text {
  width: 50%;
  padding-left: 20px;
}

h2 {
  font-size: 1.8rem;
  margin-bottom: 10px;
}

p {
  font-size: 1.2rem;
  color: gray;
}

h4 {
  margin-top: 15px;
  font-weight: normal;
  line-height: 1.4;
}

.gallery-close-btn {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 2rem;
  cursor: pointer;
  color: black;
}

@keyframes zoomIn {
  from {
    transform: scale(0.5);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
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