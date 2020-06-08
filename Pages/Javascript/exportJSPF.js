/*
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
*/
cachedResponses =  [];
function asyncRequest(){
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.open("GET","/CContentGeneration/dummyFavouriteSongs");
    ajaxRequest.send();

    ajaxRequest.onload = function(){
        if(this.readyState == 4 && this.status == 200){
            var jsonResponse = JSON.parse(this.responseText);
            cachedResponses[jsonResponse.title] = this.responseText;
                 generateSongList(jsonResponse);
        }
        else console.log(this.responseText);
    }
}

function generateSongList(jsonResponse){
    var songList = document.createElement("ul");
    var listHeader = document.createElement("h3");
    songList.classList.add(jsonResponse.title);
    listHeader.textContent = jsonResponse.title;
    songList.appendChild(listHeader);
    for(var key in jsonResponse){
        if(key === 'track'){
            list_entry_text = jsonResponse[key].title+ " " +jsonResponse[key].creator;
            list_entry = document.createElement("li");
            list_entry.textContent = list_entry_text;
            songList.appendChild(list_entry);
        }
    }
    var export_li = document.createElement('li');
    export_li.classList.add('export-as');
    var export_form = document.createElement('form');
    var export_label = document.createElement('label');
    export_label.setAttribute('for','export-as');
    export_label.textContent = 'Export as JSPF';

    var export_button = document.createElement('button');
    export_button.setAttribute('type','submit');
    export_button.setAttribute('name','export-as');
    export_button.classList.add('export-btn');
    var button_id = listHeader.textContent + "-button";
    export_button.setAttribute('id',button_id);
    export_button.innerText='&#xf13a';
    export_form.appendChild(export_label);
    export_form.appendChild(export_button);
    export_li.appendChild(export_form);
    var body = document.getElementsByClassName('favourite-songs')[0];
    songList.appendChild(export_li);
    body.appendChild(songList);
}

function addButtonListeners(){
    //wrapping; tehnica prin care adaugam un event listener unei clase ce inglobeaza toate elementele html vizate
    // asadar, pt a adauga un event listener butoanelor de export jspf, adaugam un el clasei favourite-songs
   var wrapper =  document.querySelectorAll('.favourite-songs')[0];
   wrapper.addEventListener("click", handleClick);

   function handleClick(event){
       if(event.target.nodeName == 'BUTTON'){
           event.preventDefault();
           if(event.target.getAttribute('id')==='upload-playlist'){
               //upload playlist event
                var filePath = document.getElementById('upload-file').files[0];
                var formData = new FormData();
                formData.append('new_playlist', filePath, filePath.name);
                console.log(JSON.stringify(Object.fromEntries(formData)));
                var ajaxRequest = new XMLHttpRequest();
                ajaxRequest.open('POST','/CContentGeneration/uploadPlaylist');
                ajaxRequest.send(formData);
                ajaxRequest.onload = function(){
                    if(this.readyState == 4 && this.status == 200){
                        //Insert into DOM
                        var playlist = JSON.parse((JSON.parse(this.responseText).payload));
                        insertIntoDOM(playlist);
                    }
                }
            }
           else{
               //import playlist event
                console.log(event.target.getAttribute('id'));
                var filename = event.target.getAttribute('id').split('-')[0];
                download(filename+".jspf",cachedResponses[filename]);
           }
       }
   }

   function insertIntoDOM(jsonPlaylist){
        var new_playlist = document.createElement("ul");
        var playlist_name = document.createElement("h3");
        playlist_name.innerHTML = jsonPlaylist.title;
        new_playlist.appendChild(playlist_name);
        var playlist_creator = document.createElement("h3");
        playlist_creator.innerHTML = jsonPlaylist.creator;
        new_playlist.appendChild(playlist_creator);

        jsonPlaylist.track.forEach(function(element){
            var list_item = document.createElement("li");
            list_item.innerHTML = element.title + "-" + element.creator;

            new_playlist.appendChild(list_item);
        });
        var export_button = document.createElement("li");
        export_button.classList.add("fa");
        export_button.classList.add("fa-chevron-down");
        export_button.innerText = "Export as JSPF";
        new_playlist.appendChild(export_button);
        document.getElementsByClassName("favourite-songs")[0].appendChild(new_playlist);

   }

   function download(filename, text){
       var element = document.createElement('a');
       element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
       element.setAttribute('download', filename);

       element.style.display = 'none';
       document.body.appendChild(element);

       element.click();

       document.body.removeChild(element);
   }
}

//asyncRequest();
addButtonListeners();


//Alexandru Ichim