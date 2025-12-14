<?php
    if(!$courseSections) return;
        foreach($courseSections as $section){ ?>
            <div class="detail-section">
                <div>
                    <h3><?= $section->title ?></h3>
                    <p><?= $section->content ?></p>
                </div>
                <a href="?v=sections&action=detail&section_id=<?= $section->id ?>">see more <img src="../../assets/arrow-left.png" alt="arrow icon"></a>
            </div>
<?php 
        }
?>