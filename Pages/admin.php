<!DOCTYPE html>
<html lang='en-US'>

<head>
    <meta charset='utf-8' name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='description' title='description' content='Musical metadata manager developed for educational purposes.' />
    <title>MuM</title>
    <link rel='stylesheet' type='text/css' href='admin1.css'>
    <link rel='stylesheet' type='text/css' href='fontawesome-free-5.12.1-web/css/all.css'>
    <link rel='icon' href='Images/1765391-music/svg/003-music.svg'>
</head>

<body>
    <?php
    include_once("Partials" . DIRECTORY_SEPARATOR . "auth-navbar-partial.php");
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
        <ul class="all-time">
            <h3>All time</h3>
            <li>
                The Beatles - Blackbird
            </li>
            <li>
                Tool - Schism
            </li>
            <li>
                2Pac - Changes
            </li>
            <li>
                2Pac - Dear mamma
            </li>
            <li class='export-as'>
                <label for="export-as">Export as</label>
                <form method="post">
                    <input type="submit" value="JSPF" />
                </form>
                <form method="post" action="export_pdf.php">
                    <input type="submit" name="generate_pdf" class="btn btn-success" value="PDF" />
                </form>
                <form method="post" action="export_csv.php">
                    <input type="submit" name="export" value="CSV" />
                </form>
            </li>
        </ul>
        <ul class="reggae">
            <h3>Reggae</h3>
            <li>Bob Marley - No woman no cry</li>
            <li>Reggae shark</li>
            <li>UB 50 - Red wine</li>
            <li class='export-as'>
                <label for="export-as">Export as</label>
                <form method="post">
                    <input type="submit" value="JSPF" />
                </form>
                <form method="post" action="export_pdf.php">
                    <input type="submit" name="generate_pdf" class="btn btn-success" value="PDF" />
                </form>
                <form method="post" action="export_csv.php">
                    <input type="submit" name="export" value="CSV" />
                </form>
            </li>
        </ul>
        <ul class="rock">
            <h3>Blues-Rock</h3>
            <li>Led Zeppelin - Since I've been loving you</li>
            <li>Rolling Stones - Miss you</li>
            <li>Cream - White Room</li>
            <li>Eric Clapton - Layla</li>
            <li>Eric Clapton - Tears in Heaven</li>
            <li class='export-as'>
                <label for="export-as">Export as</label>
                <form method="post">
                    <input type="submit" value="JSPF" />
                </form>
                <form method="post" action="export_pdf.php">
                    <input type="submit" name="generate_pdf" class="btn btn-success" value="PDF" />
                </form>
                <form method="post" action="export_csv.php">
                    <input type="submit" name="export" value="CSV" />
                </form>
              <!--Palalae Stefan-->
            </li>
        </ul>
    </section>
    <h2>My account</h2>
    <section class="administrare-cont">
        <section class="change-password">
            <form>
                <label class="main-label">Change your password</label>
                <label>Enter your password</label>
                <input type="password" name="current-password">
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
        <script src='/Pages/Javascript/generateContentCard.js'></script>
    </body>
</html>

<!--Alexandru Ichim-->
