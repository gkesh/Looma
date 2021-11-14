//'use strict';

window.onload = function () {
    
    document.getElementById("back").onclick = function() {parent.history.back();};

var $previews = $('#previews');
var count = 0;
for (var i = 0; i < localStorage.length; i++) {
  var key = localStorage.key(i);
  if (key.startsWith("LOOMA_")) {
    count++;
    var link = document.createElement("a");
    link.href = "looma-paint.php#" + key;
    var img = new Image();
    img.src = 'data:image/svg+xml;base64,' + btoa(localStorage.getItem(key));
    //img.width = 200;
    //img.height = 200;
    var button = document.createElement("button");

       button.innerHTML =
              "<span class='english-keyword' " +
            "data-toggle='tooltip' " +
            "data-placement='top' " +
            "title='मेटाउन'>" +
            "Erase</span>" +
            "<span class='native-keyword' hidden " +
            "data-toggle='tooltip' " +
            "data-placement='top' " +
            "title='Erase'>" +
            "मेटाउन</span>";


    with ({k: key}) {
      button.onclick = function(e) {
        e.preventDefault();
        function erase() {
            console.log('in paint-openfile, erasing ', k);
            localStorage.removeItem(k);
            window.location = ""; //reloads the current page
          };
        LOOMA.confirm("Are you sure you want to erase this drawing?", erase, function(){return;});
      };
    }
    link.appendChild(button);
    link.appendChild(img);
    $previews.append(link);
  }
  else {
    console.log("Rejected: " + key);
  }
}
if (count == 0) {
  previews.innerHTML = "You don't have any old drawings." +
  " Click on the button to go back to the whiteboard.";
}
};
