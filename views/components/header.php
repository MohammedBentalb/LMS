<nav class="parent-c header">
    <div class="max-content">
        
        <a href="/">Course<span>F</span>low</a>
        <?php if(empty($_SESSION) && !isset($_SESSION['userId'])){ ?>
        <ul>
            <li><a class="auth-button">sign in</a></li>
            <li><a class="auth-button">sign up</a></li>
        </ul>
        <?php } else { ?>
                <div class="profile"> 
                    <img src="/assets/boy.png" alt="avatar">
                    <div class="options is-hidden">
                        <a href="/courses/myCourses">My courses</a>
                        <hr>
                        <a href="/dashboard">Dashboard</a>
                        <hr>
                        <a href="/auth/logout">Log out</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</nav>
<script src="/js/index.js" defer></script>