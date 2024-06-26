<?php
require_once 'src\Controllers\NotificationController.php';

if (!isset($_SESSION['currency'])) {
    $_SESSION['currency'] = 'USD';
}
// If user is logged-in session will contain user_id & role
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

$currencySymbol = match ($_SESSION['currency']) {
    'EUR' => '€',
    'GBP' => '£',
    default => '$',
};
?>
<link rel="stylesheet" href="Static\CSS\notif.css">

<div class="container-fluid fixed-top" id="navbar-container">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">Centre Urbain, Tunisie</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">tickety@gmail.com</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <?php $prefix = $_ENV['prefix']; ?>
            <a href=<?= "{$prefix}/" ?> class="navbar-brand">
                <h1 class="text-primary display-6">Tickety</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white ms-4 me-2"
                    data-bs-toggle="modal" data-bs-target="#searchModal"><i
                        class="fas fa-search text-primary"></i></button>
                <a href="<?= "{$prefix}/home" ?>" class="nav-item nav-link active">Home</a>
                <?php if ($role === "customer" || !$user_id): // Don't show if user is admin               ?>
                    <a href="<?= "{$prefix}/contact" ?>" class="nav-item nav-link ">Contact</a>
                <?php endif; ?>

                
                <?php if ($role === "customer"): ?>
                    <a href="view-tickets" class="nav-item nav-link">Manage Tickets</a>
                <?php elseif ($role === "admin"): ?>
                    <a href="dashboard" class="nav-item nav-link">Dashboard</a>
                    <a href="<?= "{$prefix}/customerSupport" ?>" class="nav-item nav-link">Customer Support</a>
                <?php endif; ?>
                <form id="currencyForm" method="post" action="set_currency" class="me-3 d-inline-block">
                    <select class="currency-select" name="currency" id="currency" onchange="submitCurrencyForm()">
                        <option value="USD" <?php if ($_SESSION['currency'] == 'USD')
                            echo 'selected'; ?> >USD ($)
                        </option>
                        <option value="EUR" <?php if ($_SESSION['currency'] == 'EUR')
                            echo 'selected'; ?>>Euro (€)
                        </option>
                        <option value="GBP" <?php if ($_SESSION['currency'] == 'GBP')
                            echo 'selected'; ?>>Pound
                            (£)</option>
                    </select>
                </form>

            </div>
            <div class="collapse navbar-collapse bg-white justify-content-end" id="navbarCollapse">
                <?php if (!$user_id): // If user is not logged in             ?>
                    <button class="button" id="login-open">Login</button>
                    <button class="button" id="signup-open">Signup</button>

                <?php else: ?>
                    <form action="<?= "{$prefix}/logout" ?>" method="post">
                        <button class="button" id="logout-btn">Logout</button>
                    </form>
                </div>
                <?php if ($role === "customer"):            ?>
                    <?php $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);?>
                    <?php $notificationController = new notificationController();
                          $notificationController->addNearEventNotification($user_id);
                    ?>
                    <div class="notification">
                        <a href="#">
                            <div class="notBtn" href="#">
                                <?php $notificationController->displayNumberOfUnreadNotifications($user_id); ?>
                                <i class="fas fa-bell notification_icon"></i>
                                <div class="notifBox">
                                    <div class="notifDisplay">
                                        <div class="notifCont">
                                            <?php $notificationController->displayAllNotifications($user_id); ?>
                                            <a href="<?= "{$prefix}/notifications?function=deleteNotifications"?>" class="notifLink">
                                                <div class="clearBtn">
                                                    <button class="btn-clear">Clear All</button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
                <a href="<?= "{$prefix}/userProfile" ?>" class="my-auto d-flex flex-column align-items-center">
                    <i class="fas fa-user fa-2x"></i>
                    <span>Profile</span>
                </a>
            <?php endif; ?>

        </nav>
    </div>
</div>
<script>
    function submitCurrencyForm(){
        document.querySelector('#currencyForm').submit();
    }
</script>

<?php include 'src\Views\SignupLogin\signupLoginView.php' ?>