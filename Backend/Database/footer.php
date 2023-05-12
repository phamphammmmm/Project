<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
    /* Định dạng footer chung */
    body {
        padding: 0px;
    }

    footer {
        background-color: #333;
        padding: 40px 60px 20px 60px;
        text-align: center;
        font-size: 14px;
        color: white;
        border-top: 1px solid white;
        margin-top: 1px;
    }

    /* Định dạng tiêu đề h3 trong footer */
    footer h3 {
        font-size: 16px;
        color: white;
    }

    /* Định dạng đường dẫn trong footer */
    footer a {
        color: white;
        text-decoration: none;
    }

    /* Định dạng các cột trong footer */
    .foot-columns {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .cols-1,
    .cols-2,
    .cols-3,
    .cols-4 {
        flex-basis: 25%;
        margin-bottom: 20px;
        text-align: left;
    }

    /* Định dạng mẹo các cột trong footer */
    .cols-1 p,
    .cols-2 p,
    .cols-3 p,
    .cols-4 p {
        margin: 5px 0;
    }

    .mb-3 {
        padding: 10px 0px;
    }

    .form-control {
        background: #333;
        border: none;
    }

    /* Định dạng liên kết mạng xã hội trong footer */
    footer span a {
        margin-right: 10px;
    }

    .foot-columns li {
        text-align: left;
        margin-bottom: 15px;
    }

    .menu {
        list-style-type: none;
    }

    .submit-btn {
        border: 1px solid white;
        background: #333;
        color: white;
        padding: 10px;
    }

    input[type="text"i] {
        color: white;
        padding: 1px 2px;
        border-bottom: 1px solid white;
    }

    input[type="email"i] {
        color: white;

        padding: 1px 2px;
        border-bottom: 1px solid white;
    }

    ::placeholder {
        color: white;
    }

    .widget p {
        margin: 15px 0px 5px 0px;
    }
    </style>
</head>

<body>
    <footer class="nitro-offscreen">
        <div class="foot-columns">
            <div class="cols-1 col">
                <h3>Newsletter</h3>
                <div class="footer-form">
                    <form action="" method="post" name="nwsLetterForm" id="nwsLetterForm" novalidate="novalidate">
                        <div class="mb-3"> <input type="text" class="form-control" name="first_name" id="first_name"
                                placeholder="First Name*"> </div>
                        <div class="mb-3"> <input type="text" class="form-control" name="last_name" id="last_name"
                                placeholder="Surname*">
                        </div>
                        <div class="mb-3"> <input type="email" class="form-control" name="email_id" id="email_id"
                                placeholder="Email Address*">
                        </div>
                        <div class="mb-3">
                            <p> By signing up you are
                                agreeing to receive the latest news and
                                exclusive offers from our restaurants. </p>
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="btn-submit" class="submit-btn btn" id="btn-submit"
                                value="Sign Up">
                        </div>
                    </form>
                    <div class="newslatter-thanks" style="display:none;">Thank you for signing up to
                        our newsletter.</div>
                    <div class="captcha-msg1
                            error" style="display:none;"></div>
                </div>
            </div>
            <div class="cols-2 col">
                <section id="nav_menu-2" class="widget
                        widget_nav_menu">
                    <div class="menu-footer-menu1-container">
                        <ul id="menu-footer-menu1" class="menu">
                            <li id="menu-item-234" class="menu-item
                                    menu-item-type-post_type
                                    menu-item-object-page menu-item-234"><a href="contact.php">Contact Us</a>
                            </li>
                            <li id="menu-item-582" class="menu-item menu-item-type-post_type
                                    menu-item-object-page menu-item-582"><a
                                    href="https://sexyfish.com/careers/">Careers</a></li>
                            <li id="menu-item-236" class="menu-item
                                    menu-item-type-post_type
                                    menu-item-object-page menu-item-236"><a
                                    href="https://sexyfish.com/cookies-policy/">Cookie
                                    Policy</a></li>
                            <li id="menu-item-238" class="menu-item menu-item-type-post_type
                                    menu-item-object-page
                                    menu-item-privacy-policy menu-item-238"><a rel="privacy-policy"
                                    href="https://sexyfish.com/privacy-policy/">Privacy
                                    Policy</a></li>
                            <li id="menu-item-235" class="menu-item menu-item-type-post_type
                                    menu-item-object-page menu-item-235"><a
                                    href="https://sexyfish.com/the-caring-family-foundation/">The
                                    Caring Family Foundation</a></li>
                            <li id="menu-item-876" class="menu-item
                                    menu-item-type-custom
                                    menu-item-object-custom menu-item-876"><a
                                    href="https://sexyfish.com/wp-content/uploads/2023/03/MSA-POLICY-STATEMENT-CHL-Jan-2023.pdf">Responsibility</a>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
            <div class="cols-3
                    col">
                <section id="block-7" class="widget widget_block">
                    <h3 class="titles">Opening Hours</h3>
                    <p>SUNDAY - WEDNESDAY </p>
                    <span>12PM - 1AM</span>
                    <p>THURSDAY - SATURDAY </p>
                    <span>12PM - 2AM</span>
                </section>
            </div>
            <div class="cols-4 col">
                <section id="block-8" class="widget widget_block">
                    <h3 class="titles">Contact</h3>
                    <p>Sexy Fish</p>
                    <p>Berkeley Square House</p>
                    <p>London</p>
                    <p>W1J 6BR</p>
                    <p><a href="tel:+442037642000">+44 20 3764 2000</a></p>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p><a href="https://www.instagram.com/toiladatpham/" target="_blank">
                            <img decoding="async" alt="Instagram"
                                src="https://cdn-iahbj.nitrocdn.com/AuWhzipEJmCNRNXXhBuwyDlMRknoIvHI/assets/images/optimized/rev-858ec88/wp-content/themes/sexyfish/assets/images/icon-awesome-instagram.svg"></a>&nbsp;&nbsp;<a
                            href="https://www.facebook.com/sexyfishlondon" target="_blank">
                            <img decoding="async" alt="Facebook"
                                src="https://cdn-iahbj.nitrocdn.com/AuWhzipEJmCNRNXXhBuwyDlMRknoIvHI/assets/images/optimized/rev-858ec88/wp-content/themes/sexyfish/assets/images/icon-awesome-facebook.svg"></a>
                    </p>
                    </p>
                </section>
            </div>
        </div>
    </footer>
</body>

</html>