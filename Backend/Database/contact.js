// Khởi tạo bản đồ Google Maps
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 37.7749, lng: -122.4194 }, // Vị trí trung tâm bản đồ
        zoom: 13 // Độ zoom của bản đồ
    });

    // Thêm đánh dấu tại địa chỉ của công ty
    var marker = new google.maps.Marker({
        position: { lat: 37.7749, lng: -122.4194 },
        map: map,
        title: ''
    });
}

// Xử lý sự kiện gửi biểu mẫu liên hệ
document.getElementById('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Ngăn chặn trình duyệt chuyển hướng đến trang khác

    // Lấy thông tin từ biểu mẫu liên hệ
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;

    // Gửi email đến địa chỉ email của công ty
    window.location.href = 'mailto:phamtiendat246@gmail.com?subject=Liên hệ từ ' + name + '&body=' + message;
});
