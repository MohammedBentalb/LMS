        <ul class="courses-list max-content">
            <?php
            if(!isset($courses)) return;
            foreach($courses as $course){  ?>
            <li class="">
                <a href="/courses/detail/<?="{$course->id}"?>" class="course">
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