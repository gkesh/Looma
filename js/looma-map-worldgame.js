/*
*
LOOMA js code file
Filename: looma-maps-continents.js
Description: this file randomly chooses a continent and highlights it, then asks the user to name the continent. It checks if the user is right, then asks about a new continent.
*/

window.onload = function() {

    var answers = ["North America", "South America", "Europe", "Asia", "Africa","Australia", "Antartica", "Pacific Ocean",
    "Atlantic Ocean", "Indian Ocean", "Arctic Ocean"];
    var currentAnswerNum;
    var userGuess;
    var outputValue;

    var submitButton = document.getElementById("submit");
    submitButton.addEventListener('click', userInput);

    var nextButton = document.getElementById("next");
    nextButton.addEventListener('click', newQuestion);

    var userGuess = document.getElementById("userGuess");
    var txtOutput = document.getElementById("txtOutput");
    
    userGuess.addEventListener("change", function() {txtOutput.innerHTML = '';});
    
    //create new canvas
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");

    //map to reference
    var map = new Image();
    map.src = "../content/backgrounds/worldmap-game.gif";

    map.onload = function(){
        ctx.drawImage(map, 0, 0, 725, 380);
        generateQuestion();
    };
 
    function generateQuestion(){
        txtOutput.innerHTML = '';
        currentAnswerNum = Math.floor(Math.random() * answers.length);
        showMarker(answers[currentAnswerNum]);
        return false;
    }

    function newQuestion(){
        ctx.clearRect(0, 0, c.width, c.height);
        ctx.drawImage(map, 0, 0);
        txtOutput.innerHTML = '';
        generateQuestion();
        return false;

    }

    function showMarker(answer){
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.beginPath();
        switch(answer){
            case "North America":
                ctx.arc(180,100,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "South America":
                ctx.arc(250,230,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Europe":
                ctx.arc(400, 80,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Asia":
                ctx.arc(530, 80, 40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Africa":
                ctx.arc(400, 170,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Australia":
                ctx.arc(625, 250,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Antartica":
                ctx.arc(400, 350,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Pacific Ocean":
                ctx.arc(80,150,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Atlantic Ocean":
                ctx.arc(280,140,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Indian Ocean":
                ctx.arc(500, 200,40,0,2*Math.PI);
                ctx.stroke();
                break;
            case "Arctic Ocean":
                ctx.arc(370, 30,40,0,2*Math.PI);
                ctx.stroke();
                break;
        };
    };
    
    function userInput() {
        outputValue = "";
        var guess = userGuess.value;
        
        if (guess === answers[currentAnswerNum]) {
            outputValue = "<p>Correct!</p><p> It\'s " + answers[currentAnswerNum] + "</p>";
        }
        else {
            outputValue = "Incorrect < br> It's  ";
            outputValue = "<p>Incorrect!</p><p> It\'s " + answers[currentAnswerNum] + "</p>";
        }
        //outputValue = outputValue + answers[currentAnswerNum];
        txtOutput.innerHTML = outputValue;
        return false;
    }
};
