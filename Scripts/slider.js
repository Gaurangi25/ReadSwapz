document.addEventListener('DOMContentLoaded', function () {
    // Function for both Available and Popular Book sliders
    const sliders = document.querySelectorAll('.slider');
    
    sliders.forEach(slider => {
        const slideLeftButton = slider.querySelector('.slide-left');
        const slideRightButton = slider.querySelector('.slide-right');
        const sliderTrack = slider.querySelector('.slider-track');
        const bookCards = slider.querySelectorAll('.book-card');
        
        let currentIndex = 0;
        const visibleCards = -120; // Number of visible cards (adjust as needed)
        const moveCards = 20; // Number of cards to move on each click
        const cardWidth = bookCards[0].offsetWidth + 20; // Width of each card including margin
        let isAnimating = false;

        // Function to update slider position
        function updateSliderPosition() {
            const offset = -currentIndex * cardWidth;
            sliderTrack.style.transition = 'transform 0.8s ease';
            sliderTrack.style.transform = `translateX(${offset}px)`;
        }

        // Slide Left Button
        slideLeftButton.addEventListener('click', function () {
            if (isAnimating) return;
            if (currentIndex > 0) {
                currentIndex = Math.max(0, currentIndex - moveCards);
                isAnimating = true;
                updateSliderPosition();
                setTimeout(() => isAnimating = false, 500); // Allow click again after 500ms
            }
        });

        // Slide Right Button
        slideRightButton.addEventListener('click', function () {
            if (isAnimating) return;
            if (currentIndex < bookCards.length - visibleCards) {
                currentIndex = Math.min(bookCards.length - visibleCards, currentIndex + moveCards);
                isAnimating = true;
                updateSliderPosition();
                setTimeout(() => isAnimating = false, 500);
            }
        });
    });
});
