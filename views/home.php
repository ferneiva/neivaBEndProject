<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fernando Neiva">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/home.css">
    <link rel="stylesheet" href="/styles/footer.css">

    <title>HELP</title>
</head>
<body>
<?php require ("templates/header.php"); ?>
    <main>
    <section class="search">
        <div class="search-bar">
            <form method="get" action="<?= ROOT ?>/search/">
                    <div class="search-area">
                        <div>
                            <label>
                                Search
                                <input type="text" name="search">
                            </label>
                        </div>
                        <div>
                            <button class="go" type="submit" name="submit">GO</button>
                        </div>

                    </div>
                        
                    <div class="search-comment">
                    Book helper for your house or let helper see your needs and contact you<br>
                            (input city or your urban zone)
                    </div>
            </form>
        </div>

    </section>
    

    <h1>List of last users:</h1>
    
        
        <ul class="users-area">
<?php
        foreach($users as $user){
            echo '
                
                <li class="user-bin">
                    <a href="' .ROOT. '/user/' .$user["user_id"] . '">
                    ' . $user["name"] . '
                    </a>
                    <div class="user-info">
                        <h2>User type:&nbsp;  ' .$user["user_type"]. ' </h2>
                        <h2>Country:&nbsp;   ' .$user["countryName"]. ' </h2>
                        <h2>Urban zone:&nbsp;   ' .$user["urban_zone"]. ' </h2>
                    </div>

                    
                </li>
                
            ';
        }
?>
        </ul>
        <div class="text">

        </div>
    </main>
    <?php require ("templates/footer.php"); ?>    
</body>
</html>