<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | Dashboard</title>
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/dashboard.css">
</head>
<body>
    <?php require_once("./views/components/header.php"); ?>
    <section class="parent-c ">
        <div class="dash-titles max-content">
            <h1 class="dash-title">Welcome back, Mohammed Bentalb</h1>
            <h1 class="dash-subTitle">Continue your learning journey</h1>
        </div>
        <ul class="statistics">
            <li class="stat">
                <p>total courses</p>
                <p><?= $totalcourses["total_courses"] ?></p>
            </li>
            <li class="stat">
                <p>total users</p>
                <p><?= $totalUsers["total_users"] ?></p>
            </li>
            <li class="stat">
                <p>AVG sections per course</p>
                <p><?= number_format($averageSectionPerCourse['average_section'], 1) ?></p>
            </li>  
            <li class="stat">
                <p>AVG sections per course</p>
                <p><?= number_format($averageSectionPerCourse['average_section'], 1) ?></p>
            </li>  
        </ul>
        <h2 class="dash-section-title max-content">total inscriptions per course</h2>
        <div class="dash-body max-content">
            <div class="course-list max-content">
                <ul>
                    <?php foreach($courseAndNumberOfEnrollments as $course){?>
                    <li>
                        <div class="course-detail">
                            <div class="course-img">
                                <img src="/public/images/<?= $course->image ?>" alt="">
                            </div>
                                <p><?= $course->title ?></p>
                            </div>
                        <p><?= $course->enrollment ?> enrolment</p>
                    </li>
                    <?php }?>
                </ul>
            </div>
                <div class="most-popular">
                    <div class="most-populr-titles">
                        <h2>Most popular</h2>
                        <h3>Based on subscriptions</h3>
                    </div>
                    <div class="most-popular-img">
                        <img src="/public/images/<?= $popularCourse->image ?>" alt="">
                    </div>
                    <p class="most-popular-type"><?=  $popularCourse->type ?></p>
                    <h3 class="most-populat-title"><?= $popularCourse->title ?></h3>
                    <a class="most-popular-view" href="/courses/detail/<?= $popularCourse->id ?>">View</a>
                </div>
            </div>
            <?php foreach($usersWithNoInsriptions as $user){ ?>
            <p><?= $user->name ?></p>    
            <?php } ?>
        </section>
</body>
</html>