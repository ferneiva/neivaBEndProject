<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fernando Neiva">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/styles/home.css">
    <title>HELP</title>
</head>
    <body>
    <header>
        <div class="logo">
            <img class="logo-img" src="/images/logo help.png" alt="HELP Logo" title="Logo">
        </div>
        <nav>
            <ul class="ul-nav">
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="provider-register.html">Helper register</a></li> 
                <li><a href="provider-login.html">Helper login</a></li> 

            </ul>
        </nav>
    </header>
    <main>
    <div class="search-bar">
        <form method="post" action="<?= ROOT ?>/admin/products">
                <div class="search-area">
                    <div>
                        <label>
                            SEARCH
                            <input type="text" name="name">
                        </label>
                    </div>
                    <div>
                        <button class="go" type="submit" name="search">GO</button>
                    </div>

                </div>
                    
                <div class="search-comment">
                HERE YOU CAN FIND AND BOOK CLEANING LABORER FOR YOUR HOUSE<br>
                        (input city or your urban zone)
                </div>
        </form>
    </div>
    
        
        <ul class="providers-area">
<?php
        foreach($providers as $provider){
            echo '
                <li class="provider-box">
                    <a href="' .ROOT. '/providers/' .$provider["provider_id"] . '">
                        ' . $provider["name"] . '
                    </a>
                </li>
            ';
        }
?>
        </ul>
        <div class="text">

        </div>
        
    </main>    
    </body>
</html>