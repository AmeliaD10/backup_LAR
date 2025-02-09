document.querySelectorAll('.doctor-card').forEach(doctorCard => {
    doctorCard.addEventListener('click', function() {
        alert(`You clicked on ${this.innerText}`);
    });
});

document.getElementById('logout-button').addEventListener('click', function() {
    alert('You have logged out.');
});

document.querySelector('.dropdown-icon').addEventListener('click', function() {
    const logoutButton = document.getElementById('logout-button');
    logoutButton.classList.toggle('hidden');
});

// Function to toggle the dropdown
function toggleDropdown(button) {
    const dropdown = button.nextElementSibling; // Get the dropdown related to the clicked button
    dropdown.classList.toggle('hidden');
}

// Function to assign a doctor
function assignDoctor(item, doctorName) {
    const row = item.closest('tr'); // Get the closest table row
    const statusCell = row.querySelector('.status'); // Find the status cell

    // Only change the status if it's blank
    if (!statusCell.textContent) {
        statusCell.textContent = 'Approved'; // Update the status to "Approved"
        statusCell.classList.remove('cancelled'); // Remove any previous class
        statusCell.classList.add('approved'); // Add approved class for styling
    }

    // Hide the dropdown after selecting a doctor
    const dropdown = item.closest('.doctor-dropdown');
    dropdown.classList.add('hidden');
}

// Function to cancel the appointment
function cancelAppointment(button) {
    const row = button.closest('tr'); // Get the closest table row
    const statusCell = row.querySelector('.status'); // Find the status cell

    // Update the status to "Cancelled"
    statusCell.textContent = 'Cancelled';
    statusCell.classList.remove('approved'); // Remove any previous class
    statusCell.classList.add('cancelled'); // Add cancelled class for styling
}



