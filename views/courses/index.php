<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../styles/header.css" />
    <link rel="stylesheet" href="../../styles/index.css" />
    <link rel="stylesheet" href="../../styles/search.css" />
    <link rel="stylesheet" href="../../styles/courses.css" />
    <title>LMD</title>
  </head>
  <body>
    <!-- header section -->
    <?php include_once("./views/components/header.php"); ?>
    <header class="parent-c">
      <div class="max-content">
        <div>
          <h1>Explore</h1>
          <div>
            <a href="?v=courses&action=form">
              <button class="button blue">
                create new course
              </button>
            </a>
          </div>
        </div>
        <p class="muted">
          Find learning, topics of interest, and workspaces to collaborate with
          oothers
        </p>
      </div>
    </header>

    <!-- search section -->

    <div class="parent-c no-p">
      <div class="search-container max-content">
        <div class="search">
          <img src="../../assets/search-icon.png" alt="" />
          <input type="text" placeholder="Search the courses" required />
        </div>
        <div class="filtration">
          <select role="link" href="www.google.com">
            <option value="" disabled selected>category</option>
            <option value="all">all</option>
            <option value="all">web dev</option>
            <option value="all">Low Level</option>
          </select>
          <div>filter <img src="../../assets/arrow.png" class="blue-icon" alt=""></div>
        </div>
      </div>
    </div>


    <!-- courses content -->

    <section class="parent-c courses-c">
    <?php
        require("./views/courses/courses_list.php");
    ?>
    </section>
  </body>
</html>
