<?php     
    require_once("../brief-7/db/connection.php");

    $stm = mysqli_prepare($conn, "SELECT * FROM courses");

    if(!$stm){
        die("heeelp");
    }
    
    mysqli_stmt_execute($stm);

    $preResult = mysqli_stmt_get_result($stm);
    $result = mysqli_fetch_all($preResult, MYSQLI_ASSOC);

    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
    // foreach($result as $key => $val){
    //     var_dump($key);
    //     echo "<br/>";
    //     var_dump($val);
    //     echo "<br/>";
    //     echo "<br/>";
    //     echo "<br/>";
    // }
?>
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
    <header class="parent-c">
      <div class="max-content">
        <div>
          <h1>Explore</h1>
          <div>
            <button class="button blue">
              create new course
            </button>
          </div>
        </div>
        <p class="muted">
          Find learning, topics of interest, and workspaces to collaborate with
          oothers
        </p>
      </div>
    </header>

    <!-- search section -->

    <div class="parent-c">
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
        <ul class="courses-list max-content">
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>document</p>
                        <img src="../../assets/1.jpg" alt="">
                    </div>
                    <p class="course-title">human rights</p>
                    <p class="course-type">document</p>
                </a>
            </li>
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>bootcamp</p>
                        <img src="../../assets/2.jpg" alt="">
                    </div>
                    <p class="course-title">facebook advertiving</p>
                    <p class="course-type">bootcamp</p>
                </a>
            </li>
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>cours</p>
                        <img src="../../assets/3.jpg" alt="">
                    </div>
                    <p class="course-title">expart cycle</p>
                    <p class="course-type">course</p>
                </a>
            </li>
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>tv show</p>
                        <img src="../../assets/4.jpg" alt="">
                    </div>
                    <p class="course-title">no wars!</p>
                    <p class="course-type">tv show</p>
                </a>
            </li>   
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>bootcamp</p>
                        <img src="../../assets/2.jpg" alt="">
                    </div>
                    <p class="course-title">facebook advertiving</p>
                    <p class="course-type">bootcamp</p>
                </a>
            </li>
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>document</p>
                        <img src="../../assets/1.jpg" alt="">
                    </div>
                    <p class="course-title">human rights</p>
                    <p class="course-type">document</p>
                </a>
            </li>
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>tv show</p>
                        <img src="../../assets/4.jpg" alt="">
                    </div>
                    <p class="course-title">no wars!</p>
                    <p class="course-type">tv show</p>
                </a>
            </li>
            <li class="">
                <a href="#" class="course">
                    <div class="course-img">
                        <p>cours</p>
                        <img src="../../assets/3.jpg" alt="">
                    </div>
                    <p class="course-title">expart cycle</p>
                    <p class="course-type">course</p>
                </a>
            </li>
        </ul>
    </section>

    <table class="table">
        <tr>

            <?php
                // foreach (array_keys($result[0]) as $key){
                //     echo "<th>{$key}</th>";
                // }
            ?>
        </tr>
        
            <?php 
                // foreach($result as $k => $val){
                //     echo "<tr>";
                //     // foreach($val as $title => $value){
                //     echo "<th>{$val['id']}</th>";
                //     echo "<th>{$val['title']}</th>";
                //     echo "<th>{$val['description']}</th>";
                //     echo "<th>{$val['level']}</th>";
                //     // }
                //     echo "</tr>";
                // }
            ?>
        
    </table>
  </body>
</html>
