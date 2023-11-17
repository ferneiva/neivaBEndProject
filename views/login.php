<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fernando Neiva">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/login.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <title>Log in to your account</title>
</head>
<body>
<?php require ("templates/header.php"); ?>
<main>
    <div class="login-header">
        <h1>Login</h1>
    </div>
<div class="login-bin">
    <?php
    if(isset($message)){
        echo '<p class="alert" role="alert">' .$message. '</p>';

    }
    ?>
        <p>If not registered, <a class="link" href="<?= ROOT ?>/register/">please register here</a></p>
        <form method="post" action="<?= ROOT ?>/login/">
            <div>
                <label>
                    Email
                    <input type="email" name="email" required>
                <label>
            </div>
            <div>
                <label>
                    Password
                    <input type="password" name="password" required minlenght="8" maxlength="1000">

                <label>
            </div>
            <div class="general-button login-btn">
                <button type="submit" name="send">Login</button>
            </div>
        </form>
    </div>
</main>
<?php require ("templates/footer.php"); ?> 
</body>
</html>
