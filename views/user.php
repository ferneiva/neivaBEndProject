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

        <title><?=$user ["name"] ?></title>
    </head>
<body>
    <?php require ("templates/header.php"); ?>   
    <main>
        <div class="user-header">
            <?php
                if(empty($user["photo"]))
                {
            ?>
                    <img class="user-img" src="/images/nouserphoto.png" alt="user photo">    
            <?php
                }
                else{
            ?>
                <img class="user-img" src="/images/helpMysql/<?=$user["photo"]?>" alt="user photo">
            <?php
                }
            ?>
                <h1><?= $user["name"] ?></h1>
                
        </div>
            
        <div class="user-info">
                <ul class="user-list">
                    <?php
                        echo'
                            
                            <li><strong>Urban zone:</strong>&nbsp; ' . $user["urban_zone"] . '</li>
                            
                            <li><strong>City:</strong>&nbsp; ' . $user["city"] . '</li>
                            
                            <li><strong>Email:</strong>&nbsp; ' . $user["email"] . '</li>
                            
                            <li><strong>Phone:</strong>&nbsp; ' . $user["phone"] . '</li>
                            
                            <li><strong>Skills:</strong>&nbsp; ' . $user["skills"] . '</li>
                            
                            <li><strong>Resumé:</strong>&nbsp; ' . $user["resume"] . '</li>
                        ';
                    
                    ?> 
                </ul>
        </div>
        <div class="calendar-title">
            <h2>Calendar of available hours:</h2>
        </div>
        <div class="calendar-container">
            
        </div>
        <div class="reviews-title">
            <h2>Reviews:</h2>
            <div class="review-write">
                <form  method="POST" action="<?= ROOT ?>/user/<?=$user["user_id"]?>">
                    <div>
                        <label>
                            Rate this <?= $user["user_type"] ?>
                            <select name="rating">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="2">3</option>
                                <option value="2">4</option>
                                <option value="2">5</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        
                        <textarea name="reviewContent" placeholder="Your review" rows="1" cols="40" minlength="8" maxlength="65535"></textarea>
                        
                    </div>
                    <div>
                        <button  type="submit" name="send">Post</button>
                    </div>
                </form> 
            </div>
        </div>
        <section class="reviews-container">
            <ul class="reviews-list">
                <?php
                    if(empty($reviewsByUsers)){
                        echo'
                        <li class="user-review-bin">This User does not have reviews</li>
                        ';
                    }
                    else{
                        foreach($reviewsByUsers as $reviewByUser){
                            echo'
                                <li class="user-review-bin">
                                    <p>Name:&nbsp'.$reviewByUser["userReviewerName"].'</p>
                                    <p>User Type:&nbsp'.$reviewByUser["reviewerType"].'</p>
                                    <p>Review:&nbsp'.$reviewByUser["review_text"].'</p>
                                    <p>Rating:&nbsp'.$reviewByUser["rating"].'</p>
                                    <p>Review Date:&nbsp'.$reviewByUser["review_date"].'</p>
                                    
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
