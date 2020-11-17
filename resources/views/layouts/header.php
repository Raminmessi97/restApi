<!DOCTYPE html>
<html>
<head>
    <title>Welcome homme page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_MAIN; ?>node_modules/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo URL_MAIN; ?>resources/css/main.css">


</head>
<body>

        <header class="main_header">
			<div class="logo-of-site">
              <a href="<?php echo URL_MAIN;?>">
                <img src="<?php echo URL_MAIN; ?>resources/images/site-icon.png" alt="site-icon" class="icon-site-img"/>
              </a> 
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


            <div class="search-login">

                <?php if(isset($_COOKIE['logged_user'])){
                    $user = json_decode($_COOKIE['logged_user']);
                    $admin = $user->admin;
                    ?>
                    <a href="#" class="show_user_settings">User</a>
                    
                    <div class="user-settings modal-hidden"> 
                        <li><a href="<?php echo URL_MAIN; ?>user/cabinet">Cabinet</a></li>
                        <li><a href="<?php echo URL_MAIN; ?>user/logout">Logout</a></li>
                        <?php if($admin){?>
                             <li><a href="<?php echo URL_MAIN; ?>pelagus">Admin Panel</a></li>
                        <?php }?>
                    </div>


              <?php } ?>

                <?php if(!isset($_COOKIE['logged_user'])){?>
                    <div class="login-register">
                        <a href="<?php echo URL_MAIN; ?>login">Sign In</a>
                        <a href="<?php echo URL_MAIN; ?>register">Sign Up</a>
                     </div>
              <?php } ?>
            </div>
		</header>