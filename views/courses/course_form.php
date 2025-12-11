<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/index.css" />
    <link rel="stylesheet" href="../../styles/course_form.css" />
    <title>LMS | create a course</title>
</head>
<body>
    <?php include_once("./views/components/header.php");?>
    <section class="parent-c">
    <h1 class="form-title max-content"><?= $editMode ? "Refine your course" : "Create the course you always wanted" ?></h1>
    <p class="form-sub-title max-content"><?= $editMode ? "Keep your knowledge fresh and up to date" : "Share your knowledge on a large scale" ?></p>
    <form action="<?= $editMode ? "?v=courses&action=edit&course_id=$course_id" : "?v=courses&action=create" ?>" method="POST" class="course-form" enctype="multipart/form-data">
        <div class="preview-image <?= $editMode ? "" : "is-hidden" ?>">
            <img class="" src="../../public/images/<?=  $editMode ? $course[0]['image'] : '' ?>" alt="">
        </div>
        <div class="form-field">
            <label for="course-title">what should we call the course</label>
            <input id="course-title" name="course-title" type="text" placeholder="What should we calll your course?" value="<?= $editMode ? $course[0]['title'] : '' ?>">
            <p class="error-field is-hidden" data-error-name="title" ></p>
        </div>
        <div class="form-field">
            <label for="course-image" class="img-lable">Course banner</label>
            <input type="file" id="course-image" name="course-image" id="course-image" accept=".jpg,.jpeg,.png.web">
            <p class="error-field <?= $fileError ? "" : ' is-hidden' ?>" data-error-name="image"><?= $fileError ? "incorrect file format" : '' ?></p>
            <p class="edit-image-field is-hidden" data-error-name="edit-image"></p>
        </div>
        <div class="form-field">
            <label for="course-level">What skill level is this course</label>
            <select name="course-level" id="course-level">
                <option value="beginner" <?= $editMode && $course[0]['level'] === 'beginner' ? 'selected' : '' ?>>Beginner</option>
                <option value="intermediate" <?= $editMode && $course[0]['level'] === 'intermediate' ? 'selected' : '' ?>>Intermediate</option>
                <option value="advanced" <?= $editMode && $course[0]['level'] === 'advanced' ? 'selected' : '' ?>>Advanced</option>
            </select>
            <p class="error-field is-hidden" data-error-name="type"></p>
        </div>
        <div class="form-field">
            <label for="course-type">what type of content is that?</label>
            <select name="course-type" id="course-type">
                <option value="document" <?= $editMode && $course[0]['course_type'] === 'document' ? 'selected' : '' ?>>Documents</option>
                <option value="bootcamp" <?= $editMode && $course[0]['course_type'] === 'bootcamp' ? 'selected' : '' ?>>Bootcamp</option>
                <option value="servey" <?= $editMode && $course[0]['course_type'] === 'servey' ? 'selected' : '' ?>>Research & servey</option>
            </select>
            <p class="error-field is-hidden" data-error-name="type"></p>
        </div>
        <div class="form-field">
            <label for="course-content">content:</label>
            <textarea name="course-content" id="course-content"><?= $editMode ? $course[0]['description'] : '' ?></textarea>
            <p class="error-field is-hidden" data-error-name="content"></p>
        </div>
        <button>Create course</button>
    </form>
    </section>
    <script src="../../js/courses/course_form.js" defer type="module"></script>
</body>
</html>