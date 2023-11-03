<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fernando Neiva">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/user.css">

        <!-- <title> <?= $user["name"] ?></title> -->
        <title><?=$users [0] ["name"] ?></title>
    </head>
<body>
    <?php require ("templates/header.php"); ?>   
    <main>
        <div class="user-header">
            <img class="user-img" src="<?= $user["photo"] ?>" alt="photo">
        
            <h1><?= $user["name"] ?></h1>
            
        </div>
            
        <div class="user-info">
                <ul class="user-list">
                    <?php
                        echo'
                            
                            <li><strong>Urban zone:</strong>&nbsp; ' . $user["urban_zone"] . '</li>
                            <br>
                            <li><strong>City:</strong>&nbsp; ' . $user["city"] . '</li>
                            <br>
                            <li><strong>Email:</strong>&nbsp; ' . $user["email"] . '</li>
                            <br>
                            <li><strong>Phone:</strong>&nbsp; ' . $user["phone"] . '</li>
                            <br>
                            <li><strong>Skills:</strong>&nbsp; ' . $user["skills"] . '</li>
                            <br>
                            <li><strong>Resumé:</strong>&nbsp; ' . $user["resume"] . '</li>
                        ';
                    
                    ?> 
                </ul>
        </div>
        <h3><strong>Calendar of available hours:</strong></h3>
        <div class="calendar-container">
            
        </div>
        <h3><strong>Reviews:</strong></h3>
        <section class="reviews-container">
            <ul class="reviews-list">
                <?php
                    if(empty($reviewsByUsers)){
                        echo'
                        <li>This User does not have reviews</li>
                        ';
                    }
                    else{
                        foreach($reviewsByUsers as $reviewByUser){
                            echo'
                                <li class="user-review-bin">
                                    <p>'.$ReviewsByUser["userReviewerName"].'</p>
                                    <p>'.$ReviewsByUser["user_type"].'</p>
                                    <p>'.$ReviewsByUser["review_text"].'</p>
                                    <p>'.$ReviewsByUser["rating"].'</p>
                                    <p>'.$ReviewsByUser["review_date"].'</p>
                                    
                                </li>
                            ';
                        }
                    }
                ?>
            </ul>
        </section>
    </main>
</body>
   
</html>
