let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

// let mainImage = document.querySelector('.quick-view .box .row .image-container .main-image img');
// let subImages = document.querySelectorAll('.quick-view .box .row .image-container .sub-image img');

// subImages.forEach(images =>{
//    images.onclick = () =>{
//       src = images.getAttribute('src');
//       mainImage.src = src;
//    }
// });

//slider
const slides = document.querySelector('.slides');
const slideImages = document.querySelectorAll('.slides img');
const slideCount = slideImages.length;
const slideWidth = slideImages[0].clientWidth;
const slideInterval = 2000; // 2 seconds

let slideIndex = 0;
let slideTimer = null;

// Set initial position of slides
slides.style.transform = `translateX(${-slideWidth * slideIndex}px)`;

// Start automatic slide transitions
function startSlideShow() {
    slideTimer = setInterval(() => {
        slideIndex++;
        if (slideIndex >= slideCount) {
            slideIndex = 0;
    }
    slides.style.transform = `translateX(${-slideWidth * slideIndex}px)`;
    }, slideInterval);
}

// Pause automatic slide transitions on hover
slides.addEventListener('mouseover', () => {
    clearInterval(slideTimer);
});

// Resume automatic slide transitions on mouseout
slides.addEventListener('mouseout', () => {
    startSlideShow();
});

// Start automatic slide transitions on page load
startSlideShow();