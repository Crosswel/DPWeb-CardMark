const images = [
    { src: "static/Vg_new_logo.png", link: "vanguard.php" },
    { src: "static/Pokemon-Logo.png", link: "pokemon.php" },
    { src: "static/yugi.png", link: "yugi.php" }
];

let currentIndex = 0;
const imgElement = document.getElementById("carousel-image");
const linkElement = document.getElementById("carousel-link");

function changeSlide(direction) {
    currentIndex += direction;

    if (currentIndex < 0) {
        currentIndex = images.length - 1;
    } else if (currentIndex >= images.length) {
        currentIndex = 0;
    }

    imgElement.style.opacity = 0;

    setTimeout(() => {
        imgElement.src = images[currentIndex].src;
        linkElement.href = images[currentIndex].link;
        imgElement.style.opacity = 1;
    }, 300);
}
