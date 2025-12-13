<?php
        foreach($courseSections as $key => $val){ ?>
            <div class="detail-section ">
                <div>
                    <h3><?= $val['title'] ?></h3>
                    <p><?= $val['content'] ?></p>
                </div>
                <a href="?v=sections&action=detail&section_id=<?= $val['id'] ?>">see more <img src="../../assets/arrow-left.png" alt="arrow icon"></a>
            </div>
<?php 
        }
?>