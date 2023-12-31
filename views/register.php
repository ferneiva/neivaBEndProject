<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fernando Neiva">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/register.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <title>HELP</title>
</head>

<body>
<?php require ("templates/header.php"); ?>
<main>
    <section class="header-container-register">
        <div class="register-header-bin">
            <h1>Create account, choose Client or Helper</h1>
            
            <p class="register">[If registered, <a class="link" href="<?= ROOT ?>/login/">log in here]</a></p>
        </div>
    </section>
    

    
    <section class="container-form-register">

        <?php
            if(isset($message)){
                echo '<p class="warning" role="alert"> ' .$message. ' </p>';
            }
        ?>
        <form id="help-client-form" method="post"   enctype="multipart/form-data">
            <div class="register-bin">
                <label>
                    Name
                    <input type="text" value="<?php echo isset($_POST["send"]) ? $_POST["name"] : ''; ?>" name="name" required minlength="3" maxlength="60">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    User Type; Choose Client or Helper
                    <select name="user_type">
                        <option value="client">client</option>
                        <option value="helper">helper</option>
                    </select>
                </label>
            </div>

            <div class="register-bin">
                <label>
                    Email
                    <input type="email" value="<?php echo isset($_POST["send"]) ? $_POST["email"] : ''; ?> " name="email" required>
                <label>
            </div>
            <div class="register-bin">
                <label>
                    Password
                    <input type="password" value="<?php echo isset($_POST["send"]) ? $_POST["password_confirm"] : ''; ?>" placeholder="Minimum 8 caracteres"  name="password_confirm" required minlenght="8" maxlength="1000">
                <label>
            </div>
            <div class="register-bin">
                <label>
                    Repeat Password
                    <input type="password" value="<?php echo isset($_POST["send"]) ? $_POST["password"] : ''; ?>" placeholder="Minimum 8 caracteres"  name="password" required minlenght="8" maxlength="1000">
                <label>
            </div>
            <div class="register-bin">
                <label>
                    Address
                    <input type="text" value="<?php echo isset($_POST["send"]) ? $_POST["address"] : ''; ?>" name="address" required minlength="8" maxlength="120">
                </label>
            </div >
            <div class="register-bin">
                <label>
                    Postal code
                    <input type="text" value="<?php echo isset($_POST["send"]) ? $_POST["postal_code"] : ''; ?>" name="postal_code" required minlength="4" maxlength="20">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Country
                    <select name="country">
    <?php
    foreach($countries as $country){
        $selected= $country["code"]==="PT" ? " selected" : "";
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
                    <input type="text" value="<?php echo isset($_POST["send"]) ? $_POST["city"] : ''; ?>" name="city" required minlength="3" maxlength="50">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Urban Zone (if none repeat city)
                    <input type="text" value="<?php echo isset($_POST["send"]) ? $_POST["urban_zone"] : ''; ?>" name="urban_zone" required minlength="3" maxlength="50">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Phone (optional)
                    <input type="text" value="<?php echo isset($_POST["send"]) ? $_POST["phone"] : ''; ?>" name="phone" minlength="9" maxlength="30">
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Skills (optional)
                    <textarea type="text" name="skills" placeholder="<?php echo isset($_POST["send"]) ? $_POST["skills"] : 'One or several of your abilities'; ?>" minlength="9" maxlength="200"></textarea>
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Resumé (optional)
                    <textarea type="text" name="resume" placeholder="<?php echo isset($_POST["send"]) ? $_POST["resume"] : 'Your curriculum'; ?>" minlength="9" maxlength="500"></textarea>
                </label>
            </div>
            <div class="register-bin">
                <label>
                    Photo (optional)
                    <input type="file" name="photo" accept="<?= implode(",", $allowed_formats) ?>">
                </label>
            </div>
            <div class="register-bin captcha">
                <div class="captcha-code">
                    <label for="captcha">Captcha Code</label>
                    <div class="captcha-cont"><?php echo $rand; ?></div>
                </div>
                <div class="captcha-write">
                    <label class="captcha-label">
                    Write Captcha
                    <input type="text" name="captcha" placeholder="Enter Captcha" required>
                    </label>
                    <input type="hidden"  name="captcha-rand" value="<?php echo $rand; ?>" >
                </div>
            </div>

            
            <div class="register-bin">
                <label>
                    <input type="checkbox" name="agrees" required>
                    I agree with terms and conditions
                </label>
            </div>
            <div class="large-button">
                <button type="submit" name="send">Sign in</button>
            </div>
        </form>
    </section>
</main>
<?php require ("templates/footer.php"); ?> 
</body>

</html>