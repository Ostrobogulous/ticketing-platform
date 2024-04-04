<?php
$prefix = $_ENV["prefix"];
$pathToComponents = 'src/Views/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Password Mismatch</title>
    <?php require_once "{$pathToComponents}Common/header.php" ?>
</head>

<body>
    <?php

    require_once "{$pathToComponents}Common/loadingSpinner.php";

    require_once "{$pathToComponents}Common/navbar.php";

    require_once "{$pathToComponents}Common/modalSearch.php";

    ?>

    <br>
    <br>
    <br>
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                    <h1 class="mb-4">Password Mismatch</h1>
                    <p class="fs-5 mb-4">The confirmed password and the new one do not match, please try again.</p>
                    <a class="btn border-secondary rounded-pill py-3 px-5" href=" <?= "{$prefix}/home" ?> ">Go Back To Home</a>
                </div>
            </div>
        </div>
    </div>


    <?php

    require_once "{$pathToComponents}Common/footer.php";

    require_once "{$pathToComponents}Common/copyright.php";

    require_once "{$pathToComponents}Common/backToTopButton.php";

    require_once "{$pathToComponents}Common/scripts.php";

    ?>
</body>

</html>