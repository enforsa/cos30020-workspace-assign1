<?php
require_once 'navbar.php';
require_once 'icon.php';
require_once 'label.php';
require_once 'input.php';
require_once 'textarea.php';
require_once 'radio.php';
require_once 'checkbox.php';

// Get current date in dd/mm/yy format
$currentDate = date('d/m/y');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job Vacancy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./style/components.css">
    <link rel="icon" type="image/svg" href="./style/favicon.svg">
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
            echo createInput('text', 'position-id', 5, InputSize::Normal, 'Enter position ID (e.g. AB123)', '', true, false, 'Position ID');
            echo createInput('text', 'title', 20, InputSize::Normal, 'Enter title', '[a-zA-Z0-9 ,.!]{1,20}', true, false, 'Title');
            echo createTextarea('description', 100, TextareaSize::Normal, 'Enter description', true, false, 'Description', '', ResizeOptions::Vertical);
            ?>

            <div id="input-selectors-container">
                <div class="vacancy-input-group">
                    <label>Position</label>
                    <?php
                    echo createRadio("position-fulltime", "position", "Full Time", "Full Time");
                    echo createRadio("position-parttime", "position", "Part Time", "Part Time");
                    ?>
                </div>

                <div class="vacancy-input-group">
                    <label>Contract</label>
                    <?php
                    echo createRadio("contract-ongoing", "contract", "On-going", "On-going");
                    echo createRadio("contract-fixed", "contract", "Fixed term", "Fixed term");
                    ?>
                </div>

                <div class="vacancy-input-group">
                    <label>Location</label>
                    <?php
                    echo createRadio("location-onsite", "location", "On-site", "On-site");
                    echo createRadio("location-remote", "location", "Remote", "Remote");
                    ?>
                </div>

                <div class="vacancy-input-group">
                    <label>Accept application by</label>
                    <?php
                    echo createCheckbox("accept-post", "accept-application-by[]", "Post", "Post");
                    echo createCheckbox("accept-email", "accept-application-by[]", "Email", "Email");
                    ?>
                </div>
            </div>

            <div id="post-vacancy-form-footer">
                <?php echo createButton(ButtonSize::Normal, ButtonStyle::Filled, ButtonColor::Blue, './style/phosphor-icons/rocket-launch-fill.svg', 'Submit vacancy', 'submit'); ?>
            </div>
        </form>

    </section>
</body>

</html>