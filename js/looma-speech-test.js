/*
LOOMA javascript file
Filename: xxx.JS
Description:
Programmer name: Skip
Date:
Revision: Looma 2.0.x
 */

'use strict';

    $(document).ready (function() {
        $('#synthesis').click(function(){
            LOOMA.speak($('input#text').val(), $(this).attr('id'), null, $('#rate').val());
        });
        $('#mimic').click(function(){
            LOOMA.speak($('input#text').val(), $(this).attr('id'), null, $('#rate').val());
        });
        
      /*  $('#rate').change(function(){
                speechSynthesis.rate =  $(this).val();
            });
        */
        
    }); //end document.ready function
