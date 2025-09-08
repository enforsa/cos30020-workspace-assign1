<?php
require_once 'navbar.php';
require_once 'icon.php';
require_once 'label.php';
require_once 'input.php';
require_once 'textarea.php';
require_once 'radio.php';
require_once 'checkbox.php';
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
    <?php echo createNavbar(); ?>

    <section class="page-contents post-vacancy">
        <div class="post-vacancy-header">
            <h3>
                <?php echo createIcon('./style/phosphor-icons/suitcase-simple-fill.svg', IconSize::ExtraLarge) ?>
                Post job vacancy
            </h3>
            <h6>Submit a job application below, just enter a few <br>details first</h6>
        </div>
        <form class="post-vacancy-form" action="postjobprocess.php" method="POST">
            <?php
            echo createInput('text', 'position-id', 5, InputSize::Normal, 'Enter position ID', '[A-Z]{2}\d{3}', true, false, 'Position ID');
            echo createInput('text', 'title', 0, InputSize::Normal, 'Enter title', '[a-zA-Z0-9 ,.!]{1,20}', true, false, 'Title');
            echo createInput('text', 'closing-date', 0, InputSize::Normal, 'Enter closing date (e.g 08/06/25)', '(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/\d{2}', true, false, 'Closing Date');
            echo createTextarea('description' ,  100, TextareaSize::Normal, 'Enter description', true, false, 'Description', '', ResizeOptions::Vertical);
            ?>

            <div id="input-selectors-container">
                <div class="vacancy-input-group">
                    <label>Position</label>
                    <?php 
                    echo createRadio("Full-time", "position", "full-time");
                    echo createRadio("Part-time", "position", "part-time");
                    ?>
                </div>
    
                <div class="vacancy-input-group">
                    <label>Contract</label>
                    <?php 
                    echo createRadio("On-going", "contract", "on-going");
                    echo createRadio("Fixed term", "contract", "fixed-term");
                    ?>
                </div>
    
                <div class="vacancy-input-group">
                    <label>Location</label>
                    <?php 
                    echo createRadio("On-site", "location", "on-site");
                    echo createRadio("Remote", "location", "remote");
                    ?>
                </div>

                <div class="vacancy-input-group">
                    <label>Accept application by</label>
                    <?php 
                    echo createCheckbox("On-site", "accept-application-by", "post");
                    echo createCheckbox("email", "accept-application-by", "email");
                    ?>
                </div>
            </div>
            <div id="post-vacancy-form-footer">
                <?php echo createButton(ButtonSize::Normal, ButtonStyle::Filled, ButtonColor::Blue, './style/phosphor-icons/rocket-launch-fill.svg', 'Submit vacancy', 'submit', '', false, false, false); ?>
            </div>
        </form>
    </section>
</body>

</html>