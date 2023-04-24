// get the dropdown button and dropdown content
const dropdownBtn = document.querySelector(".dropbtn");
const dropdownContent = document.querySelector(".dropdown-content");

// add an event listener to the dropdown button to toggle the dropdown content
dropdownBtn.addEventListener("click", () => {
    dropdownContent.classList.toggle("show");
});

// close the dropdown when the user clicks outside of it
window.addEventListener("click", (event) => {
    if (!event.target.matches(".dropbtn")) {
        dropdownContent.classList.remove("show");
    }
});


// Lấy danh sách các hình ảnh trong slideshow
var slideshowImages = document.querySelectorAll('.slideshow-image');
// Thiết lập biến đếm slide hiện tại
var currentSlide = 0;
// Thiết lập thời gian chuyển slide (đơn vị là mili giây)
var slideInterval = 3000; // 3 giây

// Hàm chuyển slide
function autoSlide() {
    // Ẩn slide hiện tại
    slideshowImages[currentSlide].style.opacity = 0;
    // Tăng biến đếm slide hiện tại lên 1
    currentSlide = (currentSlide + 1) % slideshowImages.length;
    // Hiển thị slide tiếp theo
    slideshowImages[currentSlide].style.opacity = 1;
}

// Bắt đầu tự động chuyển slide
setInterval(autoSlide, slideInterval);

// Hàm chuyển slide khi click nút "Prev"
function prevSlide() {
    // Ẩn slide hiện tại
    slideshowImages[currentSlide].style.opacity = 0;
    // Giảm biến đếm slide hiện tại xuống 1
    currentSlide = (currentSlide - 1 + slideshowImages.length) % slideshowImages.length;
    // Hiển thị slide trước đó
    slideshowImages[currentSlide].style.opacity = 1;
}
//Hàm chuyển slide khi click  "Next"
function nextSlide() {
    // Ẩn slide hiện tại
    slideshowImages[currentSlide].style.opacity = 0;
    // Tăng biến đếm slide hiện tại lên 1
    currentSlide = (currentSlide + 1) % slideshowImages.length;
    // Hiển thị slide tiếp theo
    slideshowImages[currentSlide].style.opacity = 1;
}
