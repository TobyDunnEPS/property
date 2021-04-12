<?php
    //session_start();
//echo $_SESSION['client'];
//echo $_SESSION['clientP'];
    //if ($_SESSION['client'] == null && $_SESSION['clientP'] == null) {
    //header("Location:login.php");
    //}
    /*session_start();

    // if($_SERVER['QUERY_STRING'] == 'noname') {
        unset($_SESSION['name']);
        session_unset();

    $name = $_SESSION['name'] ?? 'Guest';
    
    // get cookie
    $gender = $_COOKIE['gender'] ?? 'Unknown';*/
    //$name = $_SESSION['client'];
?>
<head>
    <title>Property Board</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
    .brand{
        background: #9cb7cb !important;
    }
    .brand-text{
        color: #9cb7cb !important;
    }
    form{
        max-width: 460px;
        margin: 20px auto;
        padding: 20px;
    }
    .property{
        width: 100px;
        margin:  40px auto -30px;
        display: block;
        position: relative;
        top: -30px;
    }  

    select{
        display:block;
        background:#fff;
        border:1px solid #ccc;
    }
    form{
        display: 100px;
        background: whitesmoke;
        border: 2px solid #ccc;
        margin: auto;
    }
    footer {
        margin: auto;
    }
      </style>


</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text" >Property Board</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <?php if(isset($name) and $name != 'reg' and $name != 'log'){ ?>
                <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?>  </li>
            <?php } ?>
               <!--  <li class="grey-text"> --> 
                    <!-- (<?php echo htmlspecialchars($gender); ?>)  -->
                <!-- </li> -->
                <?php if(isset($name) and $name != 'reg' and $name != 'log'){ ?>
                    <a href="add.php" class="btn brand z-depth-0"> Add Property</a>
                    <a href="logout.php" class="btn brand z-depth-0"> Logout</a>
                <?php } 
                    if ($name == 'reg') {
                            echo '<a href="login.php" class="btn brand z-depth-0">Login</a>'; 
                    } 
                    if ($name == 'log') 
                        {
                        echo '<a href="register.php" class="btn brand z-depth-0">Register</a>'; 
                        }
                    
                ?>
          <!-- <a href="#" class="d-block"></a> -->
          
        
                
            </ul>
        </div>
    </nav>
    

