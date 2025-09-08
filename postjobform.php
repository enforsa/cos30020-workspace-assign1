<?php
    require_once 'label.php';
    require_once 'icon.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post job vacancy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./style/components.css">
</head>

<body>
    <section class="page-contents">
        <div class="post-vacancy-header">
            <h3>
                <?php echo createIcon('./style/assets/phosphor-icons/suitcase-simple-fill.svg', IconSize::Large) ?>
                Post job vacancy
            </h3>
            <h6>Submit a job application below, just enter a few details first</h6>
        </div>
        <?php
            createLabel("Position ID", "position-id");

            createLabel("Title", "title");

            createLabel("Closing Date", "closing-date");

            createLabel("Description", "description");

            createLabel("Position", "position");

            createLabel("Contract", "contract");

            createLabel("Location", "location");

            createLabel("Accept application by", "accept-application-by");
        ?>
    </section>

</body>

</html>