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
    .container5 {
        margin-top: 5%;
    }

    .container5 .row1 {
        position: relative;
        margin-bottom: -10px;
    }

    .container5 .row1 .bottom-left {
        width: 25%;
        height: 40%;
        position: absolute;
        bottom: 35%;
        left: 15%;
        font-family: Arial, Helvetica, sans-serif;
        color: aliceblue;
        background-color: #3a3b38;
        opacity: 0.8;
        /* độ mờ của thẻ div */
        box-sizing: border-box;
    }

    .container5 h2 {
        text-align: center;
        color: #99876f;
        padding-top: 1rem;
    }

    .container5 .bar {
        height: 1px;
        width: 5rem;
        background-color: rgb(250, 198, 35);
        position: relative;
        margin: 0 auto;
        margin-top: -10px;
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    .container5 .diamond {
        box-sizing: border-box;
        width: 0.5rem;
        height: 0.5rem;
        transform: rotate(45deg);
        position: absolute;
        top: -4px;
        background-color: rgb(250, 198, 35);
        border: 1px solid rgb(250, 198, 35);
        margin: 0 auto;
        right: 0;
        left: 0;
    }

    .container5 .row2,
    .container5 .row3 {
        width: 100%;
        height: 37.5rem;
        display: flex;
        box-sizing: border-box;
        background-color: rgb(0, 0, 0);
    }

    .container5 .row2 .row2-2,
    .container5 .row3 .row3-1 {
        width: 40%;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        margin: auto 0;
    }

    .container5 p {
        text-align: center;
        font-size: 1rem;
        padding: 0 3rem;
        line-height: 1.4;
        color: #fff;
    }

    .container5 img {
        height: 37.5rem;
        width: 100%;
    }


    /* Styles for screens with a maximum width of 767px */
    @media only screen and (max-width: 767px) {
        .row1 {
            position: static;
            margin-bottom: 1rem;
        }

        .bottom-left {
            width: 100%;
            height: auto;
            position: static;
            margin-top: 1rem;
            margin-bottom: 1rem;
            background-color: transparent;
            opacity: 1;
            box-sizing: content-box;
        }

        h2 {
            font-size: 1.5rem;
            padding-top: 0.5rem;
        }

        .bar {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .diamond {
            top: -3px;
        }

        .row2 {
            flex-direction: column;
            height: auto;
        }

        .row2-1 {
            order: 2;
        }

        .row2-2 {
            order: 1;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            padding: 0 1rem;
            line-height: 1.4;
        }

        img {
            height: auto;
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container5">
        <div class="row1">
            <img src="./image/home1.jpg" alt="">
            <div class="bottom-left">
                <h2>THE RESTAURANT</h2>

                <div class="bar">
                    <div class="diamond"></div>
                </div>

                <p>Welcome to the Pré Catelan! Located in the
                    heart of the famous Bois de Boulogne, this
                    treasure of French cuisine received 3 stars in
                    the Michelin Guide.
                </p>
            </div>
        </div>
        <div class="row2">
            <div class="row2-1">
                <img class="img1" src="./image/home2.jpg" alt="">
            </div>
            <div class="row2-2">
                <h2>WELCOME</h2>

                <div class="bar">
                    <div class="diamond"></div>
                </div>

                <p>
                    Here, interior architect Pierre Yves Rochon has created a
                    stunningly modern concept in touch with its environment,
                    preserving the elegance of the house, “To find yourself in a
                    prodigious place, in the open air, in the peacefulness of the Bois
                    de Boulogne, in Paris, and there to enjoy cuisine by a great
                    chef, all the while savoring the architecture of the building”.
                    Green, black, white and silver are the dominant colors: green, as
                    a nod to the greenery outside, black, white and silver
                    interspersed to mark spaces, enhance details, pilasters and bas-
                    reliefs. The furniture, by turns in harmony or opposition with
                    the architecture of the building, traditional and modern, thus
                    accentuating this impression of purity and lightness.
                </p>
            </div>
        </div>

        <div class="row3">
            <div class="row3-1">
                <h2>HISTORY</h2>

                <div class="bar">
                    <div class="diamond"></div>
                </div>

                <p>
                    Opened in 1856, Le Pré Catelan quickly became a resounding
                    success: the bucolic site, the quality of the orchestras and the
                    refinement of the parties made it one of the most popular
                    places in the capital.
                    Colette and Gaston Lenôtre took over Le Pré Catelan in 1976
                    and turned its reception rooms into one of the citys top venues
                    for events, particularly renowned for its high-end cuisine.
                    Since 2011, Le Pré Catelan has been one of Sodexos Prestige
                    venues and brands.
                </p>
            </div>

            <div class="row3-2">
                <img class="img1" src="./image/home3.jpg" alt="">
            </div>
        </div>
    </div>
    </div>

    <?php
        require_once 'footer.php'
    ?>
</body>

</html>