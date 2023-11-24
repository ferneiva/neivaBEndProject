<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/styles/general.css">
        <link rel="stylesheet" href="/styles/header.css">
        <link rel="stylesheet" href="/styles/user.css">
        <link rel="stylesheet" href="/styles/admin.css">
        <link rel="stylesheet" href="/styles/adminpage.css">
        <link rel="stylesheet" href="/styles/footer.css">
        <script src="/script/adminpage.js" defer></script>
        <title>Admin Login</title>
    </head>
    <body>
    <?php require ("templates/header.php"); ?>

    <main>
        <section class="admin-head">
            <h1>Administrator Page</h1>
            
        </section>
        
        <section class="list users">
            <div class="list-open-close">
                <h2>List of Users:</h2>
                <button id="pick" type="button">Open/close</button>
            </div>
            <div class="list-users-ctn hide-list">
<?php
                foreach($users as $user){
                echo'

                <form method="post" action="<?= ROOT ?>/adminpage/" enctype="multipart/form-data">
                <div class="list-user-bin">
                    <label>
                        Name
                        <input type="text" name="name" value="<?= $user["name"]?>" required minlength="3" maxlength="60">
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Email
                        <input type="email" name="email" value="<?= $user["email"]?>"required>
                    <label>
                </div>
                    <div class="list-user-bin">
                    <label>
                        Address
                        <input type="text" name="address" value="<?= $user["address"]?>" required minlength="8" maxlength="120">
                    </label>
                </div >
                <div class="list-user-bin">
                    <label>
                        Postal code
                        <input type="text" name="postal_code" value="<?= $user["postal_code"]?>" required minlength="4" maxlength="20">
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Country
                        <select name="country">
                        <?php
                        foreach($countries as $country){

                        $selected= $country["code"]===$user["country"] ? " selected" : "";
                        
                            <option value="' .$country["code"]. '" ' .$selected. '>' .$country["name"]. '</option>
                        </select> 
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        City
                        <input type="text" name="city" value="<?= $user["city"]?>" required minlength="3" maxlength="50">
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Urban Zone (if none repeat city)
                        <input type="text" name="urban_zone"value="<?= $user["urban_zone"]?>" required minlength="3" maxlength="50">
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Phone (optional)
                        <input type="text" name="phone" value="<?= $user["phone"]?>" minlength="9" maxlength="30">
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Skills (optional)
                        <textarea type="text" name="skills" value="<?= $user["skills"]?>" placeholder="Your skills" minlength="9" maxlength="200"></textarea>
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Resumé (optional)
                        <textarea type="text" name="resume" value="<?= $user["resume"]?>" placeholder="Your curriculum" minlength="9" maxlength="500"></textarea>
                    </label>
                </div>
                <div class="list-user-bin">
                    <label>
                        Photo (optional)
                        <input class="useraccount-input-photo" type="file" name="photo" accept="<?= implode(",", $allowed_formats) ?>">
                        <span class="useraccount-right-label"> (Max size 2MB)</span>
                    </label>
                </div>
                <div class="large-button ap-btn">
                    <button type="submit" name="change">Change</button>
                </div>
                </form>
                ';
                }               
?>
            </div>


        </section>

        <section class="list contacts">
            <h2>List of Users mails (contacts made):</h2>
        </section>

        <section class="list messages">
        <h2>List of messages from homepage:</h2>

        </section class>
        <section class="list messages-reply">
            <h2>List of messages + replies:</h2>

        </section class>
        <section class="list messages-reply">
            <h2>Passwords recovery</h2>

        </section class>


    </main>
    <?php require ("templates/footer.php"); ?>
    <body>
</html>