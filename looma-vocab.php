<!doctype html>
<!--
Name: Skip

Owner: VillageTech Solutions (villagetechsolutions.org)
Date: 2015 03
Revision: Looma 2.0.0
File: looma-vocab.php   [Class & Subject selection page for Looma]
Description: displays all the classes and on-click, all the subjects, plus toolbar for other pages
-->

<?php $page_title = 'Looma';
      include ('includes/header.php');

      define ("CLASSES", 8);

    function getMasks() {
        return array ("1111", "1111", "1111", "1111", "1111", "1111", "1111","1111");
        }; //end getMasks()

    $masks = getMasks();
?>
    <link href="css/looma-games.css" type="text/css" rel="stylesheet" />

    </head>

    <body>
    <div id="main-container-horizontal"  background="images/looma-background.png">

        <img src="images/logos/LoomaLogoTransparent.png" class="looma-logo" width="75%"/>
    <h1 class="title"><?php keyword('Vocabulary Games') ?></h1>
        <!--  display CLASS buttons  -->
    <div class="button-div" id="row1">
        <button type="button" class="class button-8" id="class1" data-mask="<?php echo $masks[0];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('1') ?> </button>
        <button type="button" class="class button-8" id="class2" data-mask="<?php echo $masks[1];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('2') ?> </button>
        <button type="button" class="class button-8" id="class3" data-mask="<?php echo $masks[2];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('3') ?> </button>
        <button type="button" class="class button-8" id="class4" data-mask="<?php echo $masks[3];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('4') ?> </button>
        <button type="button" class="class button-8" id="class5" data-mask="<?php echo $masks[4];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('5') ?> </button>
        <button type="button" class="class button-8" id="class6" data-mask="<?php echo $masks[5];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('6') ?> </button>
        <button type="button" class="class button-8" id="class7" data-mask="<?php echo $masks[6];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('7') ?> </button>
        <button type="button" class="class button-8" id="class8" data-mask="<?php echo $masks[7];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('8') ?> </button>
    </div>
        <br><br><br>


        <!--  display SUBJECT buttons, all hidden until CLASS button is pressed, then show SUBJECT buttons based on data-mask  -->

    <?php
        //$subjects = array('nepali', 'english', 'math', 'science', 'social studies');
    ?>
<!--
    <div class="button-div" id="row2">
        <button type="button" class="subject button-5" id="english"        style="visibility: hidden"> <?php keyword('English') ?>  </button>
        <button type="button" class="subject button-5" id="math"           style="visibility: hidden"> <?php keyword('Math') ?>  </button>
        <button type="button" class="subject button-5" id="science"        style="visibility: hidden"> <?php keyword('Science') ?>  </button>
        <button type="button" class="subject button-5" id="social studies" style="visibility: hidden"> <?php keyword('Social Studies') ?>  </button>
    </div>
-->
    </div>
    <?php include ('includes/toolbar.php'); ?>
    <?php include ('includes/js-includes.php'); ?>
    <script src="js/looma-vocab.js"></script>          <!-- Looma Javascript -->
    </body>
   </html>
