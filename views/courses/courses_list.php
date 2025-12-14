        <ul class="courses-list max-content">
            <?php
            foreach($courses as $course){  ?>
            <li class="">
                <a href="?v=courses&<?="action=detail&course_id={$course->id}"?>" class="course">
                    <div class="course-img">
                        <p><?= $course->level ?></p>
                        <img src="../../public/images/<?= $course->image ?>" alt="">
                    </div>
                    <p class="course-title"><?= $course->title ?></p>
                    <p class="course-type"><?= $course->type ?></p>
                </a>
            </li>
            <?php
                }
            ?>
        </ul>