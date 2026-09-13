const slides = document.querySelectorAll(".rotation-slide");
let currentSlide = 0;

const rotationBlock = document.querySelector(".rotation-block");
const images = ["url('img/crop.jpg')", "url('img/crops-growing.jpg')", "url('img/Crops-Header2.png')"];

function rotateContent() {
    slides[currentSlide].classList.remove('active');
    rotationBlock.style.backgroundImage = images[currentSlide];
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}

setInterval(rotateContent, 4000);