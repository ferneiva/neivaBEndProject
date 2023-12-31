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
                foreach($usersList as $user){

                echo'
                <div class="form-ctn">
                    <div class="status">
                        <p class="id">ID:<br>'.$user["user_id"].'</p>
                
                    <p class="blocked">
                ';
                    $blocked=($user["blocked"]==1) ? "blocked" : '';
                    
                echo'
                    '.$blocked.'</p>
                        
    	           </div>
                    <form class="form-list" method="post" action="/adminpage/" enctype="multipart/form-data">
                       
                    <input type="hidden"  name="user_id" value="'.$user["user_id"].'" >
                        <div class="list-user-bin">
                            <label>
                                Name
                                <input type="text" name="name" value="'.$user["name"].'" required minlength="3" maxlength="60">
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Email
                                <input type="email" name="email" value="'. $user["email"].'" required>
                            <label>
                        </div>
                            <div class="list-user-bin">
                            <label>
                                Address
                                <input type="text" name="address" value="'. $user["address"].'" required minlength="8" maxlength="120">
                            </label>
                        </div >
                        <div class="list-user-bin">
                            <label>
                                Postal code
                                <input type="text" name="postal_code" value="'. $user["postal_code"].'" required minlength="4" maxlength="20">
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Country
                                <select name="country">
                        ';
                        foreach($countries as $country){
                            $selected= $country["code"]==="US" ? " selected" : "";
                            echo'
                                <option value="' .$country["code"]. '" ' .$selected. '>' .$country["name"]. '</option>
                                    
                            ';
                            
                        }
                        var_dump($user["skills"]);
                        var_dump($user["resume"]);
                        var_dump($user["user_id"]);
                        echo'
                                </select> 
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                City
                                <input type="text" name="city" value="'. $user["city"].'" required minlength="3" maxlength="50">
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Urban Zone (if none repeat city)
                                <input type="text" name="urban_zone" value="'. $user["urban_zone"].'" required minlength="3" maxlength="50">
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Phone (optional)
                                <input type="text" name="phone" value="'. $user["phone"].'" minlength="9" maxlength="30">
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Skills (optional)
                                <textarea type="text" name="skills"  placeholder="'. $user["skills"].'" minlength="9" maxlength="200"></textarea>
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Resumé (optional)
                                <textarea type="text" name="resume"  placeholder="'. $user["resume"].'" minlength="9" maxlength="500"></textarea>
                            </label>
                        </div>
                        <div class="list-user-bin">
                            <label>
                                Photo (optional)
                                <input class="useraccount-input-photo" type="file" name="photo" accept="'. implode(",", $allowed_formats).'">
                                <span class="useraccount-right-label"> (Max size 2MB)</span>
                            </label>
                        </div>
                        <div class="large-button ap-btn">
                            <button type="submit" name="change">Change</button>
                        </div>
                    </form>
                ';
                echo'
                    <form class="form-block" method="post" action="/adminpage/">
                        <input type="hidden"  name="user_id" value="'.$user["user_id"].'" >
                        <button type="submit" name="block">
                            <div class="block-text">
                                <div>*</div>
                                <div>B</div>
                                <div>l</div>
                                <div>o</div>
                                <div>c</div>
                                <div>k</div>
                                <div>*</div>
                            </div>
                        </button>
                    </form>
                    <form class="form-block" method="post" action="/adminpage/">
                        <input type="hidden"  name="user_id" value="'.$user["user_id"].'" >
                        <button type="submit" name="unblock">
                            <div class="unblock-text">
                                <div>U</div>
                                <div>n</div>
                                <div>b</div>
                                <div>l</div>
                                <div>o</div>
                                <div>c</div>
                                <div>k</div>
                            </div>
                        </button>

                    </form>
                </div>
                
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