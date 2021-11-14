//Author: Sasha and Lily
// modified by Mahir
//Description: Generates vocabulary words corresponding to the selected cookies.  Advances the flashcards by loading a new word on the next or previous card.

'use strict';

var frontShowing = true;
var index = 0;
var count;  //number of words returned from wordList()
var vocabGrade = '';
var vocabSubject = '';
var vocabCount = 75;
var vocabCh_id = '';
var vocabRandom = 'true';
var list;
var word;


//Reads the cookies in order to generate the word list
function init() {
    
    vocabGrade =   $('#params').data('class');
    vocabSubject = $('#params').data('subject');
    vocabCh_id =   $('#params').data('ch_id');
    
    console.log('grade is: ', vocabGrade, ' subj is ', vocabSubject, ' ch_id is ', vocabCh_id);
    
    document.getElementById("next").addEventListener("click", next);
    document.getElementById("prev").addEventListener("click", prev);
    
    $('.stage').on('click', function () {
        $('.stage').toggleClass('flipped');
        frontShowing = !frontShowing;
    }); //end flashcard onclick function
    
    // SPEAK button will say the word, unless text is selected, in which case, it will speak the selected text
    $('button.speak').off("click").click(function () {
        var selectedString = document.getSelection().toString();
        var defaultString;
        if (frontShowing) defaultString = document.getElementById('wordFront').textContent.toString();
        else defaultString = document.getElementById('definition').textContent.toString();
        
        var toSpeak = (selectedString ? selectedString : defaultString);
        console.log('VOCAB: speaking ', toSpeak);
        LOOMA.speak(toSpeak);
    }); //end speak button onclick function
    
    // vocabGrade =   LOOMA.readStore("vocab-grade",   'session'); if (!vocabGrade) vocabGrade = "class1";
    // vocabSubject = LOOMA.readStore("vocab-subject", 'session'); if (!vocabSubject) vocabSubject = "english";
    // vocabCount =   LOOMA.readStore("vocab-count",   'session'); if (!vocabCount) vocabCount = "25";
    // vocabRandom =  LOOMA.readStore("vocab-random",  'session'); if (!vocabRandom) vocabRandom = "true";
    // vocabCh_id = '';
    
        LOOMA.wordlist(vocabGrade, vocabSubject, vocabCh_id, vocabCount, vocabRandom, succeed, fail);
}

//If it fails, it alerts the user and describes the failure
function fail(jqXHR, textStatus, errorThrown) {
    //alert("enter function fail");
    console.log('VOCAB: AJAX call to dictionary-utilities.php FAILed, jqXHR is ' + jqXHR.status);
    window.alert('failed with textStatus = ' + textStatus + ', and errorThrown = ' + errorThrown);
}

//Generates the next card with the front word and corresponding back information
function succeed(result) {
    console.log('VOCAB: success getting word list');
    //$('#wordlist-output').text(result);
    //$('#nepali-output').text(result.np);
    //$('#defn-output').text(result.def);
    //if (result.img) $('#img-output').html('<img src="' + result.img + '>');
    if (result) {
        list = result;
        count = list.length;
        console.log('got ' + count + ' words');
    
        if (count > 0) {
            word = list[index];
            console.log('VOCAB: looking up ' + word['en']);
            show(word['en']);
        }
    }
    //LOOMA.lookup(word, gotAWord, fail);
}

function found (def) {
    $('#wordFront').html($(def).find('#english').clone().text());
    $('.back').html(def);
};

function show(word) {
    LOOMA.define(word, found, fail);
} //end SHOW()

//Once a word is generated, generate corresponding backside and put it on back of card
function gotAWord(definition) {
    document.getElementById("wordFront").innerHTML = word;
    document.getElementById("nepaliBack").innerHTML = definition.np;

// Clean up the definition for display - italicize 'part of speech'
    var def = definition.def;
    definition.def = definition.def.replace('pronoun', '<i>pronoun</i>');
    definition.def = definition.def.replace('preposition', '<i>preposition</i>');
    definition.def = definition.def.replace('noun', '<i>noun</i>');
    definition.def = definition.def.replace('verb', '<i>verb</i>');
    definition.def = definition.def.replace('adj.', '<i>adjective</i>');
    definition.def = definition.def.replace('adverb', '<i>adverb</i>');
    definition.def = definition.def.replace('adv.', '<i>adverb</i>');
    
    if (definition.def.includes('dictionary.reference.com')) definition.def = 'Definition not found';
    
    //the dictionary defines derivative forms with "plural of", "past tense of", etc. and has an entry "rw" for the root word
    // here we reconstruct the definition by combining the generic phrase with the root word from the dictionary
    //
    //NOTE: in the future, should go the dictionary one more time and get the definition of the ROOT WORD
    //
    if (definition.def == 'plural of') definition.def = definition.def + ' ' + definition.rw;
    else if (definition.def == 'past tense of') definition.def = definition.def + ' ' + definition.rw;
    else if (definition.def == 'past perfect tense of') definition.def = definition.def + ' ' + definition.rw;
    else if (definition.def == 'progressive form of') definition.def = definition.def + ' ' + definition.rw;
    else if (definition.def == 'past and past perfect tense of') definition.def = definition.def + ' ' + definition.rw;
    else if (definition.def == 'third person singular of') definition.def = definition.def + ' ' + definition.rw;

//Change the font size according to definition length.  If definition is too long, chop it off accordingly
    
    if (definition.def.length < 144) {
        $('#largeWordBack').show();
        document.getElementById("largeWordBack").innerHTML = definition.def;
        $('#mediumWordBack').hide();
        $('#smallWordBack').hide();
    }
    
    else if (definition.def.length >= 144 && definition.def.length < 240) {
        $('#largeWordBack').hide();
        $('#mediumWordBack').show();
        document.getElementById("mediumWordBack").innerHTML = definition.def;
        $('#smallWordBack').hide();
    }
    
    
    else if (definition.def.length >= 240 && definition.def.length < 750) {
        $('#largeWordBack').hide();
        $('#mediumWordBack').hide();
        $('#smallWordBack').show();
        document.getElementById("smallWordBack").innerHTML = definition.def;
    }
    
    else {
        $('#largeWordBack').hide();
        $('#mediumWordBack').hide();
        document.getElementById("smallWordBack").innerHTML = definition.def.substring(0, 750);
    }
    //document.getElementById("img-output").src = "images/apple.jpg";
    document.getElementById("rootWord").innerHTML = "";
    document.getElementById("rwNepali").innerHTML = "";
    document.getElementById("rwDefinition").innerHTML = "";
    if (definition.rw != '') {
        LOOMA.lookup(definition.rw, gotARootWord, fail);
    }
    
}

function gotARootWord(definition) {
    /*

    */
    //document.getElementById("definition").appendChild(newElement);
    var def = definition.def;
    if (def.includes('dictionary.reference.com')) def = 'Definition not found';
    //the dictionary defines derivative forms with "plural of", "past tense of", etc. and has an entry "rw" for the root word
    // here we reconstruct the definition by combining the generic phrase with the root word from the dictionary
    //
    //NOTE: in the future, should go the dictionary one more time and get the definition of the ROOT WORD
    //
    //This gets the word's nepali translation and displays it in the HTML
    var rwDisplayWord = document.getElementById("rootWord");
    var rwupperEnglishWord = definition.en.toUpperCase();
    rwDisplayWord.textContent = rwupperEnglishWord;
    var rwnp = document.getElementById("rwNepali");
    rwnp.textContent = definition.np;
    var rwdef = document.getElementById("rwDefinition");
    rwdef.textContent = def;
    event.preventDefault();
}// end of gotARootWord

//If it fails, it alerts the user and describes the failure

/*
function fail(jqXHR, textStatus, errorThrown)
{
    alert("enter function fail");
    console.log('VOCAB: AJAX call to dictionary-utilities.php FAILed, jqXHR is ' + jqXHR.status);
    window.alert('failed with textStatus = ' + textStatus);
    window.alert('failed with errorThrown = ' + errorThrown);
}

//Generates the next card with the front word and corresponding back information
function succeed(result)
{
    console.log('VOCAB: success getting word list');
    //$('#wordlist-output').text(result);
    //$('#nepali-output').text(result.np);
    //$('#defn-output').text(result.def);
    //if (result.img) $('#img-output').html('<img src="' + result.img + '>');
    list = result;
    word = list[index];
    console.log('VOCAB: looking up ' + word);
    LOOMA.lookup(word, gotAWord, fail);
}
*/

//If the current face is the backside, the card will be flipped to show the front of the next card. Otherwise, the new front will show.  The 'next' arrow will not be displayed on the last word card.
function next() {
    if (index < count - 1) {
        index++;
        word = list[index];
        show (word['en']);
        //LOOMA.lookup(word, gotAWord, fail);
    }
    document.getElementById("prev").style.visibility = 'visible';
    if (index >= count - 1) {
        document.getElementById("next").style.visibility = 'hidden';
        document.getElementById("prev").style.visibility = 'visible';
    }
    else {
        document.getElementById("next").style.visibility = 'visible';
        document.getElementById("prev").style.visibility = 'visible';
    }
    if (!frontShowing) {
        $('.stage').toggleClass('flipped');
        frontShowing = true;
    }
}

//Returns to the front face of the previous word.  The 'prev' arrow will not be displayed on the first card.
function prev() {
    if (index > 0) {
        index--;
        word = list[index];
        show (word['en']);
        //LOOMA.lookup(word, gotAWord, fail);
    }
    if (index == 0) {
        document.getElementById("prev").style.visibility = 'hidden';
        document.getElementById("next").style.visibility = 'visible';
    }
    else {
        document.getElementById("prev").style.visibility = 'visible';
        document.getElementById("next").style.visibility = 'visible';
    }
    if (!frontShowing) {
        $('.stage').toggleClass('flipped');
        frontShowing = true;
    }
}

//window.onload = init;
$(document).ready (init);
