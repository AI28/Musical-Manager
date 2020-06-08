<!DOCTYPE html>
<html lang='en-US'>
    <head>
        <meta charset='utf-8' name="viewport" 
        content= "width=device-width, initial-scale=1.0">
        <meta name='description' title='description' content='Musical metadata manager developed for educational purposes.'/>
        <title>MuM</title>
        <link rel='stylesheet' type='text/css' href='admin1.css'>
        <link rel='stylesheet' type='text/css' href='fontawesome-free-5.12.1-web/css/all.css'>
        <link rel='icon' href='Images/1765391-music/svg/003-music.svg'>
    </head>
    <body>
        <?php
        include_once("Partials".DIRECTORY_SEPARATOR."auth-navbar-partial.php");
        ?>
        <h2>My listening history</h2>
        <main>
        </main>
        <h2>My favourite songs</h2>
        <section class="favourite-songs">
            <form id='upload'>
                <label>Upload a new playlist.</label>
                <input type="file" id='upload-file'>
                <button type='submit' id='upload-playlist'>Upload</button>
            </form>
        </section>
        <h2>My account</h2>
        <section class="administrare-cont">
            <section class="change-password">
                <form>
                    <label class="main-label">Change your password</label>
                    <label>Enter your password</label>
                    <input type="password" name="current-password" >
                    <label>Enter a new password</label>
                    <input type="password" name="new-password">
                    <label>Cofirm password</label>
                    <input type="password" name="2nd-new-password">
                    <input type="submit" value="&#xf04e">
                </form>
            </section>
            <section class="change-username">
                <form>
                <label class="main-label">Change your username</label>
                   <label>Enter your password</label>
                   <input type="password" name="current-password">
                   <label>Enter your new username</label>
                   <input type="text" name="new-username">
                   <input type="submit" value="&#xf04e">
                </form>
            </section>
            <section class="change-profile-pic">
                <form>
                    <label class="main-label">Change your profile picture</label>
                    <label>Enter your password</label>
                    <input type="password" name="password">
                    <input type="file" name="picture-local-uri">
                    <input type="submit" value="&#xf093;">
                </form>
            </section>
            <section class="remove-account">
                <form>
                <label class="main-label terminate-account-label">Terminate your account</label>
                <label>Enter your password</label>
                <input type="password" name="current-password">
                <input type="submit" value="&#xf00d" id="terminate-account">
                </form>
            </section>
        </section>
        <script src='/Pages/Javascript/modal.js'></script>
        <script src='/Pages/Javascript/stickyNav.js'></script>
        <script src='/Pages/Javascript/exportJSPF.js'></script>
    </body>
</html>

<!--Alexandru Ichim--> 