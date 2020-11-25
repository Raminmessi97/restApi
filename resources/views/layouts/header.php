<!DOCTYPE html>
<html>
<head>
    <title>Phenomenon's home page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_MAIN; ?>node_modules/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_MAIN; ?>resources/css/main.css">


</head>
<body>

        <header class="main_header">

            <div id="header_header">
    			<div class="logo-of-site">
                    <img src="<?php echo URL_MAIN; ?>resources/images/site-icon.png" alt="site-icon" class="icon-site-img"/>
                  <a href="<?php echo URL_MAIN;?>">
                    <h2>Блог Свободного Веб-разработчика</h2>
                  </a>
                </div>

            <div class="search-login">
                <?php if(isset($_COOKIE['logged_user'])){
                    $user = json_decode($_COOKIE['logged_user']);
                    $admin = $user->admin;
                    ?>
                    <button class="show_user_settings">User</button>
                    
                    <div class="user-settings modal-hidden"> 
                        <?php if($admin){?>
                             <li><a href="<?php echo URL_MAIN; ?>pelagus">Admin's Panel</a></li>
                        <?php }else{
                            ?>
                            <li><a href="<?php echo URL_MAIN; ?>user/cabinet">Cabinet</a></li>
                        <?php  }?>
                        <li><a href="<?php echo URL_MAIN; ?>user/logout">Logout</a></li>
                    </div>
              <?php } ?>
                <?php if(!isset($_COOKIE['logged_user'])){?>
                    <div class="login-register">
                        <a href="<?php echo URL_MAIN; ?>login">Sign In</a>
                        <a href="<?php echo URL_MAIN; ?>register">Sign Up</a>
                     </div>
              <?php } ?>
            </div>

            </div>

            <div class="menu">
                <ul>
                    <?php foreach($categories as $category){?>
                    <li><a href="<?php echo URL_MAIN; ?>category/<?php echo $category->route_name; ?>/">
                        <?php echo $category->name;?>
                    </a></li>
                    <?php } ?>
                </ul>
            </div>



		</header>