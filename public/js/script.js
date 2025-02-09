// Get the modal element
var modal = document.getElementById("animal-modal");

// Get the <span> element that closes the modal
var closeBtn = document.getElementsByClassName("galler-close-btn")[0];

// Function to open modal with specific data
function openModal(name, breed, description, image) {
    document.getElementById("modal-name").innerText = name;
    document.getElementById("modal-breed").innerText = breed;
    document.getElementById("modal-description").innerText = description;
    document.getElementById("modal-img").src = image;
    modal.style.display = "block";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal || event.target == closeBtn) {
        modal.style.display = "none";
    }
};

// Attach event listeners to each gallery card
document.querySelectorAll('.gallery-card').forEach(card => {
    card.addEventListener('click', function() {
        var name = this.querySelector('.name').innerText;
        var breed = this.querySelector('.breed').innerText;
        var description = this.querySelector('.description').innerText;
        var image = this.querySelector('img').src;
        
        openModal(name, breed, description, image);
    });
});

// Handle profile dropdown
document.addEventListener('DOMContentLoaded', function () {
    const profileLink = document.getElementById('profileLink');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Hide the dropdown initially
    dropdownMenu.style.display = 'none';

    // Add click event listener to the profile link
    profileLink.addEventListener('click', function (event) {
        event.preventDefault();

        // Toggle the dropdown menu's visibility
        dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
    });

    // Close the dropdown if clicked outside
    window.addEventListener('click', function (event) {
        if (!profileLink.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});

// Cancel form function
function cancelForm() {
    // Clear the form inputs using the correct form ID
    const form = document.getElementById('appointment-form');
    if (form) form.reset(); // Reset the form

    if (confirm('Are you sure you want to cancel?')) {
        window.location.href = 'appointment.html'; // Example: Redirect to the landing page
    }

    // Function to toggle the visibility of the doctor dropdown
function toggleDoctorDropdown(appointmentId) {
    const appointment = document.getElementById(appointmentId);
    const dropdown = appointment.querySelector('.doctor-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Function to assign a doctor to an appointment
function assignDoctor(appointmentId, doctor) {
    const appointment = document.getElementById(appointmentId);
    appointment.querySelector('.assigned-doctor').innerText = `Assigned Doctor: ${doctor}`;
    const dropdown = appointment.querySelector('.doctor-dropdown');
    dropdown.style.display = 'none';  // Hide the dropdown after selection
}
}
