<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AJAX Example</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="Admin.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    function showPage(url) {
        $.ajax({
            url: url,
            success: function(result) {
                $("#content").html(result);
            }
        });
    }
    </script>

</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Vinegar Food Restaurant</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title"><a href="">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline" onclick="showPage('user.php')"></ion-icon>
                        </span>
                        <span class="title" onclick="showPage('user.php')">User</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline" onclick="showPage('feedback.php')"></ion-icon>
                        </span>
                        <span class="title" onclick="showPage('feedback.php')">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline" onclick="showPage('gallery.php')"></ion-icon>
                        </span>
                        <span class="title" onclick="showPage('gallery.php')">Gallery</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here" />
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="" />
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Sales</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$7,842</div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details" id="content">
            </div>

            <!-- ================= New Customers ================ -->
            <!-- <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer02.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    David <br />
                                    <span>Italy</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer01.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    Amit <br />
                                    <span>India</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer02.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    David <br />
                                    <span>Italy</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer01.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    Amit <br />
                                    <span>India</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer02.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    David <br />
                                    <span>Italy</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer01.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    Amit <br />
                                    <span>India</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer01.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    David <br />
                                    <span>Italy</span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                                <div class="imgBx">
                                    <img src="assets/imgs/customer02.jpg" alt="" />
                                </div>
                            </td>
                            <td>
                                <h4>
                                    Amit <br />
                                    <span>India</span>
                                </h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

            <!-- =========== Scripts =========  -->
            <script src="Admin.js"></script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>