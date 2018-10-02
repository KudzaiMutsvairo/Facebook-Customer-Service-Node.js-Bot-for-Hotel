<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Orders</title>

    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <link href="../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader 
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="widgets/../../index.html">Hotel Assistant Dashboard</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrator</div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li>
                        <a href="../index.php">
                            <i class="material-icons"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="../pages/complaints.php">
                            <i class="material-icons"></i>
                            <span>Complaints</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="../pages/orders.php">
                            <i class="material-icons"></i>
                            <span>orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="../pages/stats.php">
                            <i class="material-icons"></i>
                            <span>Stats</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Complaints</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Orders
                            </h2>
                        </div>
                        <div class="body">
                           <?php
                                //include_once('mysqli_connect.php');
                                
                                DEFINE('DB_USER', 'id6063512_kudzie');
                                DEFINE('DB_PASSWORD', 'password123');
                                DEFINE('DB_HOST', 'localhost');
                                DEFINE('DB_NAME', 'id6063512_chatbotdb');


                                $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL ' . mysqli_connect_error());
                                

                                $query = "SELECT * FROM orders ORDER BY order_date DESC";

                                $response = @mysqli_query($dbc, $query);

                                if($response){
                                    echo '<table align="center" cellspapcing="60" cellpadding="30" width="700px">
                                        <tr><td align="left"><b>OrderID</b></td>
                                        <td align="left"><b>Date</b></td>
                                        <td align="left"><b>Time</b></td>
                                        <td align="left"><b>Room</b></td>
                                        <td align="left"><b>Order Items</b></td></tr>';

                                        while ($row = mysqli_fetch_array($response)) {
                                            echo '<tr><td align="center">' .
                                            $row['orderID'] . '</td><td align="left">'.
                                            $row['order_date'] . '</td><td align="left">'.
                                            $row['order_time'] . '</td><td align="left">'.
                                            $row['room'] . '</td><td align="left">'.
                                            $row['order_items'] . '</td>';
                                            echo '</tr>';
                                        }

                                    echo '</table>';
                                }else{
                                     echo "Couldnt issue database query";
                                     echo mysqli_error($dbc);
                                }

                                mysqli_close($dbc);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Body Copy -->
        </div>
    </section>

    <script type="text/javascript">
        var myVar = setInterval(myTimer, 120000);

        function myTimer() {
            location.reload(forceGet);
        }
    </script>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>