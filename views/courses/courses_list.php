        <ul class="courses-list max-content">
            <?php
            foreach($courses as $key => $val){  ?>
            <li class="">
                <a href="?v=courses&<?="action=detail&course_id={$val["id"]}"?>>" class="course">
                    <div class="course-img">
                        <p><?= $val['level'] ?? "document" ?></p>
                        <img src="../../public/images/<?= $val['image']?>" alt="">
                    </div>
                    <p class="course-title"><?= $val['title']?></p>
                    <p class="course-type"><?= $val['type'] ?? "document" ?></p>
                </a>
            </li>
            <?php
                }
            ?>
        </ul>