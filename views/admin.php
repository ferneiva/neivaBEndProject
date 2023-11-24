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
        <script src="/script/user.js" defer></script>
        <title>Admin Login</title>
    </head>
    <body>
    <?php require ("templates/header.php"); ?>
    <main>
        <h1 class="adminForm">Administrator Login</h1>
        <form class="adminForm" method="post" action="<?= ROOT ?>/admin">
            <div class="admin-input">
                <label>
                    Email
                    <input type="text" name="email">
                </label>
            </div>
            <div class="admin-input">
                <label>
                    Password
                    <input type="text" name="password">
                </label>
            </div>
            <div class="admin-btn">
                <button type="submit" name="send">Login</button>
            </div>
        </form>
    </main>
    <?php require ("templates/footer.php"); ?>
    <body>
</html>