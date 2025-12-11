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
    <h1 class="form-title max-content">Create the course you always wanted</h1>
    <p class="form-sub-title max-content">Share your knowledge on a large scale</p>
    <form action="?v=courses&action=create" method="POST" class="course-form" enctype="multipart/form-data">
        <div class="preview-image is-hidden">
            <img class="" src="../../assets/2.jpg" alt="">
        </div>
        <div class="form-field">
            <label for="course-title">what should we call the course</label>
            <input id="course-title" name="course-title" type="text" placeholder="What should we calll your course?">
            <p class="error-field is-hidden" data-error-name="title" ></p>
        </div>
        <div class="form-field">
            <label for="course-image" class="img-lable">Course banner</label>
            <input type="file" id="course-image" name="course-image" id="course-image" accept=".jpg,.jpeg,.png.web">
            <p class="error-field <?= $fileError ? "" : ' is-hidden' ?>" data-error-name="image"><?= $fileError ? "incorrect file format" : '' ?></p>
        </div>
        <div class="form-field">
            <label for="course-level">What skill level is this course</label>
            <select name="course-level" id="course-level">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
            <p class="error-field is-hidden" data-error-name="type"></p>
        </div>
        <div class="form-field">
            <label for="course-type">what type of content is that?</label>
            <select name="course-type" id="course-type">
                <option value="document">Documents</option>
                <option value="bootcamp">Bootcamp</option>
                <option value="servey">Research & servey</option>
            </select>
            <p class="error-field is-hidden" data-error-name="type"></p>
        </div>
        <div class="form-field">
            <label for="course-content">content:</label>
            <textarea name="course-content" id="course-content" ></textarea>
            <p class="error-field is-hidden" data-error-name="content"></p>
        </div>
        <button>Create course</button>
    </form>
    </section>
    <script src="../../js/courses/course_form.js" defer type="module"></script>
</body>
</html>