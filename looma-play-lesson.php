<!doctype html>
<!--
Author: Skip
Filename: looma-lesson-present.php
Date: 02/2017
Description: looma lesson plan presenter

-->
	<?php $page_title = 'Looma Lesson Presenter ';
          include ('includes/header.php');
          require ('includes/mongo-connect.php');
          include('includes/looma-utilities.php'); ?>

    <link rel="stylesheet" href="css/looma-media-controls.css">
    <!-- <link rel="stylesheet" href="css/looma-video.css"> -->
    <link rel="stylesheet" href="css/looma-play-lesson.css">
    <link rel="stylesheet" href="css/looma-text-display.css">
    <?php include ('includes/js-includes.php'); ?>

  </head>

  <body>
    <?php
    if (isset($_REQUEST['id'])) $lesson_id = $_REQUEST['id']; else $lesson_id = null;
    if (isset($_REQUEST['lang'])) $lang = $_REQUEST['lang']; else $lang = null;

        echo "<div id='main-container-horizontal' data-lang=$lang>";
    ?>
            <div id="fullscreen">

                <div id="viewer"></div>

                <?php include("includes/looma-control-buttons.php"); ?>
                <!--

                <button class="control-button-fullscreen" id="back-fullscreen"></button>
                <button class="control-button-fullscreen" id="forward-fullscreen"></button>
                -->
            </div>

            <?php include("includes/looma-media-controls.php"); ?>
        </div>

        <div id="timeline-container">
            <div id="timeline" >

        <?php

        //look up the lesson plan in mongo lessons collection
        //send DN, AUTHOR and DATE in a hidden DIV
        //for each ACTIVITY in the DATA field of the lesson, create an 'activity button' in the timeline

        function thumbPrefix($ft) {   // this should be in includes/looma-utilities.php
            $fp =   "";
		switch ($ft) { //if $fp is not specified, use the default content folder for this $ft

            case "video":
            case "mp4":
            case "mp5":
            case "m4v":
            case "mov":
                $fp = '../content/videos/';
                break;

            case "image":
            case "jpg":
            case "jpeg":
            case "png":
            case "gif":
                $fp = '../content/pictures/';
                break;

            case "audio":
            case "m4a":
            case "mp3":
                $fp = '../content/audio/';
                break;

            case "pdf":
                $fp = '../content/pdfs/';
                break;

            case "slideshow":
                $fp = urlencode('../content/slideshows/');
                break;

            case "evi":
                $fp = '../content/videos/';
                break;

            case "html":
            case "HTML":
                $fp = '../content/html/';
                break;

            case "EP":
            case "epaath":
                break;

            case "VOC":       //vocabulary reviews
            case "lesson":    //lesson plan
            case "map":       //map
            case "game":    //game
            case "text":      //text
            case "book":      //book
            case "looma":     //looma
            case "chapter":   //chapter
            case "history":   //$fp = '../content/histories/';
                break;
        };
        return $fp;
        } ;

         if ($lesson_id) {   //get the mongo document for this lesson
            $query = array('_id' => mongoId($lesson_id));
            //returns only these fields of the activity record
            $projection = array('_id' => 0,
                                'dn' => 1,
                                'author' => 1,
                                'date' => 1,
                               // 'thumb' => 1,  //no THUMB stored with lessons in mongo
                                'data' => 1
                                );

            $lesson = mongoFindOne($lessons_collection, $query);

            $lessonname = $lesson['dn'];

            if (isset($lesson['data'])) $data = $lesson['data'];
            else { echo "Lesson has no content"; $data = null;}

            //should send DN, AUTHOR and DATE in a hidden DIV

            if ($data) foreach ($data as $lesson_element) {

               if ($lesson_element['collection'] == 'activities') {  //timeline element is from ACTIVITIES

                    $query = array('_id' => mongoId($lesson_element['id']));

                    $details = mongoFindOne($activities_collection, $query);

                   //echo ('  ft: ' . $details['ft']);

                   if (isset($details['thumb']) && $details['thumb'] != "")
                      $thumbSrc = $details['thumb'];
                   else if (isset($details['ft']) && $details['ft'] == 'EP'  && isset($details['version']) && $details['version'] == 2015)
                       $thumbSrc = '../content/epaath/activities/' . $details["fn"] . '/thumbnail.jpg';
                   else if (isset($details['ft']) && $details['ft'] == 'evi')
                       $thumbSrc = 'images/video.png';
                   else if (isset($details['ft']) && $details['ft'] == 'text')
                       $thumbSrc = 'images/textfile.png';
                   else if (isset($details['ft']) && $details['ft'] == 'game')
                       $thumbSrc = 'images/games.png';
                   else if (isset($details['fn']) && isset($details['fp']))
                     $thumbSrc = $details['fp'] . thumbnail($details['fn']);
                   else if ( isset($details['fn']))
                       $thumbSrc = thumbPrefix($details['ft']) . thumbnail($details['fn']);
                   else $thumbSrc = 'images/LoomaLogo_small.png';

                   if (isset($details['ft']) && $details['ft'] == 'EP'  && $details['subject'] === 'nepali') $playLang = 'np'; else $playLang = 'en';
                   //  format is:  makeActivityButton($ft, $fp, $fn, $dn, $ndn, $thumb, $ch_id, $mongo_id, $ole_id, $url, $pg, $zoom,$nfn,$npg,$prefix,$lang)

                   //echo "$playLang is " . $playLang;

                        makeActivityButton(
                             $details['ft'],
                            (isset($details['fp'])) ? $details['fp'] : null,
                            (isset($details['fn'])) ? $details['fn'] : null,
                            (isset($details['dn'])) ? $details['dn'] : null,
                             null,
                            $thumbSrc,

                            "", //(isset($details['ch_id'])) ? $details['ch_id'] : null,
                            (isset($details['mongoID'])) ? $details['mongoID'] : null,
                            (isset($details['oleID'])) ? $details['oleID'] : null,
                            (isset($details['url'])) ? $details['url'] : null,
                            (isset($details['pn'])) ? $details['pn'] : null,
                            null,
                            (isset($details['grade'])) ? $details['grade'] : null,
                            (isset($details['version'])) ? $details['version'] : null,
                            (isset($details['nfn'])) ? $details['nfn'] : null,
                            (isset($details['npn'])) ? $details['npn'] : null,
                            null,
                            $playLang
                        );
                } else

                if ($lesson_element['collection'] == 'chapters') {  //timeline element is from CHAPTERS

                    $lang = (isset($lesson_element['lang']) ? $lesson_element['lang'] : null);

                    $query = array('_id' => $lesson_element['id']);
                    $chapter = mongoFindOne($chapters_collection, $query);

                    $query = array('prefix' => prefix($chapter['_id']));
                    $textbook = mongoFindOne($textbooks_collection, $query);

                    $filename = (isset($textbook['fn']) && $textbook['fn'] != "") ? $textbook['fn'] : ((isset($textbook['nfn'])) ? $textbook['nfn'] : null);
                    $nfn = (isset($textbook['nfn']) ? $textbook['nfn'] : null);

                    $filepath = (isset($textbook['fp']) && $textbook['fp'] != "") ? $textbook['fp'] : null;

                    $displayname = (isset($chapter['dn']) && $chapter['dn'] != "") ? $chapter['dn'] : ((isset($chapter['ndn'])) ? $chapter['ndn'] : null);
                    $pagenumber  = (isset($chapter['pn']) && $chapter['pn'] != "") ? $chapter['pn'] : ((isset($chapter['npn'])) ? $chapter['npn'] : null);
                    $npn  = (isset($chapter['npn']) ? $chapter['npn'] : null);

                    $len  = (isset($chapter['len']) && $chapter['len'] != "") ? $chapter['len'] : ((isset($chapter['nlen'])) ? $chapter['nlen'] : null);
                    $nlen  = (isset($chapter['nlen']) ? $chapter['nlen'] : null);

                    if ($filename && $filepath)
                        $thumbSrc = "../content/" . $filepath . thumbnail($filename);
                    else $thumbSrc = null;
                    //echo "filename is " . $filename;
                    makeChapterButton('pdf',
                        '../content/' . $filepath,
                        $filename,
                        $displayname,
                        null,
                       $thumbSrc,
                       $chapter['_id'],
                       null,
                       null,
                       null,
                       $pagenumber,
                       $len,
                       2.3,
                        null,
                        null,
                        $nfn,
                        $npn,
                        $nlen,
                        null,
                        $lang
                    );
                }
            }
         }
            else {echo "<h1>No lesson plan selected</h1>";
                  $displayname = "<none>";}
        ?>
           </div>
        </div>

         <div id="title">
             <span id="subtitle"></span>
            <span>Looma Lesson:&nbsp; <span class="filename"><?php if ($lessonname) echo $lessonname ?></span></span>
         </div>


    <div id="controlpanel">

        <div id="button-box">
            <button class="control-button" id="back">
                <!-- <img src="images/back-arrow.png"> -->
            </button>
     <!--
            <button class="control-button" id="pause">
            </button>
     -->
            <button class="control-button" id="forward">
                <!-- <img src="images/forward-arrow.png"> -->
            </button>
             <button class='control-button' id='return' >
                <!-- <img src="images/delete-icon.png"> -->
            </button>
        </div>
    </div>

    <?php //include ('includes/toolbar.php'); ?>
    <script src="js/jquery-ui.min.js">  </script>
    <script src="js/jquery.hotkeys.js"> </script>
    <script src="js/tether.min.js">  </script>
    <script src="js/bootstrap.min.js">  </script>
    <script src="js/looma-media-controls.js"></script>
    <script src="js/looma-play-lesson.js"></script>

 </body>
</html>
