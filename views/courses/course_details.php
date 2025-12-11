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
    <?php include_once("./views/components/header.php"); ?>
    <section class="course-detail-section parent-c no-p">
        <div class="detail-container max-content">
            <div class="detail-img">
                <img src="../../public/images/<?= $course[0]['image']?>"  alt="">
            </div>
            <div class="detail-text">
                <div class="progress">
                    <div class="progress-bar-outer">
                        <div class="progress-bar-inner"></div>
                    </div>
                    <p>%60 watched</p>
                </div>
                <div class="detail-info">
                    <p>Last updated: <?= explode(" ", $course[0]["updated_at"])[0] ?></p>
                    <h2><?= $course[0]['title'] ?></h2>
                    <p><?= $course[0]["description"]?></p>
                </div>
                <div class="detail-stats">
                    <div class="stat-d"><span><img src="../../assets/time.png" alt=""></span>13h</div>
                    <div class="stat-d"><span><img src="../../assets/star.png" alt=""></span> 4.5</div>
                </div>
                <button>start the course</button>
            </div>
        </div>
        <div class="max-content course-actions">
            <a class="edit-btn" href="?v=courses&action=form&course_id=<?=$course[0]['id']?>">edit <img src="../../assets/edit.png" alt="edit course"> </a>
            <a class="delete-btn">delete <img src="../../assets/delete.png" alt="delete course"></a>
        </div>
    </section>
    <section class="parent-c">
        <h2 class="max-content">What you will be learning</h2>
        <div class="detail-sections-list max-content">
            <?php
            foreach($courseSections as $key => $val){ ?>
            <div class="detail-section ">
                <div>
                    <h3><?= $val['title'] ?></h3>
                    <p><?= $val['content'] ?></p>
                </div>
                <button>see more <img src="../../assets/arrow-left.png" alt=""></button>
            </div>
            <?php 
            }
            ?>
        </div>
    </section>
</body>
</html>