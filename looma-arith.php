<!doctype html>
<!--
Name: Skip

Owner: VillageTech Solutions (villagetechsolutions.org)
Date: 2015 03
Revision: Looma 2.0.0
File: looma-class-subject.php   [Class & Subject selection page for Looma]
Description: displays all the classes and on-click, all the subjects, plus toolbar for other pages
-->

<?php $page_title = 'Looma Arithmetic Drills';
      include ('includes/header.php');

      define ("CLASSES", 8);

    function getMasks() {
        return array ("1000", "1000", "1100", "1110", "1111", "1111", "1111","1111");
        }; //end getMasks()

    $masks = getMasks();
?>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/looma-games.css" type="text/css" rel="stylesheet" />

</head>

    <body>
    <div id="main-container-horizontal">
        <?php
            $class = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'class1';
            echo '<div id="params" data-class="' . $class    . '" hidden></div>';
        ?>
        <!--<img src="images/logos/LoomaLogoTransparent.png" class="looma-logo" width="75%"/> -->
            <br><br>
            <h1 class="title">Looma <?php keyword('Arithmetic Practice') ?></h1>
        <br><br><br><br><br><br>

        <!--  display CLASS buttons  -->
    <div class="button-div" id="row1">
        <button type="button" class="class " id="class1" data-mask="<?php echo $masks[0];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('1') ?> </button>
        <button type="button" class="class " id="class2" data-mask="<?php echo $masks[1];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('2') ?> </button>
        <button type="button" class="class " id="class3" data-mask="<?php echo $masks[2];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('3') ?> </button>
        <button type="button" class="class " id="class4" data-mask="<?php echo $masks[3];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('4') ?> </button>
        <button type="button" class="class " id="class5" data-mask="<?php echo $masks[4];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('5') ?> </button>
        <button type="button" class="class " id="class6" data-mask="<?php echo $masks[5];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('6') ?> </button>
        <button type="button" class="class " id="class7" data-mask="<?php echo $masks[6];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('7') ?> </button>
        <button type="button" class="class " id="class8" data-mask="<?php echo $masks[7];?>"><p class="little"><?php keyword('Grade') ?></p><?php keyword('8') ?> </button>
    </div>
        <br><br><br>

        <!--  display SUBJECT buttons,
              all hidden until CLASS button is pressed,
              then show SUBJECT buttons based on data-mask  -->

    <div class="button-div" id="row2">
        <button type="button" class="subject button-5" id="add"   style="visibility: hidden"> </button>
        <button type="button" class="subject button-5" id="sub"   style="visibility: hidden"> </button>
        <button type="button" class="subject button-5" id="mult"  style="visibility: hidden"> </button>
        <button type="button" class="subject button-5" id="div"   style="visibility: hidden"> </button>
    </div>

    </div>
    <?php include ('includes/toolbar.php'); ?>
    <?php include ('includes/js-includes.php'); ?>
    <script src="js/looma-arith.js"></script>          <!-- Looma Javascript -->
    </body>
   </html>
