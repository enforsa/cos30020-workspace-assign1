<?php
require_once 'navbar.php';
require_once 'icon.php';
require_once 'search.php';  
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Job Vacancies</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./style/components.css">
    <link rel="icon" type="image/svg" href="./style/favicon.svg">
</head>

<body>
    <section class="page-contents search-jobs">
        <?php echo createNavbar(); ?>
         <div class="search-jobs-header">
            <h3>
                <?php echo createIcon('./style/phosphor-icons/magnifying-glass-bold.svg', IconSize::ExtraLarge) ?>
                Search
            </h3>
            <h6>Find job vacancies with a single click,<br>search below to get started ✨</h6>
            
            <div id="search-job-actions-container">
                <?php echo createSearch('q', 'Search jobs') ?>
                <a href="#">
                    <?php echo createIcon('./style/phosphor-icons/sparkle-fill.svg', IconSize::Small2) ?>
                    Try Advanced Search
                </a>
            </div>
        </div>
    </section>
</body>

</html>