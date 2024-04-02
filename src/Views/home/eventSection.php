<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Upcoming Events</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 130px;">All Events</span>
                            </a>
                        </li>
                        <?php foreach ($categories as $index => $category): ?>
                            <?php if (hasUpcomingEvents($eventsByCategory[$category])): ?>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-<?=
                                        // index + 2 in order to make tab starting from 2 -> number of categories + 1 since tab-1 reserved for all events
                                        $index + 2 ?>">
                                        <span class="text-dark" style="width: 130px;">
                                            <?= $category; ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php foreach ($upcomingEvents as $event): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative event-item">
                                            <div class="event-img">
                                                <img src="<?= $event->imagePath ?>" class="img-fluid w-100 rounded-top"
                                                    alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">
                                                <?= $event->category ?>
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>
                                                    <?= $event->name ?>
                                                </h4>
                                                <p class="text-dark fs-6 fw-bold mb-2">
                                                    <?= $event->eventDate; ?>
                                                </p>
                                                <p>
                                                    <?= $event->shortDescription ?>
                                                </p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">$
                                                        <?= $event->ticketPrice / 100 ?>
                                                    </p>
                                                    <?php 
                                                        $prefix = $_ENV['prefix'];
                                                     ?>
                                                    <a href="<?= "{$prefix}/event?id={$event->id}" ?>"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-eye me-2 text-primary"></i> View Event</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($categories as $index => $category): ?>
                    <div id="tab-<?= $index + 2 ?>" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php
                                    $currentCategoryUpcomingEvents = array_filter($eventsByCategory[$category], function ($event) {
                                        return strtotime($event->startSellTime) > time();
                                    });
                                    ?>
                                    <?php foreach ($currentCategoryUpcomingEvents as $event): ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative event-item">
                                                <div class="event-img">
                                                    <img src="<?= $event->imagePath ?>" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">
                                                    <?= $category ?>
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>
                                                        <?= $event->name ?>
                                                    </h4>
                                                    <p class="text-dark fs-6 fw-bold mb-2">
                                                        <?= $event->eventDate; ?>
                                                    </p>
                                                    <p>
                                                        <?= $event->shortDescription ?>
                                                    </p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$
                                                            <?= $event->ticketPrice / 100 ?>
                                                        </p>
                                                        <a href="<?= "{$prefix}/event?id={$event->id}" ?>"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-eye me-2 text-primary"></i> View Event</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>