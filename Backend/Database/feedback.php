<?php 
    require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./feedback.css"> -->
    <style>
    body {
        padding: 0;
        margin: 0;
        background-color: wheat;
    }

    .container {
        position: relative;
        justify-content: center;
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
    }

    .header-banner {
        position: relative;
        text-align: center;
        background-size: cover;
    }

    .header-banner img {
        background-size: cover;
        width: 100%;
        height: 450px;
        top: 0;
        left: 0;
        right: 0;
        background-position: center center;
    }

    h1 {
        position: absolute;
        bottom: 8%;
        left: 15%;
        font-size: 650%;
        color: #fff;
    }

    .header-feedback {
        text-align: center;
        font-size: 180%;
        margin: 30px 0;
    }

    .text-feedback {
        margin-bottom: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .row-img img {
        max-width: 100%;
        vertical-align: top;
        width: 262px;
        height: 393px;
    }

    .row-feedback {
        display: flex;
        justify-content: center;
        margin: 0 30px;
    }

    .row-text {
        justify-content: center;
        align-items: center;
    }

    .row-1,
    .row-2 {
        display: flex;
        padding-bottom: 15px;
        justify-content: center;
        align-items: center;
    }

    ::placeholder {
        color: #a12022;
    }

    .cus-name,
    .cus-phone {
        padding-right: 15px;
    }

    .cus-email,
    .cus-subject {
        padding-left: 15px;
    }

    #name,
    #email,
    #phone,
    #subject {
        height: 50px;
        width: 300px;
        cursor: pointer;
        padding-left: 10px;
    }

    h3 {
        margin: 10px 0;
        font-size: 130%;
    }

    .reac {
        margin: 20px 0;
    }

    .button1 {
        cursor: pointer;
        border-radius: 5px;
        border: 1px solid #a12022;
        background-color: white;
        color: #a12022;
        height: 35px;
        width: 120px;
    }

    .button1:not(.selected):hover {
        background-color: #a12022;
        color: white;
    }

    /* .button.selected {
        background-color: #a12022;
        color: white;
        } */
    .button1:focus {
        background-color: #a12022;
        color: white;
    }

    .comments {
        margin-bottom: 30px;
    }

    textarea {
        border-radius: 5px;
        border: 1px solid #a12022;
    }

    #cus-message {
        height: 40px;
        width: 600px;
    }

    .button-submit {
        width: 173px;
        height: 52px;
        cursor: pointer;
        color: white;
        background-color: #a12022;
        border-radius: 5px;
        border: 2px solid white;
    }

    .button-submit:not(.selected):hover {
        background-color: white;
        color: black;
    }

    .row-1 .cus-name input,
    .row-1 .cus-email input,
    .row-2 .cus-phone input,
    .row-2 .cus-subject input {
        border-radius: 5px;
        border: 1px solid #a12022;
        border-bottom: 1px solid #a12022;
        padding: 1px 2px;
        color: #a12022;
        outline: #a12022;
    }

    .row-1 .cus-name ::placeholder,
    .row-1 .cus-email ::placeholder,
    .row-2 .cus-phone ::placeholder,
    .row-2 .cus-subject ::placeholder {
        color: #a12022;
    }

    .comments .recomment textarea {
        padding: 5px 0px 0px 10px;
        color: #a12022;
    }

    .comments .recomment ::placeholder {
        color: #a12022;
    }

    /* mobile: width < 740px*/
    @media only screen and (max-width: 739px) {
        .container {
            max-width: 739px;
        }
    }
    </style>
    <title>Feedback</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-banner">
                <img src="./image/feedback.jpg" alt="">
                <div class="mid-section-img">
                    <strong>
                        <h1>FEEDBACK</h1>
                    </strong>
                </div>
            </div>
            <div class="header-feedback">
                <h2>Leave feedback for Vinegaer</h2>
            </div>
        </div>

        <div class="text-feedback">
            <div class="row-img">
                <img src="https://www.soraesushi.com/wp-content/uploads/2017/01/reservation-683x1024.jpg" alt="">
            </div>

            <div class="row-feedback">
                <div class="row-text">
                    <div class="row-1">
                        <span class="cus-name">
                            <input type="text" name="name" id="name" placeholder="Full name (*)">
                        </span>
                        <span class="cus-email">
                            <input type="text" name="email" id="email" placeholder="Email (*)">
                        </span>
                    </div>

                    <div class="row-2">
                        <span class="cus-phone">
                            <input type="text" name="phone" id="phone" placeholder="phone number (*)">
                        </span>
                        <span class="cus-subject">
                            <input type="text" name="subject" id="subject" placeholder="Topic (*)">
                        </span>
                    </div>

                    <div>
                        <h3>How satisfied are you with our restaurant?</h3>
                    </div>
                    <span class="review">
                        <div class="reac">
                            <span class="reaction">
                                <span class="select-1">
                                    <button class="button1">Not good</button>
                                </span>
                                <span class="select-2">
                                    <button class="button1">Good</button>
                                </span>
                                <span class="select-3">
                                    <button class="button1">Very Good</button>
                                </span>
                            </span>
                        </div>
                        <div class="comments">
                            <span class="recomment">
                                <textarea name="cus-message" id="cus-message" cols="40" rows="1"
                                    placeholder="Detail"></textarea>
                            </span>
                        </div>
                        <button class="button-submit" type="submit">Submit</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once 'footer.php'
    ?>
    <script src="feedback.js"></script>
    <script>
    let searchBtn = document.querySelector('.searchBtn');
    let closeBtn = document.querySelector('.closeBtn');
    let searchBox = document.querySelector('.searchBox');

    searchBtn.onclick = function() {
        searchBox.classList.add('active');
        closeBtn.classList.add('active');
        searchBtn.classList.add('active');
    }
    closeBtn.onclick = function() {
        searchBox.classList.remove('active');
        closeBtn.classList.remove('active');
        searchBtn.classList.remove('active');
    }
    </script>
</body>

</html>