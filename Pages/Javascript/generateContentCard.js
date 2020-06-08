let database_views = [];
let previous_page_section = -1;

function generateDashboard(){
    console.log("true");
}

function asyncRequest(parameter="", method, endpoint, payload='', evt=null){

    var ajaxRequest = new XMLHttpRequest();
    console.log(parameter);
    if(parameter != '')
        ajaxRequest.open(method, endpoint+'/'+parameter);
    else ajaxRequest.open(method, endpoint);

    var actual_payload = (payload == null ? "" : payload)
    if(method == 'POST')
        ajaxRequest.send(payload);
    else ajaxRequest.send();

    ajaxRequest.onload = function(){
        if(this.readyState ===4 && this.status ===200){
            switch(endpoint){
                case "/CContentGeneration/getProductions":
                    (JSON.parse(this.responseText)).forEach(element => addContentCard(generateContentCard(element)));
                    break;
                case "/CContentGeneration/likeSong":
                    evt.target.parentNode.childNodes[0].innerText = JSON.parse(this.responseText).number_of_likes;
                    break;
            }
        }
        else console.log(this.responseText);
    }
}

function generateContentCard(jsonValues){

    var content_card = document.createElement("div");
    content_card.classList.add('content-card');

    var first_div = generateFirstDiv(jsonValues.artist_name, jsonValues.year);
    content_card.appendChild(first_div);
    var second_div = generateSecondDiv(jsonValues.artist_name, jsonValues.song_title, jsonValues.title, jsonValues.metadata_value, jsonValues.year);
    content_card.appendChild(second_div);

    var third_div = generateThirdDiv(jsonValues.number_of_likes);
    content_card.appendChild(third_div);
    content_card.appendChild(generateFourthDiv(jsonValues.artist_name, jsonValues.song_title));


    return content_card;


    function updateSongState(evt, firstOrderFunc){
        var action_div = evt.target.parentNode.parentNode.childNodes[1];
        var musical_production = ((action_div.childNodes[0].childNodes[1].innerHTML).split("-"));
        var to_be_jsonized = {
            artist_name: musical_production[0],
            song_title: musical_production[1]
        };

        firstOrderFunc(evt, JSON.stringify(to_be_jsonized));

    }
    function sendLike(evt, json_payload){

       asyncRequest('','POST','/CContentGeneration/likeSong', json_payload ,evt);  

    }

    function playSong(evt, json_payload){
        asyncRequest('','POST','/CContentGeneration/playSong', json_payload, evt)
    }

    function generateFourthDiv(artist_name, song_title){
        var fourth_div = document.createElement('div');
        var play_button = document.createElement('span');
        play_button.classList.add('fa');
        play_button.classList.add('fa-play');
        play_button.addEventListener("click", function(){updateSongState(event, playSong);});
        fourth_div.appendChild(play_button);
        return fourth_div; 
    }
    function generateThirdDiv(number_of_likes) {
        var third_div = document.createElement('div');
        third_div.classList.add('stats');
        like_value_span = document.createElement('span');
        like_value_span.id = 'listen-to';
        like_value_span.classList.add('stat');
        like_value_span.classList.add('like-value');
        like_value_span.appendChild(document.createTextNode(number_of_likes));
        like_value_span.addEventListener("click", sendLike)
        third_div.appendChild(like_value_span);
        comment_value_span = document.createElement('span');
        comment_value_span.classList.add('stat');
        comment_value_span.classList.add('comment-value');
        comment_value_span.appendChild(document.createTextNode(0));
        third_div.appendChild(comment_value_span);
        return third_div;
    }

    function generateSecondDiv(artist_name, song_title, title, metadata_value, year) {
        var second_div = document.createElement('text');
        second_div.classList.add('text');
        var action_span = document.createElement('span');
        var action_text = document.createTextNode("");
        action_span.appendChild(action_text);
        var musical_production_span = document.createElement('span');
        musical_production_span.classList.add('musical-production');
        var musical_production_text = document.createTextNode(artist_name+"-"+song_title);
        musical_production_span.appendChild(musical_production_text);
        action_span.appendChild(musical_production_span);
        var meta_data_span = document.createElement('span');
        meta_data_span.classList.add('meta-data');
        var album_span = document.createElement('span');
        album_span.classList.add('album');
        album_span.appendChild(document.createTextNode(title));
        var genre_span = document.createElement('span');
        genre_span.classList.add('genre');
        genre_span.appendChild(document.createTextNode(metadata_value));
        var year_span = document.createElement('span');
        year_span.classList.add('year');
        year_span.appendChild(document.createTextNode(year));
        meta_data_span.appendChild(genre_span);
        meta_data_span.appendChild(album_span);
        meta_data_span.appendChild(year_span);
        second_div.appendChild(action_span);
        second_div.appendChild(meta_data_span);
        return second_div;
    }

    function generateFirstDiv(artist_name, year) {
        var first_div = document.createElement('div');
        first_div.classList.add('img');
        var image = document.createElement('img');
        image.setAttribute('src', "");
        image.setAttribute('alt', '');
        var user_span = document.createElement('span');
        user_span.classList.add('user');
        user_span.textContent = artist_name;
        var date_span = document.createElement('span');
        date_span.classList.add('date');
        date_span.textContent = year;
        first_div.appendChild(image);
        first_div.appendChild(user_span);
        first_div.appendChild(date_span);
        content_card.appendChild(first_div);
        return first_div;
    }
}

function addContentCard(content_card){
    var main_content = document.getElementsByTagName('main')[0];
    main_content.appendChild(content_card);
}


asyncRequest(0, "GET", "/CContentGeneration/getProductions");
//Alexandru Ichim