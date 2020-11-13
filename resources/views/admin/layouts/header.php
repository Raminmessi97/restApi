<!DOCTYPE html>
<html>
<head>
    <title>Hi Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_MAIN; ?>node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_MAIN; ?>resources/css/main.css">
</head>
<body>

        <header class="main_header">
            <div class="admin_to_mainpage">
                 <a href="<?php echo URL_MAIN;?>">
                    <h1>Main Page</h1>
                 </a>
            </div>

            <div class="admin_logout">
                <a href="<?php echo URL_MAIN; ?>user/logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
           
        </header>