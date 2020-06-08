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
            <div class='content-card'>
                    <div class='img'><img src='/Images/toolundertow.jpg' alt=''>
                        <span class='user'>Alexandru Ichim</span>
                        <span class='date'>23 martie 2020</span>
                    </div>
                    <div class='text'>
                        
                        <span class='action'>a ascultat <span class='musical-production'>Tool Undertow</span></span>
                        <span class='meta-data'>
                            <span class='album'>#undertow</span>
                            <span class='genre'>#prog-metal</span>
                            <span class='year'>#1991</span>
                        </span>
                    </div>
                    <div class='stats'>
                        <div class='stat'>
                            <div class='like-value'>32</div>
                        </div>
                        <div class='stat'>
                            <div class='comment-value'>32</div>
                        </div>
                    </div>
                    <div>
                        <span id="play" class="fa fa-play"></span>
                    </div>
            </div>
             <div class='content-card'>
                    <div class='img'><img src='/Images/revolver.jpg' alt=''>
                        <span class='user'>Alexandru Ichim</span>
                        <span class='date'>23 martie 2020</span>
                    </div>
                    <div class='text'>
                        
                        <span class='action'>a ascultat <span class='musical-production'>The Beatles - Eleanor Rigby </span></span>
                        <span class='meta-data'>
                            <span class='album'>#revolver</span>
                            <span class='genre'>#proto-psychedelic</span>
                            <span class='year'>#1967</span>
                        </span>
                    </div>
                    <div class='stats'>
                        <div class='stat'>
                            <div class='like-value'>3200</div>
                        </div>
                        <div class='stat'>
                            <div class='comment-value'>132</div>
                        </div>
                         <div id="commentsModal" class="modal">

                            <!-- Modal content -->
                            <div class="comments-modal-content">
                              <header>
                                  <span class='modal-user-name'>Alexandru Ichim</span>
                                  <span class='modal-date'><sup>23 martie</sup></span>
                                  <span class='modal-meta-data'>#the-beatles #john-lennon #paul-mccartney #ringo-star #george-harrison #1967 #proto-psychedelic #pop #violin #guitar #sitar #mono #stereo #36rpm</span>
                                  <span class='modal-action'>a ascultat</span>
                                  <span class='modal-musical-production'>The Beatles - Eleanor Rigby.</span>
                               </header>
                               <div class="comments-modal-main">
                               <p>Some text in the Modal..</p>
                               <p>Comment 1</p>
                               <p>Such a cool song</p>
                               <p>not my type but ok</p>
                               <p>cool song m8sdsadadasdasdasdasdasdasddasdasdbdhdshds    dfsdfsdfddsajdjsadsadkaskdaskdkaskdaskdkaskdkasnngjgdsgjds</p>
                               </div>
                              <footer>
                                  <form>
                                      <input type='text'>
                                  </form>
                              </footer>
                            </div>
                          
                    </div>
                </div>
             </div>
             <div class='content-card'>
                    <div class='img'><img src='/Images/master.jpg' alt=''>
                        <span class='user'>Alexandru Ichim</span>
                        <span class='date'>23 martie 2020</span>
                    </div>
                    <div class='text'>
                        
                        <span class='action'>a ascultat <span class='musical-production'>Metallica Orion</span></span>
                        <span class='meta-data'>
                            <span class='album'><a href=''>#master-of-puppets</a></span>
                            <span class='genre'><a href=''>#thrash-metal</a></span>
                            <span class='year'><a href=''>#1986</a></span>
                        </span>
                    </div>
                    <div class='stats'>
                        <div class='stat'>
                            <div class='like-value'>32</div>
                        </div>
                        <div class='stat'>
                            <div class='comment-value'>32</div>
                        </div>
                    </div>
            </div>
             <div class='content-card'>
                    <div class='img'><img src='/Images/pinkfloyd-the-wall.jpg' alt=''>
                        <span class='user'>Alexandru Ichim</span>
                        <span class='date'>23 martie 2020</span>
                    </div>
                    <div class='text'>
                        
                        <span class='action'>a ascultat <span class='musical-production'>Pink Floyd The Wall Part 3</span></span>
                        <span class='meta-data'>
                            <span class='album'><a href=''>#the-wall</a></span>
                            <span class='genre'><a href=''>#progressive-rock</a></span>
                            <span class='year'><a href=''>#1981</a></span>
                        </span>
                    </div>
                    <div class='stats'>
                        <div class='stat'>
                            <div class='like-value'>32</div>
                        </div>
                        <div class='stat' id='test-comm'>
                            <div class='comment-value'>32</div>
                        </div>
                    </div>
            </div>
             <div class='content-card'>
                    <div class='img'><img src='/Images/toolundertow.jpg' alt=''>
                        <span class='user'>Alexandru Ichim</span>
                        <span class='date'>23 martie 2020</span>
                    </div>
                    <div class='text'>
                        <span class='action'>a ascultat <span class='musical-production'>Tool Undertow</span></span>
                        <span class='meta-data'>
                            <span class='album'><a href=''>#undertow</a></span>
                            <span class='genre'><a href=''>#prog-metal</a></span>
                            <span class='year'><a href=''>#1991</a></span>
                        </span>
                    </div>
                    <div class='stats'>
                        <div class='stat'>
                            <div class='like-value'>32</div>
                        </div>
                        <div class='stat'>
                            <div class='comment-value'>32</div>
                        </div>
                    </div>
            </div>
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
                    <form>
                     <label for="export-as">Export as JSPF</label>
                     <button type='submit' name="export-as">
                        &#xf13a;
                     </button>
                     </form>
                </li>
            </ul>
            <ul class="reggae">
                <h3>Reggae</h3>
                <li>Bob Marley - No woman no cry</li>
                <li>Reggae shark</li>
                <li>UB 50 - Red wine</li>
                <li class='export-as'>
                    <form>
                     <label for="export-as">Export as JSPF</label>
                     <button type='submit' name="export-as">
                        &#xf13a;
                     </button>
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
                    <form>
                     <label for="export-as">Export as JSPF</label>
                     <button type='submit' name="export-as">
                        &#xf13a;
                     </button>
                     </form>
                </li>
            </ul>
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