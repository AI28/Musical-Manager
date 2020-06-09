document.getElementById("playlist_name").innerHTML = val1;

$(document).ready(function () {
    createCookie("playlist_name", val1, "10");
  });
  
  function createCookie(name, value, days) {
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else {
      expires = "";
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
  }
  //Palalae Stefan