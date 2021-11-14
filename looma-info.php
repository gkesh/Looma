<!doctype html>
<!--
extra comment
Name: Skip

Owner: VillageTech Solutions (villagetechsolutions.org)
Date: 2015 03
Revision: Looma 3.0.0
File: looma-info.php
Description:  for Looma 2
-->
<?php $page_title = 'Looma Information';
include ('includes/header.php');
require ('includes/mongo-connect.php');
?>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/looma-info.css">

</head>

<body>
<div id="main-container-horizontal">
    <h1 id="title" class="title">Looma Info page</h1>

    <div id="about">
        <h3>Looma 2</h3>
        <h4>   Release 6.2  FEB 2021   </h4>
        <!-- copyright notice, with link to vts.org-->
        <span class='glyphicon glyphicon-copyright-mark'></span>2021
        <a draggable="false"  class="footer" href="http://looma.education">by Looma Education Company</a>
        <h4>Contact:  info AT looma DOT education</h4>
        <!--<a href="https://creativecommons.org/licenses/by-sa/2.0/">License: CC-BY-SA-NC-2.0</a>-->

       This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">
            Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.

        <img draggable="false"  alt="Creative Commons License" src="images/logos/CC-BY-NC-SA.png" height="33px">
        <br>

        <h5> Attributions for code and content used in Looma: </h5>

        <div id="logos">

            <!--  ADD HOVER INFORMATION FOR EACH LOGO, WITH ATTRIBUTION, NAME/ADDRESS/URL -->

            <a draggable="false"  draggable="false" class="attribution" href="http://www.khanacademy.org" target="_blank">
                <img draggable="false" src="images/logos/khan.jpg" height="66px"></a>
            <a draggable="false"  class="attribution" href="http://www.olenepal.org" target="_blank">
                <img draggable="false" src="images/logos/ole-nepal.jpg" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://www.wikipedia.org" target="_blank">
                <img draggable="false" src="images/logos/wikipedia.jpg" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://phet.colorado.edu" target="_blank">
                <img draggable="false" src="images/logos/PHET.png" height="44px"></a>
            <a draggable="false"  class="attribution" href="https://leafletjs.com" target="_blank">
                <img draggable="false" src="images/logos/leaflet-logo.png" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://www.openstreetmap.org" target="_blank">
                <img draggable="false" src="images/logos/openstreetmap-logo.png" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://translate.google.com" target="_blank">
                <img draggable="false" src="images/logos/google-translate.jpg" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://www.mapbox.com" target="_blank">
                <img draggable="false" src="images/logos/tilemill.png" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://hesperian.org" target="_blank">
                <img draggable="false" src="images/logos/hesperian.png" height="33px"></a>
            <a draggable="false"  class="attribution" href="https://mycroft.ai" target="_blank">
                <img draggable="false" src="images/logos/mycroft.png" height="33px"></a>
            <br>
            <a draggable="false"  class="attribution" href="https://jquery.com" target="_blank">
                <img draggable="false" src="images/logos/jquery-logo.png" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://aws.amazon.com" target="_blank">
                <img draggable="false" src="images/logos/AWS.png" height="66px"></a>
            <span><img draggable="false" src="images/logos/css3-html5-logo.png" height="44px"></span>
            <a draggable="false"  class="attribution" href="https://www.mongodb.com" target="_blank">
                <img draggable="false" src="images/logos/mongodb-logo.png" height="66px"></a>
            <a draggable="false"  class="attribution" href="https://www.jetbrains.com/?from=Looma" target="_blank">
                <img draggable="false" src="images/logos/jetbrains.svg" height="44px"></a>
            <a draggable="false"  class="attribution" href="https://www.stackoverflow.org" target="_blank">
                <img draggable="false" src="images/logos/stackoverflow.png" height="66px"></a>
            <a draggable="false"  class="attribution" href="http://looma.education" target="_blank">
                <img draggable="false" src="images/logos/VTSLogo.jpg" height="66px"></a>
        </div>
        <br>

        <span><img draggable="false" src="images/logos/LoomaLogoTransparent.png" class="loomalogo"></span>
        <img src="images/trademark4.png" id="trademark" height="33px">

        <h4>Tested only in Google Chrome</h4>
        <h4>Report bugs and suggestions to:  info AT looma DOT education</h4>
        <br>
    </div>

    <h2 id="credits-title">Contributors</h2>

    <div id="credits">
        <ul>


            <!-- updated list from DS July '16-->

            <!-- THIS LIST SHOULD BE IN A MONGO COLLECTION -->
            <!-- or create a text file in includes/ folder and write PHP to read in the text into this 'ul' -->
            <li> </li><li> </li><li> </li><li> </li><li> </li> <!-- these empty 'li's give a pause at the start -->
            <li>  - -  </li>

        <?php
            //$volunteers = $volunteers_collection -> find();      //get volunteer names
            $volunteers = mongoFind($volunteers_collection, [], null, null, null);      //get volunteer names
            $volunteerlist = iterator_to_array($volunteers);     //convert to array
            shuffle($volunteerlist);                      //randomize the order
            foreach ($volunteerlist as $volunteer) echo "<li>" . $volunteer['name'] . "</li>";
        ?>

            <li>  - -  </li>
        </ul>
    </div>



    <div>
        <!--button showing CC license icon, with link to the license info page -->

        <div id="sizemessages">
            <p class="screensize"></p>
            <p class="bodysize"></p>

            <p class="mongo-version">MongoDB version: <?php global $mongo_version; echo $mongo_version ?> </p>

            <?php
            $sys = shell_exec('uname -rs');
            echo '<p class="system">OS:  ' . $sys . '</p>';

            //want to display IP address for remote access, until we have zeroconf
            //NOTE: want the external IP for this LOOMA, but 127.0.0.1 "localhost" will show on projected page
            //echo "<p class=\"ip\">IP Address: " . gethostbyname('localhost') . "</p>";
            $ip = shell_exec('/usr/local/bin/loomaIP');
            echo '<p class="ip">IP Address: ' . $ip . '</p>';
            //echo '<p>pid: ' . getmypid() . '</p>';
            ?>

        </div>
        <!-- W3C validator link    new URL=https://validator.w3.org/nu/
           <a draggable="false"  class="footer" href="https://validator.w3.org/nu/check?uri=referer">&nbsp &nbsp (V)</a> -->

    </div>
</div>

<?php include ('includes/toolbar.php');
include ('includes/js-includes.php');
?>
<script src="js/jquery.easy-ticker.js"></script>
<script src="js/looma-info.js"></script>

<!--    <h4>- attributions for borrowed content</h4>
<li>OLE Nepal, Khan academy, Wikipedia, Open Street Maps, ...</li>
<h4>- attribution for open source code used, etc. </h4>
<li>jsKeyboard,leaflet.js, paper.js, TileMill, jQuery, jQuery UI, bootstrap, mongodb, modernizer, pico2wave</li>
 <li>viewer.js, pdf.js, responsiveVoice.js, FullScreen.js topojson.js, google translate</li>
 <li>xnepali.net/fonts, stackoverflow mimic by MyCroft.ai</li>

 content:
 5Gear Studios
 Ales Kladnik
 Antonio Palma
 BBC
 Bodhaguru
 Bozeman Science
 California Academy
 Chuchu TV Kids Songs
 Crash Course
 Earth Island Institute
 Emily Dassel
 ETH Zurich
 Fit Factor Kids Exercize
 Frank Gregorio
 Global Help Videos
 Healthfirst NY
 Hesperian Foundation
 IPPF/FPAN
 Jonathan Bergmann
 Joshua Manley
 KALite
 Khan
 Laurent Schwebel
 Make Me Genius
 Mitja Cvetko
 NASA
 NatGeo
 Nellie and Ed
 OLE Nepal
 Orin Zebest
 Patakiskola
 Peter Bohacek
 Peter Erb
 Playsongs
 Sarah Christenson
 SciShow
 Strength Project
 The Happy Scientist
 The Tokin Tube
 Think Pictures
 Tiger Productions
 Transpower NZ
 Wikipedia
 WorldPossible

 NGO
 KISC EQUIP
 Lew/Ntungi
 Museum of Science Boston
 Nepal Youth Foundation
 UMN (United Mission to Nepal)

 Corporate
 Inquiring Systems Inc.
 Perkins Coie
 Pocobor
 Three60

 Employed software
 Bootstrap
 Flipper.css
 Google translate
 Leaflet
 Miro Video Converter
 ThumbsUp
 TileMill, MapBox
 WordNet, EasyDefine
 OSM, geoFabrik, others?
     -->

</body>
</html>
