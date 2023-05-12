<?php 
    require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container3 {
        margin-top: 5%;
    }

    .container3 .img {
        position: relative;
        text-align: center;
    }

    .container3 .img .style-img {
        height: 450px;
        width: 100%;
        opacity: 90%;
    }

    .container3 .img .bottom-left {
        position: absolute;
        bottom: 30%;
        left: 15%;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 450%;
        color: #fff;
    }


    .container3 .text .text-1 {
        font-family: Cormorant;
        font-size: 34px;
        font-style: italic;
        text-align: center;
        padding-top: 130px;
        color: rgb(250, 198, 35);
    }

    .container3 .text .text-2 {
        font-family: Montserrat, sans-serif;
        font-style: normal;
        font-size: 60px;
        font-weight: 600;
        /*  in độ dày của chữ đậm */
        letter-spacing: .1em;
        /*  khoảng cách giữa các chữ */
        text-align: center;
        color: rgb(68, 66, 41);
        margin-top: -15px;
    }

    .container3 .bar {
        height: 1px;
        width: 160px;
        background-color: rgb(250, 198, 35);
        position: relative;
        margin: 0 auto;
        margin-top: -45px;
        margin-bottom: 50px;
    }

    .container3 .diamond {
        width: 8px;
        height: 8px;
        transform: rotate(45deg);
        position: absolute;
        top: -4px;
        background-color: rgb(250, 198, 35);
        border: 1px solid rgb(250, 198, 35);
        margin: 0 auto;
        right: 0;
        left: 0;
    }

    .container3 .text .text-3 {
        font-family: cursive;
        font-size: 23px;
        font-style: italic;
        text-align: center;
        color: rgb(61, 61, 38);
    }

    .container3 .text {
        margin-bottom: 40px;
    }


    #fname,
    #lname,
    #email,
    #phone {
        height: 50px;
        width: 560px;
        font-family: cursive;
        font-style: italic;
        font-size: 15px;
        cursor: pointer;
        padding-left: 25px;
        box-sizing: border-box;
        color: rgb(154, 152, 152);
    }

    #message {
        height: 290px;
        width: 1150px;
        font-family: cursive;
        font-style: italic;
        cursor: pointer;
        padding-left: 25px;
        padding-top: 15px;
        box-sizing: border-box;
        color: rgb(154, 152, 152);
    }

    #button {
        width: 173px;
        height: 52px;
        cursor: pointer;
        color: #fff !important;
        background: #c19d56 !important;
        font-weight: 500;
        /*  in độ dày của chữ đậm */
        letter-spacing: 0.19em;
        /*  khoảng cách giữa các chữ */
        border: 1px solid rgb(194, 120, 23);
        box-sizing: border-box;
    }

    .container3 .input .input-5,
    .container3 .input .input-6 {
        text-align: center;
    }

    .container3 .input .row .row-1 .input-1,
    .container3 .input .row .row-2 .input-3 {
        padding-right: 15px;
    }

    .container3 .input .row .row-1 .input-2,
    .container3 .input .row .row-2 .input-4 {
        padding-left: 15px;
    }

    .container3 .input .row {
        justify-content: center;
        /* cách cho 2 row căn giữa */
        align-items: center;
    }

    .container3 .input .row .row-1,
    .container3 .input .row .row-2 {
        display: flex;
        padding-bottom: 15px;
        justify-content: center;
        /* cách cho 2 row căn giữa */
        align-items: center;
    }

    .container3 .text .input-5 {
        margin-bottom: 20px;
    }

    .container3 .input {
        margin-bottom: 200px;
    }


    .container3 .font {
        margin-left: 35%;
    }

    .container3 .font .home,
    .container3 .font .phone,
    .container3 .font .email {
        display: flex;
        cursor: pointer;
        margin-bottom: 15px;
        font-size: 20px;
    }

    .container3 .font .home .font-1,
    .container3 .font .phone .font-2,
    .container3 .font .email .font-3 {
        padding-right: 10px;
    }
    </style>
</head>

<body>
    <div class="container3">
        <div class="img">
            <img class="style-img" src="./image/contact3.jpg" alt="">
            <div class="bottom-left">
                <strong>CONTACT US</strong>
            </div>
        </div>

        <div class="text">

            <p class="text-1">come and leave a note</p>


            <p class="text-2">WE ARE SOCIAL</p>
            <div class="bar">
                <div class="diamond"></div>
            </div>


            <p class="text-3">We appreciate being able to connect with you
                using social media. We share regular posts of <br>
                what are doing in-store. Give us a like or follow. We would
                love to hear you share about your experience with <br>
                Vinegar Food.</p>
        </div>

        <div class="input">
            <div class="row">
                <div class="row-1">
                    <div class="input-1">
                        <input type="text" name="fname" id="fname" placeholder="First Name">
                    </div>
                    <div class="input-2">
                        <input type="text" name="lname" id="lname" placeholder="Last Name">
                    </div>
                </div>
                <div class="row-2">
                    <div class="input-3">
                        <input type="text" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="input-4">
                        <input type="text" name="phone" id="phone" placeholder="Phone">
                    </div>
                </div>
            </div>
            <div class="input-5">
                <textarea id="message" name="message" placeholder="Message" rows="4" cols="50"></textarea><br>
            </div>
            <div class="input-6">
                <button type="submit" id="button">SUBMIT</button>
            </div>
        </div>
    </div>

    <?php
        require_once 'footer.php'
    ?>
</body>

</html>