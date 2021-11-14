<!doctype html>
<!--
LOOMA php code file
Filename: looma-clock-doubleclock.php

Description: This file uses a canvas to draw two random clocks, and uses
<select> <option> elements to create a dropdown menu, which the user will
use to enter the difference in times of the two clocks.  It also creates a
“New Problem” button which refreshes the page to generate two new clocks.

Programmer name: John  and Grant
Email:
Owner: VillageTech Solutions (villagetechsolutions.org)
Date:
Revision: Looma 2.0.x
Comments:
-->

<?php
$page_title = 'Looma - Time';
    include ('includes/header.php');
    include ('includes/toolbar.php');
    include ('includes/js-includes.php');
?>

    <link rel="Stylesheet" type="text/css" href="css/looma-clock.css">
</head>

<body>
    <div id="main-container-horizontal">
        <h1> <?php keyword("Looma Clock") ?> </h1>

        <canvas id="doubleClock">
        </canvas>

        <button id="newproblem"><?php keyword("New Problem")?></button>

        <p id="question"><?php keyword("How much time has passed?") ?></p>
            <fieldset id="getInput">
                <label id="label"> <?php keyword("Hours:") ?></label>
                <select type="int" id="userHour">
                    <?php
                        for ($i=0; $i<=11; $i++)
                        {
                            ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php
                        }
                    ?>
                </select>

                <label id="label"> <?php keyword("Minutes:") ?></label>

                <select  type="int" id="userMin">
                    <option value=0>00</option>
                    <option value=5>05</option>

                    <?php
                        for ($i=10; $i<56; $i+=5)
                        {
                            ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php
                        }
                    ?>
            </select>
                <button id="submit"> <?php keyword("Submit"); ?> </button>
            </fieldset>
            <div id="txtOutput" />

        <script src="js/looma-clock-doubleclock.js"></script>

    </div>
</body>
