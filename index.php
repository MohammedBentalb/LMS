<?php 
    require_once("db.php");
    

    $stm = mysqli_prepare($conn, "SELECT * FROM courses");

    if(!$stm){
        die("heeelp");
    }
    
    mysqli_stmt_execute($stm);

    $preResult = mysqli_stmt_get_result($stm);
    $result = mysqli_fetch_all($preResult, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css"/>
    <link rel="stylesheet" href="styles/index.css"/>
    <link rel="stylesheet" href="styles/search.css"/>
    <title>LMD</title>
</head>
<body>
    <!-- header section -->
    <header class="parent-c">
        <div class="max-content">
            <div>
                <h1>Explore</h1>
                <div>
                    <label for="create-course">...</label>
                    <button class="button blue">create new <img src="assets/arrow.png" alt=""></button>
                </div>
            </div>
            <p class="muted">Find learning, topics of interest, and workspaces to collaborate with oothers</p>
        </div>
    </header>

    <!-- search section -->

    <div class="parent">
        <div class="search-container max-content">
            <div class="search">
                <img src="assets/search-icon.png" alt="">
                <input type="text" placeholder="search the courses" required>
            </div>
            <div class="filteration">
                <button>category</button>
                <button>category</button>
            </div>
        </div>
    </div>

    <table class="table">
        <tr>

            <?php
                foreach (array_keys($result[0]) as $key){
                    echo "<th>{$key}</th>";
                }
            ?>
        </tr>
        
            <?php 
                foreach($result as $k => $val){
                    echo "<tr>";
                    foreach($val as $title => $value){
                        echo "<th>$value</th>";
                    }
                    echo "</tr>";
                }
            ?>
        
    </table>
</body>
</html>