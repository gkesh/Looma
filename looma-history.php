<!doctype html>
<!--
Author: Ellie and Jayden (2016) Alexa Thomases, Catie Cassani, May Li (2017)
Filename: looma-history.php
Date: July 2017
Description: Creates history timelines with search, scroll, lookup, speech, and popup functions. Information accessed through database.
-->
  <?php $page_title = 'Looma History Timeline';

    include ("includes/header.php");
    include ("includes/mongo-connect.php");
  ?>

    <link href='css/looma-history.css' rel='stylesheet' type='text/css'>

</head>

<body>

    <div id="main-container-horizontal">
        <div id="fullscreen">
        <h1 class="credit"> Created by Ellie, Jayden, Alexa, Catie, and May</h1>

        <?php include ('includes/looma-control-buttons.php');?>



      <?php

        //Load Timeline
        if (isset($_REQUEST["title"]) || (isset($_REQUEST["chapterToLoad"])) || (isset($_REQUEST["id"]))) {
        if (isset($_REQUEST["title"])) $hist = $_REQUEST["title"];
        if (isset($_REQUEST["chapterToLoad"])) $ch_id = $_REQUEST["chapterToLoad"]; // currently not in use (previously used in US Presidents timeline)
        if (isset($_REQUEST["id"])) $_id = $_REQUEST["id"];

        //Search Database and Get Cursor
        if (isset($hist)) $query = array("title" => $hist);

        else if (isset($ch_id)) $query = array("ch_id" => $ch_id);

        else $query = array('_id' => mongoID($_REQUEST['id']));

        //$cursor =  $history_collection->find($query, array("title"=>1, "events"=>1)); //should be findOne()  ??
        $cursor =  mongoFind($history_collection, $query, null, null, null); //should be findOne()  ??

        foreach ($cursor as $doc) {

            $title = isset($doc['title']) ? $doc['title'] : null;
            ?>
            <label for="keywords">Search:</label><input id="keywords" class="searchBar" size="18" placeholder="enter words to search" >

        <button id= "previous"> <span class="english-keyword"> Prev </span>               </button>
        <button id= "next" clickcount = "-1"> <span class="english-keyword"> Next </span> </button>
        <button class="scrollButtonLeft">   <img src="images/back-arrow.png">             </button>
        <button class="scrollButtonRight">  <img src="images/forward-arrow.png">          </button>

           <!-- <button id='search-button'></button> -->

        <button class="returnToLeftmost">   <img src="images/reverse-double-arrow.png">   </button>

        <?php
            echo "<h1> $title </h1>";
            echo '<div id="playground">';
            echo '<section class ="timeline">';
            echo '<ol>';

            $count = 0;
            foreach($doc['events'] as $event) {
                  $msg = "";
                  $id1 = "";
                  $id2 = "";

                   if(isset($event['popup'][0]))
                        $msg = 'data-msg=' .  $event['popup'][0] ;

                  if(isset($event['popup'][1]))
                        $id1 = 'data-id1=' . $event['popup'][1];

                  if(isset($event['popup'][2]))
                        $id2 = 'data-id2='. $event['popup'][2];

                  if ($count%2 == 0)
                  {
                   echo '
            
                   <li>
            
                     <div class="timeline-description">
            
                       <div class="dropdown" style="float:">'; // edited out

                   echo '<button class="dropbtn"' .  " " . $id1 . " " . $id2 . " " . $msg . '>' .  $event['title'] . '</button>';

                   echo '<button class="dropdate">' . $event['date'] . '</button>'; //dropbtn before dropdate so dropbtn is on top

                       '</div>
            
                   </li>';

                 } else
                 {
                  echo '
                   <li>
            
                     <div class="timeline-description">
            
                       <div class="dropdown" style="float:">'; // edited out

                       echo '<button class="dropdate">' . $event['date'] . '</button>';
                       echo '<button class="dropbtn"' . " " . $id1 . " " . $id2 . " " . $msg . '>' . $event['title'] . '</button>';

                       '</div>
                   </li>';
                 }
                   $count += 1;
            }  //end foreach doc[elements] as event
            echo '</ol>';
        } //end foreach cursor as doc
        echo '</section></div>';
        } //end if isset()
        else
        {echo 'no history found';}
      ?>

        </div>
    </div>

    <?php include ('includes/toolbar.php'); ?>
</body>

    <?php include ('includes/js-includes.php'); ?>
    <script type="text/javascript" src="js/looma-hilitor-utf8.js"></script>
    <script type="text/javascript" src="js/looma-history.js"></script>


</html>
