<?php
    require_once 'navbar.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace</title>
    <link rel="stylesheet" href="style.css">
    
    <!-- FOR SOME REASON I HAVE TO DO IT LIKE THIS, EVERY OTHER METOD OF STYLING DOES NOT WORK -->
    <link rel="stylesheet" href="./style/components.css"> 
</head>
<body>
    <?php echo createNavbar() ?>

    <section></section>

    <div class="effect-background-container">
        <video class="effect-background" src="./style/assets/effect.mp4" loop type="video/mp4" preload="auto" autoplay></video>
    </div>
</html>