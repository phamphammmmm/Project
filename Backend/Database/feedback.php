<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./feedback.css">
        <title>Feedback</title>
    </head>
    <body>
        <div class="container">
            <div class="banner">
                <img
                    src="https://images.pexels.com/photos/2290070/pexels-photo-2290070.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    alt="">
                <div class="mid-section-img">
                    <strong>
                        <h1 class="heading-banner">FEEDBACK</h1>
                    </strong>
                </div>
            </div>
            <div class="header-feedback">
                <h2>Gửi đến nhà hàng những ý kiến đóng góp</h2>
            </div>

            <div class="container-2">
                <div class="text-feedback">
                    <div class="row-img">
                        <img
                            src="https://www.soraesushi.com/wp-content/uploads/2017/01/reservation-683x1024.jpg"
                            alt="">
                    </div>
                    <div class="row-text">
                        <div class="row">
                            <div class="row-1">
                                <span class="cus-name">
                                    <input type="text" name="name" id="name"
                                        placeholder="Họ tên">
                                </span>
                                <span class="cus-email">
                                    <input type="text" name="email" id="email"
                                        placeholder="Email">
                                </span>
                            </div>
                            <div class="row-2">
                                <span class="cus-phone">
                                    <input type="text" name="phone" id="phone"
                                        placeholder="SĐT">
                                </span>
                                <span class="cus-subject">
                                    <input type="text" name="subject"
                                        id="subject" placeholder="Chủ đề">
                                </span>
                            </div>
                            <div>
                                <div>
                                    <h3>Mức độ hài lòng của bạn về nhà hàng
                                        chúng tôi</h3>
                                </div>
                                <span class="review">
                                    <div class="reac">
                                        <span class="reaction">
                                            <span class="select-1">
                                                <button class="button">Không tốt</button>
                                            </span>
                                            <span class="select-2">
                                                <button class="button">Tốt</button>
                                            </span>
                                            <span class="select-3">
                                                <button class="button">Rất tốt</button>
                                            </span>
                                        </span>
                                    </div>
                                    <br>
                                    <span class="recomment">
                                        <textarea name="cus-message"
                                            id="cus-message" cols="40" rows="1"
                                            placeholder="Chi tiết"></textarea>
                                    </span>
                                    <br>
                                    <br>
                                    <button class="button-submit" type="submit">Gửi</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="feedback.js"></script>
        <script>
        let searchBtn = document.querySelector('.searchBtn');
        let closeBtn = document.querySelector('.closeBtn');
        let searchBox = document.querySelector('.searchBox');

        searchBtn.onclick = function(){
            searchBox.classList.add('active');
            closeBtn.classList.add('active');
            searchBtn.classList.add('active');
        }
        closeBtn.onclick = function(){
            searchBox.classList.remove('active');
            closeBtn.classList.remove('active');
            searchBtn.classList.remove('active');
        }
    </script>
    </body>
</html>