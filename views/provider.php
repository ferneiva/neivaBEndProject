<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title><?= $provider["username"] ?></title>
    </head>
    <body>
        <main>
            <h1><?= $provider["name"] ?></h1>
            <div>
                <div>
                    <img src="<?= $provider["photo"] ?>" alt="PROV photo">
                </div>
                <div>
                    <ul>
                        <?php
                            echo'
                                <li>USERNANE: ' . $provider["username"] . '</li>
                                <br>    
                                <li>URBAN ZONE: ' . $provider["urban_zone"] . '</li>
                                <br>
                                <li>CITY: ' . $provider["city"] . '</li>
                                <br>
                                <li>EMAIL:' . $provider["email"] . '</li>
                                <br>
                                <li>PHONE: ' . $provider["phone"] . '</li>
                                <br>
                                <li>SKILLS: ' . $provider["skills"] . '</li>
                                <br>
                                <li>RESUMÉ: ' . $provider["resume"] . '</li>
                            ';
                        
                        ?> 
                    </ul>
                
                </div>

                
            </div>
        </main>
    </body>
   
</html>
