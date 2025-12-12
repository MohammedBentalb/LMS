<?php
        foreach($courseSections as $key => $val){ ?>
            <div class="detail-section ">
                <div>
                    <h3><?= $val['title'] ?></h3>
                    <p><?= $val['content'] ?></p>
                </div>
                <button>see more <img src="../../assets/arrow-left.png" alt=""></button>
            </div>
<?php 
        }
?>