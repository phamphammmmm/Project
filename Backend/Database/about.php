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
    /* Thiết lập kiểu CSS cho thiết bị có chiều rộng màn hình tối đa là 768px */

    .container1 {
        margin-top: 5%;
    }

    .container1 .section1,
    .container1 .section2 p {
        margin: 0 auto;
        color: #f2f2f2;
        font-size: 18px;
        font-family: cursive;
    }

    .container1 button {
        background-color: white;
        cursor: pointer;
        margin: 20px 0px 0px 0px;
        padding: 15px 20px;
    }

    .content,
    .image-wrapper {
        width: 50%;
    }

    /* section1 */
    .container1 .section1 {
        background-image: url("./image/about8.webp");
        background-size: cover;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .section1 .image-wrapper {
        width: 50%;
        text-align: center;
    }

    .section1 .content1 {
        width: 50%;
    }

    .section1 .image-wrapper img {
        padding: 100px 0px;
    }

    .content1 * {
        text-align: left;
    }

    .section1 .content1 p {
        color: #fff;
    }

    .section1,
    .section2 h2,
    h3,
    h4 {
        color: #fff;
    }

    /* section2 */
    .section2 {
        background-image: url("./image/about2.webp");
        background-size: cover;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 0px 0px 100px 0px;
    }

    .section2 p {
        width: 473px;
        height: auto;
        text-align: left;
        color: #f2f2f2;
    }

    .section2 .content img {
        width: 473px;
        height: 311px;
    }

    .section2 .content {
        width: 50%;
        text-align: center;
    }

    .section2 .ceo {
        width: 50%;
        padding: 50px 0px 0px 50px;
    }

    .section2 .ceo img {
        width: 473px;
        height: 311px;
    }

    /* section3 */
    .section3 {
        background-color: rgb(255, 228, 196);
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .section3 .image-wrapper {
        width: 50%;
    }

    .section3 .image-wrapper img {
        max-width: 100%;
        height: auto;
    }

    .section3 .content {
        width: 50%;
        padding: 0px 0px 0px 75px;
    }

    .section3,
    .section4 p {
        color: black;
    }

    /* section4*/
    .section3,
    .section4 h2,
    p {
        /* color: black; */
    }

    .section4 {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .content,
    .image-wrapper {
        flex-basis: 50%;
    }

    .section4 .image-wrapper img {
        width: 546px;
        height: 358px;
    }

    .section4 .content {

        margin-top: -30px;
    }

    .section4 .image-wrapper {
        text-align: center;
        padding: 110px 0px;
    }

    .description {
        width: 400px;
        margin-left: 150px;
    }

    .container1 button:hover {
        background-color: #333;
        color: white;
    }

    .container1 .title4 {
        font-family: Montserrat, sans-serif;
        font-style: normal;
        font-size: 30px;
        letter-spacing: .1em;
    }

    .container1 .text4 {
        font-family: system-ui;
        font-size: 18px;
    }
    </style>
</head>

<body>
    <div class="container1">
        <div class="section1">
            <div class="image-wrapper">
                <img src="./image/about1.jpg" alt="Food Vinegar Restaurant"
                    style="max-width: 531px; max-height: 531px;" />
            </div>
            <div class="content1">
                <p class="text">
                    What started in 1998, Food Vinegar Restaurant, the
                    flagship brand of
                    JADONS Ltd, has been in the industry for the past few
                    decades. Up to
                    now, the restaurant has more than 1000 branches. The
                    Michelin-starred chain offers a restaurant experience to
                    suit every
                    taste and budget. Dubbed "Snack Food" with 72 different
                    rotating
                    menus and 240000 delicious dishes covering the whole
                    country. From a
                    fast casual atmosphere with floating fun to delicious
                    meals, no
                    matter which Vinegar Foods Restaurant experience you
                    choose, you'll
                    never forget.
                </p>
                <p>
                    The Vinegar Foods restaurant will continue to launch
                    dishes that are
                    loved by many people across the continent, while
                    developing new
                    innovative concepts — all of which offer the exceptional
                    experience
                    one can look forward to. Fresh and unique in every dish.
                </p>
                <button class="btn-location">View Location</button>
                <div class="quote">
                    <h3>"I serve, and I'm incredibly by what I do."</h3>
                    <h4>CEO Pham Tien Dat</h4>
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="content">
                <h2 class="title">Our Story</h2>
                <img src="./image/about3.jpg" alt="Gordon Ramsay North
                        America" />
                <p class="text">
                    Gordon Ramsay North America comprises the North American
                    restaurant
                    business of acclaimed chef, restaurateur, TV
                    personality, and author
                    Gordon Ramsay. In 2019, Gordon Ramsay inked a deal with
                    private
                    equity firm Lion Capital to expand Gordon Ramsay
                    restaurant concepts
                    across the U.S. We're excited to scale dining
                    concepts—fast-casual,
                    casual, and upscale—with plans to launch new brands like
                    Ramsay's
                    Kitchen and tap into several of the successful U.S. and
                    international key brands, including Gordon Ramsay Fish &
                    Chips,
                    Gordon Ramsay Burger, Gordon Ramsay Street Pizza, Gordon
                    Ramsay
                    Steak, Lucky Cat by Gordon Ramsay and Hell's Kitchen.
                </p>
                <p>
                    We currently have twelve restaurants in the U.S., with
                    ten in
                    partnership with Caesars Entertainment across Las Vegas,
                    Atlantic
                    City, Baltimore, Lake Tahoe, and Kansas City. Our first
                    two
                    company-owned restaurants opened in Orlando and Chicago
                    in 2021, and
                    we recently announced plans for new restaurants in
                    Boston and Miami.
                </p>
            </div>
            <div class="ceo">
                <h2 class="title">Pham Tien Dat</h2>
                <img src="./image/about4.jpg" alt="Pham Tien Dat" />
                <p class="text" style="margin-left: -5px;">
                    Internationally renowned, multi-Michelin starred Chef
                    Gordon Ramsay
                    has opened a string of successful restaurants across the
                    globe, from
                    the UK and United States to France and Singapore. Gordon
                    is also an
                    international TV star, with shows that include Hell's
                    Kitchen,
                    MasterChef, MasterChef Junior, and Gordon Ramsay's
                    American Road
                    Trip.
                </p>
                <button class="btn-learn-more">Learn More</button>
            </div>
        </div>
        <div class="section3">
            <div class="image-wrapper">
                <img src="./image/about5.webp" alt="Pay It Forward" />
            </div>
            <div class="content">
                <h2 class="title">Pay It Forward</h2>
                <p class="text">
                    Internationally renowned, multi-Michelin starred Chef
                    Gordon Ramsay
                    has opened a string of successful restaurants across the
                    globe, from
                    the UK and United States to France and Singapore. Gordon
                    is also an
                    international TV star, with shows that include Hell's
                    Kitchen,
                    MasterChef, MasterChef Junior, and Gordon Ramsay's
                    American Road
                    Trip.
                </p>
                <p class="text">
                    Make-A-Wish creates life-changing wishes for children
                    with critical
                    illnesses, and through this partnership, we aim to
                    support the
                    cause.
                </p>
                <p>
                    As a proud partner of St. Jude Children's Research
                    Hospital, we
                    support the mission to lead the way the world
                    understands, treats,
                    and defeats childhood cancer and other life-threatening
                    diseases.
                </p>
                <button class="btn-about-wish">About Make-A-Wish</button>
                <br />
                <button class="btn-about-dat">About Pham Tien Dat</button>
            </div>
        </div>
        <div class="section4">
            <div class="content">
                <div class="description">
                    <h2 class="title4">Tins Dat In 10</h2>
                    <p class="text4">
                        Inspired by his popular YouTube series, Chef Ramsay
                        brings his
                        newest cookbook, Ramsay in 10. Learn tips and tricks
                        from
                        Michelin-starred Chef Gordon Ramsay and begin making
                        delicious
                        meals in just 10 minutes. Ramsay in 10 features 100
                        recipes like
                        grilled chicken, carbonara, and much more. Get yours
                        now.
                    </p>
                    <button class="btn-order-now">ORDER NOW</button>
                </div>
            </div>
            <div class="image-wrapper">
                <img src="./image/about6.jpg" alt="Tins Dat In 10" />
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="footer"></div>
    <script src="about-us.js"></script>


    <?php
        require_once 'footer.php'
    ?>
</body>

</html>