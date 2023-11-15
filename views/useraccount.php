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
                <div class="useraccount-header">
                    <h2 class="useraccount-header-1">My account</h2>
                    <h2 class="useraccount-header-2">[Change any personnal information below and submit]</h2>
                </div>
                
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
                    <textarea type="text" name="skills" value="<?= $user["skills"]?>" placeholder="Your skills" minlength="9" maxlength="200"></textarea>
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Resumé (optional)
                    <textarea type="text" name="resume" value="<?= $user["resume"]?>" placeholder="Your curriculum" minlength="9" maxlength="500"></textarea>
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
</main>
    <?php require ("templates/footer.php"); ?> 
</body>
</html>
    