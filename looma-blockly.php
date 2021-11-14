<!doctype html>
<!--
Filename: looma-xxx.php
Description: looma PHP template

Author: Skip
Owner:  Looma Education Company
Date:   2018
Revision: Looma 3
-->

<?php $page_title = 'Looma Page Template';
require_once ('includes/header.php');
/* header.php imports: CSS: looma.css, looma-keyboard.css, bootstrap.css */
?>

<link rel="stylesheet" href="css/looma-template.css">

</head>

<body>
<div id="main-container-horizontal">
    <div id="fullscreen">
        <div id="blocklyArea" style="height:100%;width:100%;background-color:lightpink">
            <div id="blocklyDiv" style="position: absolute">
                
            </div>
        </div>

        <script src="js/blockly/blockly_compressed.js"></script>
        <script src="js/blockly/blocks_compressed.js" ></script>

        <script>
            var blocklyArea = document.getElementById('blocklyArea');
            var blocklyDiv = document.getElementById('blocklyDiv');
            var workspace = Blockly.inject(blocklyDiv,
                {toolbox: document.getElementById('toolbox')});
            var onresize = function(e) {
                // Compute the absolute coordinates and dimensions of blocklyArea.
                var element = blocklyArea;
                var x = 0;
                var y = 0;
                do {
                    x += element.offsetLeft;
                    y += element.offsetTop;
                    element = element.offsetParent;
                } while (element);
                // Position blocklyDiv over blocklyArea.
                blocklyDiv.style.left = x + 'px';
                blocklyDiv.style.top = y + 'px';
                blocklyDiv.style.width = blocklyArea.offsetWidth + 'px';
                blocklyDiv.style.height = blocklyArea.offsetHeight + 'px';
                Blockly.svgResize(workspace);
            };
            window.addEventListener('resize', onresize, false);
            onresize();
            Blockly.svgResize(workspace);
        </script>
    </div>
</div>

<?php include ('includes/toolbar.php'); ?>
<?php include ('includes/js-includes.php'); ?>      <!-- js-includes.php imports JS: looma.js, looma-utilities.js, looma-screenfull.js,
                                                            looma-keyboard.js, jQuery -->

</body>
</html>
