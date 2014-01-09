<?php echo ipDoctypeDeclaration(); ?>
<html<?php echo ipHtmlAttributes(); ?>>
<head>
    <?php
    ipAddCss(ipThemeUrl('ipContent.css'));
    ipAddCss(ipThemeUrl('theme.css'));
    echo ipHead();
    ?>
</head>
<body>
    <div class="topmenu">
        <?php
        ipSlot('Ip.menu', 'menu1');
        ?>
    </div>
    <div class="content">
        <?php echo ipBlock('main')->render(); ?>
    </div>
    <?php
        ipAddJs(ipThemeUrl('theme.js'));
        echo ipJs();
    ?>
</body>
</html>
