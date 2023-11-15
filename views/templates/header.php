<header>
        <div class="logo">
        <a href="<?= ROOT ?>/"><img class="logo-img" src="/images/logo help 1.png" alt="HELP Logo" title="Logo"></a>
            
        </div>
        <nav>
            <ul class="ul-nav">
                <li><a href="<?= ROOT ?>/">Home</a></li>
                <li><a href="<?= ROOT ?>/info/">Info</a></li>
                
                <?php
                        if( isset($_SESSION["user_id"]) ){
                ?>
                        <li><a href="<?= ROOT ?>/useraccount/">My account</a></li>
                        <li><a href="<?= ROOT ?>/logout/">Log out</a></li>
                <?php
                        }
                        else {
                ?>
                        <li><a href="<?= ROOT ?>/login/">Login</a></li>
                        <li><a href="<?= ROOT ?>/register/">Register</a></li>
                <?php
                }
                ?>

            </ul>
        </nav>
</header>
