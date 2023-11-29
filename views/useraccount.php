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
    <link rel="stylesheet" href="/styles/register.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <link rel="stylesheet" href="/styles/useraccount.css">
    <script src="/script/useraccount.js" defer></script>


        <title><?=$user ["name"] ?></title>
    </head>
<body>
    <?php require ("templates/header.php"); ?>   
<main>
<?php
                if(isset($message1)){
                    echo '<p class="warning uaPosition" role="alert"> ' .$message1. ' </p>';
                }
            ?>
            <?php
                if(isset($message2)){
                    echo '<p class="notification uaPosition" role="alert"> ' .$message2. ' </p>';
                }
?>
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
                <div class="useraccount-header">
                    <h2 class="useraccount-header-1">My information page</h2>
                    <h2 class="useraccount-header-2">[Find and change personnal information]</h2>

                </div>
                
    </div>
        <div class="user-header redirect">
            <h2><a href="<?= ROOT ?>/user/<?=$user["user_id"]?>">Go to your User Account</a></h2>
            </div>
    
    <section class="container-form-register">

        <?php
            if(isset($message)){
                echo '<p class="warning" role="alert"> ' .$message. ' </p>';
            }
        ?>
        <form id="help-client-form" method="post" action="<?= ROOT ?>/useraccount/" enctype="multipart/form-data">
            <div class="register-bin">
                <label>
                    Name
                    <input type="text" name="name" value="<?= $user["name"]?>" required minlength="3" maxlength="60">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Email
                    <input type="email" name="email" value="<?= $user["email"]?>"required>
                <label>
            </div>
                <div class="register-bin">
                <label>
                    Address
                    <input type="text" name="address" value="<?= $user["address"]?>" required minlength="8" maxlength="120">
                </label>
            </div >
            <div class="register-bin">
                <label>
                    Postal code
                    <input type="text" name="postal_code" value="<?= $user["postal_code"]?>" required minlength="4" maxlength="20">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Country
                    <select name="country">
        <?php
        foreach($countries as $country){

        $selected= $country["code"]===$user["country"] ? " selected" : "";
        echo'
            <option value="' .$country["code"]. '" ' .$selected. '>' .$country["name"]. '</option>
                
        ';

        }
        ?>
                    </select> 
                </label>
            </div>
            <div class="register-bin">
                <label>
                    City
                    <input type="text" name="city" value="<?= $user["city"]?>" required minlength="3" maxlength="50">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Urban Zone (if none repeat city)
                    <input type="text" name="urban_zone"value="<?= $user["urban_zone"]?>" required minlength="3" maxlength="50">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Phone (optional)
                    <input type="text" name="phone" value="<?= $user["phone"]?>" minlength="9" maxlength="30">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Skills (optional)
                    <textarea type="text" name="skills" placeholder="<?php echo isset($_POST["change"]) ? $_POST["Skills"] : 'Your Skills'; ?>" minlength="9" maxlength="200"></textarea>
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Resumé (optional)
                    <textarea type="text" name="resume" placeholder="<?php echo isset($_POST["change"]) ? $_POST["resume"] : 'Your curriculum'; ?>" minlength="9" maxlength="500"></textarea>
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Photo (optional)
                    <input class="useraccount-input-photo" type="file" name="photo" accept="<?= implode(",", $allowed_formats) ?>">
                    <span class="useraccount-right-label"> (Max size 2MB)</span>
                </label>
            </div>
            <div class="large-button">
                <button type="submit" name="change">Change</button>
            </div>
        </form>
    </section>
    <!-- ++++++++++++++password changes +++++++++++++++++++++++++++++++ -->
    <section class="userAccount-cont">
        <div class="tab-selector">
            <h2 class="tab-selector-title" >Password change</h2>
            <h2  class="useraccount-header-1 pick">Open tab</h2>
        </div>
        
        <div class="passwordContainer hide">
            <?php
                if(isset($message1)){
                    echo '<p class="warning uaPosition" role="alert"> ' .$message1. ' </p>';
                }
            ?>
            <?php
                if(isset($message2)){
                    echo '<p class="notification uaPosition" role="alert"> ' .$message2. ' </p>';
                }
            ?>
            <!-- <form class="form-pass" method="post" action="<?= ROOT ?>/useraccount/"> -->
            <form class="form-pass" method="post" action="<?= ROOT ?>/useraccount/" >
                <div class="register-bin">
                    <label>
                        Current password
                        <input type="password" name="password" value="<?php echo isset($_POST["sendNpass"]) ? $_POST["password"] : ''; ?>" placeholder="Minimum 8 caracteres"   required minlenght="8" maxlength="1000">
                    </label>
                <div class="newpass-bin">
                    <div class="register-bin">
                        <label>
                            New password
                            <input type="password" name="newpass" value="<?php echo isset($_POST["sendNpass"]) ? $_POST["newpass"] : ''; ?>"placeholder="Minimum 8 caracteres" required minlenght="8" maxlength="1000">
                        </label>
                    </div>    
                    <div class="register-bin">
                        <label>
                            Repeat new password
                            <input type="password" name="newpassrepeat" value="<?php echo isset($_POST["sendNpass"]) ? $_POST["newpassrepeat"] : ''; ?>" placeholder="Minimum 8 caracteres" required minlenght="8" maxlength="1000">
                        </label>
                    </div>
                    <div class="large-button btn-pass">
                        <button type="submit" name="sendNpass">Change password</button>
                    </div>
                </div>
            </form>
            
            <div class="tab-selector closeTab">
                <h2 class="tab-selector-title" ></h2>
                <h2 id="binClose" class="useraccount-header-1 close">Close tab</h2>
            </div>
        </div>
        </div>
    </section>
    <section class="empty"></section>
    <!-- +++++++++++++++New section with email information+++++++++++++++++ -->
    <section class="userAccount-cont">

        <div class="tab-selector">
                <h2 class="tab-selector-title" >Contacts made</h2>
                <h2  class="useraccount-header-1 pick1">Open tab</h2>
        </div>
            
        <div class="passwordContainer1 emails-list hide">
            <ul class="emails-list">
            <?php
                if(empty($emailsByUser)){
                    echo'
                    <li class="user-review-bin email-bin bold">This User does not have emails</li>
                    ';
                }
                else{
                    foreach($emailsByUser as $email){
                        echo'
                            <li class="user-review-bin email-bin">
                                
                                <p>email Date:&nbsp'.date("d/m/y", strtotime($email["date"])).'</p>
                                <p>Subject:&nbsp'.$email["emailSubject"].'</p>
                                <p>User Type:&nbsp'.$email["userType"].'</p>
                                <p>Send To:&nbsp'.$email["receiverName"].'</p>
                                <p>Receiver Email:&nbsp'.$email["receiver_email"].'</p>
                                <p>Message:&nbsp'.$email["message"].'</p>
                            </li>    
                        ';
                    }
                }
            ?>
            </ul>




            <div class="tab-selector closeTab">
                <h2 class="tab-selector-title" ></h2>
                <h2 id="binClose1" class="useraccount-header-1 close">Close tab</h2>
            </div>    
        </div>
    </section>
    <section class="empty"></section>
</main>
    <?php require ("templates/footer.php"); ?> 
    <!-- <script src="/script/useraccount.js"></script> -->
</body>
</html>
    