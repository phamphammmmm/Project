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
    .container2 {
        width: 100%;
        margin-top: 5%;
    }

    .container2 .img {
        position: relative;
    }

    .container2 .img .style-img {
        width: 100%;
        height: 450px;
        opacity: 80%;
    }

    .container2 .img .bottom-left {
        position: absolute;
        bottom: 30%;
        left: 15%;
        font-family: Arial, Helvetica, sans-serif;
        color: #fff;
        font-size: 90px;
        letter-spacing: .1em;
    }

    .container2 .row1,
    .container2 .row2,
    .container2 .row3 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
        gap: 1.5rem;
        width: 100%;
        background-color: #fff;
        border-bottom: solid 2px #fff;
        box-sizing: border-box;
        margin-top: 5rem;
    }

    .container2 .row1 .row12,
    .container2 .row2 .row21,
    .container2 .row3 .row32 {
        font-family: cursive;
        font-size: 25px;
        text-align: center;
        width: 50%;
        color: black;
        margin: auto auto;
    }


    @media only screen and (max-width: 768px) {

        .container2 .row1 .row11,
        .container2 .row2 .row22,
        .container2 .row3 .row31 {
            width: 33.33%;
            margin: 0;
        }

        .container2 .row1 .row12,
        .container2 .row2 .row21,
        .container2 .row3 .row32 {
            width: 50%;
        }
    }
    </style>
</head>

<body>
    <div class="container2">
        <div class="img">
            <img class="style-img" src="./image/aw1.jpg" alt="">
            <div class="bottom-left">
                <strong>Awards</strong>
            </div>
        </div>

        <div class="row1">
            <div class="row11"><img src="./image/aw2.png" alt="" style="height: 600px; width: 100%;"></div>
            <div class="row12">
                <p><STRONG>THE BEST RESTAURANT AWARDS 2022</STRONG> ceremony was a highly
                    anticipated event for food lovers all around the world.
                    Finally, after much deliberation, the winner was announced,
                    leaving audiences excited to try out the newly crowned <STRong> BEST RESTAURANT of 2022.</STRong>
                </p>
            </div>
        </div>
        <div class="row2">
            <div class="row21">
                <p>The moment you step into the Michelin award-winning restaurant.
                    The atmosphere is elegant yet comfortable, and the staff are attentive and knowledgeable.
                    Dining at this Michelin award-winning restaurant is an experience like no other,
                    and it is no wonder that it has earned its place among the best restaurants in the world.
                </p>
            </div>
            <div class="row22">
                <img src="./image/aw3.jpg" alt="" style="height: 600px; width: 100%;">
            </div>
        </div>
        <div class="row3">
            <div class="row31"><img src="./image/aw4.png" alt="" style="height: 600px; width: 100%;"></div>
            <div class="row32">
                <p><strong>THANK YOU</strong> for considering our luxury restaurant for the award vote.
                    At our establishment, we strive to provide our guests with an
                    unforgettable experience from start to finish.
                    from the elegant ambiance to the expertly crafted menu items.
                </p>
            </div>
        </div>
    </div>

    <?php
        require_once 'footer.php'
    ?>
</body>

</html>