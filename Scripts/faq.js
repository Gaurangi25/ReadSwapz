// Profile Picture Selection Script
document.addEventListener("DOMContentLoaded", () => {
    const avatarOptions = document.querySelectorAll(".avatar-option");
    const selectedProfilePic = document.getElementById("selected-profile-pic");
    const saveButton = document.getElementById("save-profile-pic");

    // Highlight selected avatar
    avatarOptions.forEach((avatar) => {
        avatar.addEventListener("click", () => {
            // Remove 'selected' class from all avatars
            avatarOptions.forEach((item) => item.classList.remove("selected"));
            // Add 'selected' class to the clicked avatar
            avatar.classList.add("selected");

            // Update the main profile picture
            selectedProfilePic.src = avatar.src;
        });
    });

    // Save the profile picture (could be extended to send data to a server)
    saveButton.addEventListener("click", () => {
        const selectedAvatar = document.querySelector(".avatar-option.selected");
        if (selectedAvatar) {
            alert("Profile picture updated successfully!");
        } else {
            alert("Please select a profile picture before saving.");
        }
    });
});
