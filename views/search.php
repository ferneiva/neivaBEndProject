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
    <title>Search</title>
</head>
<body>
    <?php require ("templates/header.php"); ?>
    <main>
    <h1>Search results:</h1>
    
        
    <ul class="users-area">
<?php
    foreach($usersSearch as $userSearch){
        echo '
            
            <li class="user-bin">
                <a href="' .ROOT. '/user/' .$userSearch["user_id"] . '">
                ' . $userSearch["name"] . '
                </a>
                <div class="user-info">
                    
                    <h2><strong>User type: </strong>&nbsp;  ' .$userSearch["user_type"]. ' </h2>
                    <h2><strong>City:</strong>&nbsp;   ' .$userSearch["city"]. ' </h2>
                    <h2><strong>Urban zone:</strong>&nbsp;   ' .$userSearch["urban_zone"]. ' </h2>
                </div>

                
            </li>
            
        ';
    }
?>
    </ul>
    </main>
</body>
<?php require ("templates/footer.php"); ?> 
</html>
    