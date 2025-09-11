<?php
require_once 'navbar.php';

$hasErrored = false;
$errorMessage = "";

umask(0007);
$dir = "../../data/jobs";

if (!is_dir($dir))
    mkdir($dir, 02770, true);

// Check if all required POST fields are present
if (
    !isset($_POST['position-id']) || !isset($_POST['title']) ||
    !isset($_POST['description']) || !isset($_POST['position']) || !isset($_POST['contract']) ||
    !isset($_POST['location']) || !isset($_POST['accept-application-by'])
) {
    $hasErrored = true;
    $errorMessage = "All fields are mandatory. Please fill in all required fields.";
} else {
    $positionID = trim($_POST['position-id']);
    if (!validatePositionID($positionID)) {
        $hasErrored = true;
        $errorMessage = "Position ID must be exactly 5 characters: 2 uppercase letters followed by 3 digits (e.g., AB123).";
    }

    $title = trim($_POST['title']);
    if (!validateTitle($title)) {
        $hasErrored = true;
        $errorMessage = "Title must be maximum 20 characters and contain only alphanumeric characters, spaces, comma, period, and exclamation point.";
    }

    $description = trim($_POST['description']);
    if (!validateDescription($description)) {
        $hasErrored = true;
        $errorMessage = "Description must be maximum 100 characters and cannot be empty.";
    }

    // Generate closing date from serverside
    $closingDate = date('d/m/y');

    // Get the selected values from radio buttons
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $contract = isset($_POST['contract']) ? $_POST['contract'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';

    // Process checkbox values for accept-application-by
    $acceptApplicationBy = array();
    if (isset($_POST['accept-application-by'])) {
        if (is_array($_POST['accept-application-by'])) {
            $acceptApplicationBy = $_POST['accept-application-by'];
        } else {
            $acceptApplicationBy = array($_POST['accept-application-by']);
        }
    }

    if (count($acceptApplicationBy) == 0) {
        $hasErrored = true;
        $errorMessage = "You must select at least one application method (Post or Email).";
    }

    $acceptApplicationByString = implode(', ', $acceptApplicationBy);

    if (!$hasErrored) {
        $pathToFile = '../../data/jobs/positions.txt';

        // Check if position ID already exists
        if (file_exists($pathToFile)) {
            $fileContents = file_get_contents($pathToFile);
            if ($fileContents !== false) {
                $lines = explode("\n", $fileContents);
                foreach ($lines as $line) {
                    $trimmedLine = trim($line);
                    if (!empty($trimmedLine)) {
                        $params = explode("\t", $line);
                        if (isset($params[0]) && trim($params[0]) === $positionID) {
                            $hasErrored = true;
                            $errorMessage = "Position ID '$positionID' already exists. Use a unique Position ID for this vacancy.";
                            break;
                        }
                    }
                }
            }
        }

        if (!$hasErrored) {
            $fileStream = fopen($pathToFile, "a");

            if ($fileStream) {
                $data = $positionID . "\t" . $title . "\t" . $closingDate . "\t" . $description . "\t" .
                    $position . "\t" . $contract . "\t" . $location . "\t" . $acceptApplicationByString . "\n";

                $write = fwrite($fileStream, $data);
                fclose($fileStream);

                if ($write === false) {
                    $hasErrored = true;
                    $errorMessage = "A write error has occurred while saving the job vacancy.";
                }
            } else {
                $hasErrored = true;
                $errorMessage = "Unable to open the file for writing.";
            }
        }
    }
}

function validatePositionID($data)
{
    return preg_match('/^[A-Z]{2}[0-9]{3}$/', $data) === 1;
}

function validateTitle($data)
{
    if (strlen($data) > 20 || strlen($data) == 0) {
        return false;
    }
    return preg_match('/^[a-zA-Z0-9 ,.!]+$/', $data) === 1;
}

function validateDescription($data)
{
    return strlen($data) <= 100 && strlen($data) > 0;
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Job Vacancy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./style/components.css">
    <link rel="icon" type="image/svg" href="./style/favicon.svg">
</head>

<body>
    <section class="page-contents">
        <?php echo createNavbar(); ?>
        <div class="status-header-container">
            <?php
            if ($hasErrored) {
                echo "
                        <svg width='208' height='46' viewBox='0 0 208 46' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <path
                                d='M29.5576 17.0176C31.6158 16.8234 33.3502 16.7686 34.626 16.8243C35.2415 16.8512 35.8699 16.9084 36.4111 17.0294C36.6249 17.0772 36.976 17.167 37.3506 17.3458C43.7237 18.5192 47.3481 23.1636 48.9951 27.7833C49.8477 30.1747 50.2175 32.6538 50.1992 34.8633C50.1815 36.9935 49.7983 39.2061 48.8271 40.8692C47.2564 43.5589 44.4197 44.7571 41.7803 45.1964C39.0919 45.6437 36.0901 45.4105 33.3223 44.7676C30.5508 44.1238 27.7918 43.0177 25.6074 41.5323C23.5304 40.1198 21.3971 37.9561 21.0977 35.0352C20.8492 32.6108 20.777 28.6911 21.6426 25.1797C22.4644 21.846 24.5495 17.4903 29.5576 17.0176ZM154.819 26.1299C155.005 24.4836 156.489 23.2992 158.136 23.4844C161.205 23.83 163.869 25.2711 165.046 28.1358C166.121 30.7527 165.593 33.752 164.444 36.4981C163.05 39.8324 159.709 42.6468 156.201 44.0928C152.679 45.5448 148.024 45.9759 144.362 43.0157C142.356 41.3934 141.253 39.3057 141.142 37.0235C141.035 34.8429 141.847 32.8434 142.947 31.2569C145.06 28.2096 148.959 25.6818 152.812 25.6817C153.576 25.6817 154.27 25.9692 154.8 26.4385C154.801 26.3365 154.808 26.2335 154.819 26.1299ZM176.812 36.1202C177.984 34.9487 179.884 34.9488 181.056 36.1202L182.188 37.254C183.36 38.4255 183.36 40.3246 182.188 41.4962C181.017 42.6676 179.118 42.6677 177.946 41.4962L176.812 40.3633C175.641 39.1918 175.641 37.2917 176.812 36.1202ZM115.202 21.8038C116.858 21.8441 118.168 23.2197 118.128 24.876C118.108 25.6867 118.085 26.4546 118.065 27.1817C119.049 26.3393 120.242 25.628 121.668 25.2676C123.552 24.7917 125.542 25.0031 127.555 25.876L127.958 26.0596L128.561 26.3467L128.984 26.8624C131.709 30.1773 131.999 34.9988 130.693 38.5772C130.125 40.1335 128.403 40.9342 126.847 40.3663C125.29 39.7982 124.489 38.0759 125.057 36.5196C125.702 34.7518 125.523 32.6179 124.717 31.21C123.985 30.9672 123.483 30.9977 123.138 31.085C122.65 31.2085 122.095 31.5396 121.481 32.2139C120.178 33.6466 119.227 35.9257 118.553 37.8751C118.391 38.3427 118.258 38.7507 118.133 39.128C118.027 39.4464 117.887 39.8676 117.747 40.1895C117.722 40.2481 117.515 40.7613 117.094 41.2139C116.934 41.3852 116.12 42.2442 114.74 42.1895C113.165 42.1268 112.409 40.9844 112.216 40.6417C111.986 40.235 111.901 39.8647 111.871 39.7286C111.832 39.5476 111.812 39.3858 111.8 39.2725C111.776 39.0451 111.767 38.8075 111.763 38.5967C111.734 37.0732 111.932 32.8699 112.13 24.7296C112.17 23.0734 113.546 21.7637 115.202 21.8038ZM59.8545 11.0001C61.5113 11.0002 62.8545 12.3433 62.8545 14.0001C62.8545 16.6992 62.916 20.4852 63.0117 24.2608C65.503 21.9686 69.0004 21.0169 72.2598 21.1827C75.6894 21.3573 79.3267 22.7914 81.7324 25.8458C83.6397 28.2675 84.0782 30.8789 83.9932 33.2354C83.9159 35.3742 83.3483 37.7538 83.0908 39.2833C82.8156 40.9168 81.2685 42.0182 79.6348 41.7432C78.0012 41.4681 76.9 39.9208 77.1748 38.2872C77.5434 36.0975 77.9385 34.6392 77.9971 33.0186C78.0477 31.6157 77.7952 30.5449 77.0186 29.5587C75.8987 28.1368 74.0329 27.2807 71.9541 27.1749C69.8453 27.0677 67.9882 27.7547 66.9434 28.8018C66.9319 28.8164 66.8093 28.966 66.6133 29.3604C66.4133 29.7629 66.2003 30.2889 65.9824 30.9258C65.5454 32.2036 65.1588 33.7071 64.8154 35.1309C64.5002 36.4381 64.1778 37.8835 63.9219 38.6954C63.8561 38.904 63.7519 39.213 63.6035 39.5147C63.5341 39.6558 63.3879 39.9353 63.1445 40.2256C62.9743 40.4286 62.2988 41.2018 61.0879 41.3243C59.6061 41.4739 58.6811 40.5707 58.3379 40.1163C58.0123 39.685 57.8719 39.2632 57.8193 39.0948C57.6987 38.7081 57.6485 38.3186 57.6211 38.0665C57.2239 34.4085 56.8545 20.688 56.8545 14.0001C56.8545 12.3433 58.1978 11.0002 59.8545 11.0001ZM33.1963 22.8077C32.3699 22.8216 31.3367 22.8766 30.1211 22.9913C29.1733 23.0808 28.15 23.848 27.4678 26.6153C26.8293 29.2052 26.8558 32.367 27.0664 34.4229C27.0948 34.6995 27.4283 35.5151 28.9814 36.5714C30.4273 37.5545 32.464 38.408 34.6807 38.9229C36.9012 39.4386 39.0821 39.5635 40.7959 39.2784C42.5585 38.985 43.3454 38.3592 43.6465 37.8438C43.8744 37.4534 44.1858 36.4293 44.1992 34.8135C44.212 33.2765 43.949 31.4984 43.3428 29.7979C42.1354 26.4117 39.758 23.7119 35.7891 23.169L33.1963 22.8135V22.8077ZM155.812 28.7081C155.797 30.3528 154.461 31.6817 152.812 31.6817C151.346 31.6819 149.133 32.8669 147.879 34.6758C147.296 35.5174 147.11 36.2324 147.135 36.7305C147.154 37.1272 147.312 37.6846 148.135 38.3497C149.413 39.383 151.464 39.5562 153.915 38.546C156.381 37.5294 158.285 35.6759 158.909 34.1827C159.797 32.0589 159.689 30.8853 159.496 30.4151C159.405 30.1924 159.111 29.6317 157.465 29.4464C156.826 29.3744 156.258 29.1047 155.812 28.7081ZM180.067 13.1417C181.724 13.1417 183.067 14.4849 183.067 16.1417V26.3419C183.067 27.9987 181.724 29.3419 180.067 29.3419C178.411 29.3417 177.067 27.9986 177.067 26.3419V16.1417C177.067 14.485 178.411 13.1418 180.067 13.1417ZM0.641602 0.566467C3.69776 -0.607678 6.73429 0.19394 8.8125 2.72369C9.66177 3.75756 10.1503 5.05298 10.3428 6.3399C10.623 6.53914 11.5434 7.16247 12.3271 8.23053C13.2309 9.46238 14 11.2953 14 14.0001C13.9999 14.5522 13.5522 15.0001 13 15.0001C12.4479 14.9999 12.0001 14.5522 12 14.0001C12 11.7051 11.3576 10.2903 10.7148 9.41412C10.5851 9.23728 10.4539 9.08393 10.3281 8.94635C10.1076 10.2428 9.54587 11.4783 8.52539 12.1768C7.40976 12.9404 5.88958 13.1596 4.58398 12.8975C3.27588 12.6348 1.91163 11.816 1.52832 10.2354C1.10321 8.48194 1.7438 6.70274 3.28613 5.76959C4.21174 5.20966 5.51619 4.99848 6.73047 5.06354C7.14226 5.08563 7.56887 5.14211 7.99023 5.23639C7.80511 4.77848 7.56374 4.35495 7.2666 3.99323C5.73522 2.1293 3.61034 1.56843 1.3584 2.43365C0.842986 2.63136 0.264419 2.37383 0.0664062 1.85846C-0.131452 1.34304 0.126264 0.764571 0.641602 0.566467ZM196.696 8.84283C198.591 7.85396 200.489 7.31611 202.221 7.65826C204.026 8.015 205.411 9.27476 206.34 11.3389C206.566 11.8426 206.342 12.4346 205.838 12.6612C205.334 12.8876 204.742 12.6637 204.516 12.1602C203.776 10.5153 202.839 9.81893 201.833 9.62018C200.755 9.40721 199.352 9.71333 197.622 10.6163C197.132 10.8717 196.528 10.682 196.272 10.1924C196.017 9.70295 196.207 9.09835 196.696 8.84283ZM6.62402 7.06158C5.64606 7.00915 4.78547 7.20071 4.32129 7.48151C3.59899 7.91878 3.23146 8.77208 3.47168 9.76373C3.60606 10.3179 4.11421 10.7632 4.97754 10.9366C5.84371 11.1104 6.79505 10.9374 7.39551 10.5264C7.93091 10.1599 8.40579 9.16848 8.43848 7.7608C8.44058 7.67 8.44021 7.57866 8.43848 7.48737C7.93792 7.25055 7.30539 7.09819 6.62402 7.06158ZM205.376 2.39459C205.901 2.0759 206.531 2.07017 207.13 2.23053C207.663 2.37359 207.98 2.92181 207.837 3.45514C207.821 3.51632 207.797 3.57386 207.771 3.62897C207.789 3.67138 207.809 3.71291 207.825 3.75494C207.92 4.00075 208.019 4.35383 207.984 4.71393C207.966 4.8993 207.902 5.19021 207.673 5.44537C207.414 5.73349 207.068 5.84183 206.76 5.836C205.499 5.8117 204.585 4.90021 204.581 3.83209C204.579 3.2918 204.829 2.72714 205.376 2.39459ZM199.967 0.0840454C200.493 -0.0841522 201.055 0.205699 201.224 0.731506C201.307 0.993613 201.276 1.26426 201.16 1.49127C201.164 1.49883 201.169 1.50608 201.173 1.51373C201.252 1.67598 201.332 1.91851 201.299 2.20612C201.263 2.52042 201.104 2.77841 200.896 2.95319C200.707 3.11112 200.504 3.18118 200.361 3.21393C200.213 3.24797 200.071 3.25507 199.952 3.25201C199.715 3.24586 199.474 3.1957 199.26 3.11725C199.054 3.04182 198.795 2.91226 198.58 2.69635C198.354 2.46945 198.101 2.05401 198.21 1.51862C198.307 1.04177 198.645 0.738023 198.907 0.561584C199.188 0.372565 199.547 0.218179 199.967 0.0840454Z'
                                fill='#D83434' />
                        </svg>
                        <p>It looks like there was an error in your submission, details:<br>" . htmlspecialchars($errorMessage) . "</p>
                        " . createButton(ButtonSize::Normal, ButtonStyle::Shaded, ButtonColor::Red, './style/phosphor-icons/arrow-left-bold.svg', 'Back to job', 'button', 'postjobform.php', false, false, false) . "
                        <div class='status-effect-background-container'>
                            <video class='effect-background' src='./style/assets/effect-red.mp4' loop type='video/mp4' preload='auto'
                                autoplay></video>
                        </div>
                    ";
            } else {
                echo "
                        <h4>Success!</h4>
                        <p>Your job vacancy has been successfully submitted!</p>
                        <p><a href='index.php'>Return to Home</a></p>
                        <div class='status-effect-background-container'>
                            <video class='effect-background' src='./style/assets/effect.mp4' loop type='video/mp4' preload='auto'
                                autoplay></video>
                        </div>
                    ";
            }
            ?>
        </div>
    </section>
</body>

</html>