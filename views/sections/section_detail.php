<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="stylesheet" href="../../styles/detail_section.css">
    <title>LMS | SECTION </title>
</head>
<body>
    <?php
        require_once('./views/components/header.php');
        require_once('./views/components/Back.php');
        require_once('./util/functions/formatDate.php');
    ?>
    <section class="max-content detail-container" style="margin: auto;">
        <p class=""><?= $course ? $course->type : "" ?></p>
        <h1><?= $section->title ?> <span>—</span></h1>
        <div>
            <a href="#">Mohammed Bentalb</a> 
            <img src="../../assets/motif-1.png" alt="motif" aria-hidden="true">
            <p><?= $section->castDate() ?></p>
        </div>
        <p><?= $section->content ?></p>

        <button>Read more</button>
        <div class="max-content course-actions">
            <a class="edit-btn" href="/sections/form/edit/<?= $section->id ?>">edit<img src="../../assets/edit.png" alt="edit section"> </a>
            <a class="delete-btn" href="/sections/delete/<?= $section->id ?>">delete <img src="../../assets/delete.png" alt="delete section"></a>
        </div>
    </section>
</body> 
</html>