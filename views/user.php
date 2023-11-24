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
    <link rel="stylesheet" href="/styles/footer.css">
    <script src="/script/user.js" defer></script>

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
                <div class="user-header-rating">
                    <h2>Rating:&nbsp;<?=round($userAvgReview["userAverageRating"],1)?>/5</h2>
                </div>
                <div class="user-header-type">
                    <h2>User Type:&nbsp; <?=$user["user_type"]?></h2>
                </div>
                
        </div>
        <?php
            if(isset($_SESSION["user_id"])){
            ?>
                <div class="user-header">
                
                    <?php
                    //  print_r($sessionUser["name"]);
                        $subjectMail="Email from a Help User " .$sessionUser["name"] .  " that wants to contact You";
                        $mailStandardMessage="<br>Please contact User name; " .$sessionUser["name"] .
                        ", email; " .$sessionUser["email"].  " phone nr; " .$sessionUser["phone"]. " that is interested on your available slots.";
                        // $destinationMail=$user["email"]; used a real mail:
                        $destinationEmail="fernandojnfalmeida@gmail.com";
                        $receiverEmail=$user["email"];
                    ?>
                    <form id="user-send-mail" method="post">    
                        <div class=sent-mail>
                            <div class="mail-title">
                                <h2>Notify User to enter in contact</h2>
                            </div>
                            <div class="hidden-mail-inputs">
                                
                               
                                <input type="text" name="name" id="name" value="<?=$sessionUser["name"]?>">
                                <input type="email" name="email" id="email" value="<?=$receiverEmail?>">
                                
                                <input type="text" name="message" value="<?=$mailStandardMessage?>">
                                <input type="hidden" name="receiver_email" value="<?=$destinationEmail?>">

                            </div>
                            <div class="mail-btn">
                                <button class="go" type="submit" >Send Contact</button>
                            </div>
                        </div>
                        <?php
                        if (!empty($msg)) {
                        echo "<h2 class='notification position'>$msg</h2>";
                        }
                        ?>
                        <div class="mail-note">
                                <h3>[User will receive an email with your interest and contacts]</h3>
                        </div>
                    </form>        
                </div>
            <?php
            }
            ?>
        <div class="user-info">
                <ul class="user-list">
                    <?php
                        echo'
                            
                            <li><strong>Urban zone:</strong>&nbsp; ' . $user["urban_zone"] . '</li>
                            
                            <li><strong>City:</strong>&nbsp; ' . $user["city"] . '</li>
                            
                            <!-- <li><strong>Email:</strong>&nbsp; ' . $user["email"] . '</li>
                            
                            <li><strong>Phone:</strong>&nbsp; ' . $user["phone"] . '</li>-->
                            
                            <li><strong>Skills:</strong>&nbsp; ' . $user["skills"] . '</li>
                            
                            <li><strong>Resumé:</strong>&nbsp; ' . $user["resume"] . '</li>
                        ';
                    
                    ?> 
                </ul>
                
        </div>
        <div class="calendar-title">
            <h2>Available hours:</h2>
        </div>
        <div class="calendar-container">
            <img class="agenda-img" src="/images/agendahelp1.png" alt="agenda photo">    
        </div>
        <div class="reviews-title">
            <h2>Reviews:</h2>
            <?php
            if(isset($_SESSION["user_id"])){
            ?>
                <div class="review-write">
                    <form  method="POST" action="<?= ROOT ?>/user/<?=$user["user_id"]?>">
                        <div>
                            <label>
                                Rate this <?= $user["user_type"] ?>
                                <select name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </label>
                        </div>
                        <div>
                            
                            <textarea name="reviewContent" placeholder="Your review" aria-label="review-content"
                            rows="1" cols="40" minlength="3" maxlength="65535"></textarea>
                            
                        </div>
                        <div>
                            <button  type="submit" name="send">Post</button>
                        </div>
                    </form> 
                </div>
            <?php
            }
            ?>
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
                                <li class="user-review-bin" data-review_id="'.$reviewByUser["review_id"].'">
                                    
                                    <p>Name:&nbsp'.$reviewByUser["userReviewerName"].'</p>
                                    <p>User Type:&nbsp'.$reviewByUser["reviewerType"].'</p>
                                    <p>Review Date:&nbsp'.date("d/m/y", strtotime($reviewByUser["review_date"])).'</p>
                                    <p>Rating:&nbsp'.$reviewByUser["rating"].'</p>
                                    <p>Review:&nbsp'.$reviewByUser["review_text"].'</p>
                                    
                            ';
                                    if(isset($_SESSION["user_id"]) && $_SESSION["user_id"]==$reviewByUser["reviewerID"]){
                                        echo'
                                            <div class="review-delete">
                                            <button class="user-delete-btn" type="button"
                                                
                                                name="deleteReview" aria-label="delete-review">Delete review </button>
                                                <!--
                                                <button class="user-delete-btn" type="button"
                                                data-review_id="'.$reviewByUser["review_id"].'"
                                                name="deleteReview">Delete review </button>
                                                -->
                                            </div>
                                </li>
                                        ';
                                }
                        }
                    }
                ?>
            </ul>
        </section>
    </main>
    <?php require ("templates/footer.php"); ?> 
</body>
   
</html>
