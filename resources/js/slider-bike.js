const slides = [
    {
        image: "/images/nmax.png",
        title: "NMAX",
    },
    {
        image: "/images/xmax.png",
        title: "XMAX",
    },
    {
        image: "/images/tmax.png",
        title: "TMAX",
    },
];

let currentSlide = 0;

window.setSlide = function (index) {
    currentSlide = index;

    document.getElementById("slideImage").src = slides[index].image;
    document.getElementById("slideTitle").innerText = slides[index].title;

    document.querySelectorAll(".dot").forEach((dot, i) => {
        dot.classList.toggle("bg-white", i === index);
        dot.classList.toggle("bg-gray-500", i !== index);
    });
};

setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    setSlide(currentSlide);
}, 4000);
