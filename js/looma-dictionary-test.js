/*
 * Name: Skip

Owner: VillageTech Solutions (villagetechsolutions.org)
Date: 2015 03
Revision: Looma 2.0.0

filename: looma-dictionary-test.js
Description:
 */

'use strict';

var list = [];
var responses = [];
var counter=0;
function lookup(e) {

    var word = $('#word')[0].value;
    console.log('word is ' + word);
    //window.alert(word);
    e.preventDefault();
    //var result = LOOMA.lookup(word);

    function fail(jqXHR, textStatus, errorThrown) {

                 console.log('jqXHR is ' + jqXHR.status);

                  window.alert('failed with textStatus = ' + textStatus);
                  //window.alert('failed with errorThrown = ' + errorThrown);
                  //window.alert('failed with jqXHR = ' + jqXHR);
                  };

    function succeed(result, textStatus, jqXHR) {

              //console.log('result is ' + result);
              //console.log('defn is ' + result.defn);
              //console.log('img is ' + result.img);

            //window.alert(result);
        $('#wordlist-output').html(result.def);
        $('#defn-output').text(result.def);
            $('#img-output').html('<img src="' + result.img + '>');
    };

   LOOMA.lookup(word, succeed, fail);
            /*
            $.ajax(        //"looma-dictionary-utilities.php",
                   "http://192.168.1.107/Looma/looma-dictionary-utilities.php",
                 {type: 'GET',
                  cache: false,
                      crossDomain: true,
                  dataType: "json",
              data: "cmd=lookup&word=" + word,
              error: fail,
              success: succeed
             });
            */
}; //end LOOKUP

 function wordlist(e) {
    //PARAMS are: class, subj, count, random

    e.preventDefault();

    //var grade =  $('#class').val();
    //var subj =   $('#subj').val();
    //var count =  $('#count').val();
    //var random = $('input[name=random]:checked').val();
    var response;


    function fail(jqXHR, textStatus, errorThrown) {

                 console.log('jqXHR is ' + jqXHR.status);

                  window.alert('failed with textStatus = ' + textStatus);
                  //window.alert('failed with errorThrown = ' + errorThrown);
                  //window.alert('failed with jqXHR = ' + jqXHR);
                  };

    function succeed(result) {
            var output = '';
            for (var i=0; i < result.length; i++) {
                  console.log('list is ' + result[i]);
                  output += result[i] + '<br>';
                  list.push(result[i]);
            //window.alert(result);
            }
            
            $('#wordlist-output').html(output);

    };

    LOOMA.wordlist('class1', 'english', "1EN01", $('#count').val(), true, succeed, fail);

            /*
            $.ajax(
                //     "http://192.168.1.135/Database Editor/looma-dictionary-lookup.php",
                   "http://192.168.1.107/Looma/looma-dictionary-utilities.php",
                 {type: 'GET',
                  cache: false,
                  crossDomain: true,        //try again without this
                  dataType: "json",            //jQ will convert the response back into JS, dont need parseJSON()
                  data: "cmd=list" +
                      "&class=" + (grade || "class1") +
                      "&subj=" + (subj || "english") +
                      "&count=" + (count.toString() || "25") +
                  "&random=" + random,
                  error: fail,
                  success: succeed
                 });
            */

    return false;
};; //end WORDLIST

function listdef(e) {
    
    console.log(list);
    
    $.ajax({
        url:'looma-dictionary-utilities.php',
        async: true,
        type: 'GET',
        cache: false,
        crossDomain: true,
        data: "cmd=lookup&word=" + encodeURIComponent(list[counter]),
        dataType: 'json',
        success:function(data){
            console.log('success of ajax response');
            responses.push(data);
            counter++;
            if (counter < list.length) listdef();},
        error: console.log("lookup fail")
    });
    $('#wordlist-output').html(responses);
    
    console.log("responses: " + responses);
}

$(document).ready(function(){
    $('#lookup-button').click(lookup);
//    $('#addword-button').click(addword);
    $('#wordlist-button').click(wordlist);
    $('#worddef-button').click(listdef);
    
});
