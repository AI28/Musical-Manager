<!DOCTYPE html>
<html lang='en-US'>
    <head>
        <meta charset='utf-8' name="viewport" 
        content= "width=device-width, initial-scale=1.0">
        <meta name='description' title='description' content='Musical metadata manager developed for educational purposes.'/>
        <title>MuM</title>
        <link rel='stylesheet' type='text/css' href='/Pages/index.css'>
        <link rel='stylesheet' type='text/css' href='fontawesome-free-5.12.1-web/css/all.css'>
        <link rel='icon' href='/Images/1765391-music/svg/003-music.svg'>
    </head>
    <body>
        <?php
            if(isset($_COOKIE['jwt_token'])===TRUE){
                include_once("Partials".DIRECTORY_SEPARATOR."auth-navbar-partial.php");
            }
            else include_once("Partials".DIRECTORY_SEPARATOR."non-auth-navbar-partial.html");
        ?>
        <!--Am decis ca pentru elementele statice ale paginii, care nu se vor schimba pe parcursul utilizarii aplicatiei web, sa folosesc php pt generare.
            (ex. navbarul auth vs non auth)
            Cealalta metoda la care m-am gandit este de a folosi tot api-ul aplicatiei pt generarea navbarului, preluand printr-o cerere asincrona
            un json care contine informatii despre sesiune; avantaj: uniformitate in implementare;
            dezavantaj: implementare mai complexa + cereri suplimentare( initial se preia pagina, dupa care se preia jsonul cu informatii despre sesiune)
            Concluzie: continut care nu se modifica: generat pe partea de server
                       continut care se modifica generat pe partea de client-->
        <main>
            <div id='artists'>
            </div>
            <div id='albums'>
            </div>
            <div id='songs'>
            </div>
        </main>
        <script src='/Pages/Javascript/modal.js'></script>
        <script src='/Pages/Javascript/stickyNav.js'></script>
        <script src='/Pages/Javascript/generateContentCard.js'></script>
    </body>
</html>

<!--Alexandru Ichim--> 