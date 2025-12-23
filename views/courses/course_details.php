<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/index.css" />
    <link rel="stylesheet" href="../../styles/course_detail.css" />
    <title>LMS | course details </title>
</head>
<body>
    <?php
        require_once("./views/components/header.php");
        require_once("./views/components/Back.php");
        require_once("./util/functions/formatDate.php");
    ?>
    <section class="course-detail-section parent-c no-p">
        <div class="detail-container max-content">
            <div class="detail-img">
                <img src="../../public/images/<?= $course->image ?>"  alt="">
            </div>
            <div class="detail-text">
                <div class="progress">
                    <div class="progress-bar-outer">
                        <div class="progress-bar-inner"></div>
                    </div>
                    <p>%60 watched</p>
                </div>
                <div class="detail-info">
                    <p><?= $course->castDate() ?></p> 
                    <h2><?= $course->title ?></h2>
                    <p><?= $course->description?></p>
                </div>
                <div class="detail-stats">
                    <div class="stat-d"><span><img src="../../assets/time.png" alt=""></span>13h</div>
                    <div class="stat-d"><span><img src="../../assets/star.png" alt=""></span> 4.5</div>
                </div>
                <?php if(!$EnrolledIn) { ?><a href="/courses/enroll/<?= $course->id ?>">start the course</a> <?php } else { ?>
                    <a class="enrolled" href="/courses/disenroll/<?= $enrollment->id ?>">Enrolled</a>
                <?php }?>
            </div>
        </div>
        <div class="max-content course-actions">
            <a class="edit-btn" href="/courses/form/<?= $course->id ?>">edit <img src="../../assets/edit.png" alt="edit course"> </a>
            <a class="delete-btn" href="/courses/delete/<?= $course->id ?>">delete <img src="../../assets/delete.png" alt="delete course"></a>
        </div>
    </section>
    <section class="parent-c">
        <h2 class="max-content">What you will be learning</h2>
        <div class="detail-sections-list max-content">
            <?php require_once('./views/sections/sections_list.php'); ?>
            <a class="add-section" href="/sections/form/create/<?= $course->id ?>">
                <img src="../../assets/add.png" alt="add section"></button>
                <p>add new section</p>  
            </a>
        </div>
    </section>
</body>
</html>