// Select elements
const dropdown = document.getElementById('custom-dropdown');
const dropdownSelectedImg = document.getElementById('dropdown-selected-img');
const dropdownOptions = dropdown.querySelector('.dropdown-options');
const profilePicture = document.getElementById('selected-profile-pic');

// Toggle dropdown visibility
dropdown.addEventListener('click', (e) => {
    e.stopPropagation(); // Prevent clicks from bubbling
    dropdown.classList.toggle('active');
});

// Update the profile picture when an option is clicked
dropdownOptions.addEventListener('click', (e) => {
    if (e.target.tagName === 'IMG') {
        const selectedAvatarSrc = e.target.getAttribute('src');
        dropdownSelectedImg.setAttribute('src', selectedAvatarSrc);
        profilePicture.setAttribute('src', selectedAvatarSrc);
        dropdown.classList.remove('active'); // Close the dropdown
    }
});

// Close dropdown if clicking outside
document.addEventListener('click', () => {
    dropdown.classList.remove('active');
});

// Save button action
const saveButton = document.getElementById('save-profile-pic');
saveButton.addEventListener('click', () => {
    alert(`Profile picture saved!`);
});
