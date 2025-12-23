<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | ENROLLMy Courses</title>
    <link rel="stylesheet" href="/styles/header.css" />
    <link rel="stylesheet" href="/styles/index.css" />
    <link rel="stylesheet" href="/styles/courses.css" />
</head>
<body>
    <?php require_once('./views/components/header.php') ?>
    <section class="parent-c">
        <div class="myCourses-titles max-content">
            <h1>My Enrollments</h1>
            <h3>Explore our comprehensive library of courses across various topics</h3>
        </div>
    <?php require_once("./views/courses/courses_list.php") ?>
    </section>
</body>
</html>