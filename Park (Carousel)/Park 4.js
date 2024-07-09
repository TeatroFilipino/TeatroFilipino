let slideIndex = 0;

function showSlides() {
    const slides = document.getElementsByClassName("mySlides");

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.opacity = 0;
        slides[i].style.display = "none";
    }

    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";
    fadeIn(slides[slideIndex - 1], 0);
}

function fadeIn(element, opacity) {
    let increment = 0.005;

    function fade() {
        opacity += increment;
        element.style.opacity = opacity;

        if (opacity < 1) {
            requestAnimationFrame(fade);
        }
    }

    fade();
}

// Start the automatic slideshow
setInterval(showSlides, 5000); // Adjust the interval (in milliseconds) for automatic slideshow

// Invoke the showSlides function to start the slideshow immediately
showSlides();