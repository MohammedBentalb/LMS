<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/index.css" />
    <link rel="stylesheet" href="../../styles/forms.css" />
    <title>LMS | create a section</title>
</head>
<body>
    <?php
     include_once("./views/components/header.php");
     include_once("./views/components/Back.php");
    ?>
    <section class="parent-c">
    <h1 class="form-title max-content"><?= $sEditMode ? "Improve This Section" : "Build Your Course Sections" ?></h1>
    <p class="form-sub-title max-content"><?= $sEditMode ? "Refine the content and keep your course sharp" : "Break your course into clear, engaging parts" ?></p>
    <form action="<?= $sEditMode ? "?v=sections&action=edit&section_id=$section_id" : "?v=sections&action=create&course_id=$course_id" ?>" method="POST" class="course-form" enctype="multipart/form-data">
        <?=  isset($_GET['last_position']) ? "<p class='error-field global-error' data-error-name='global'>position sent is taken, start from {$_GET['last_position']} or higher</p>" : null?>
        <div class="form-field">
            <label for="section-title">what should we call the section</label>
            <input id="section-title" name="section-title[]" type="text" placeholder="What should we calll your section?" value="<?= $sEditMode ? $section[0]['title'] : '' ?>">
            <p class="error-field is-hidden" data-error-name="title" ></p>
        </div>
        <div class="form-field">
            <label for="section-position">Section Order</label>
            <input id="section-position" name="section-position[]" type="number" placeholder="What should we calll your section?" value="<?= $sEditMode ? $section[0]['position'] : '' ?>">
            <p class="error-field is-hidden" data-error-name="position" ></p>
        </div>
        <div class="form-field">
            <label for="section-content">content:</label>
            <textarea name="section-content[]" id="section-content"><?= $sEditMode ? $section[0]['description'] : '' ?></textarea>
            <p class="error-field is-hidden" data-error-name="content"></p>
        </div>
        <div class="new-sections"></div>
        <button type="button" class="add-new-section">add section</button>
        <button>Create section</button>
    </form>
    </section>
    <script src="../../js/sections/section_form.js" defer type="module"></script>
</body>
</html>