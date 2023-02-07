<?php
require "config/config.php";
require "config/functions.php";
?>


<body>

    <header>


        <nav class="navbar">
            <a href='index.php'>
                <h1 class="logo" alt="logo global classroom" style="cursor: pointer;" href='index.php'>CobraWeather</h1>
            </a>
            <form class="search-input" method="POST" action="search.php">
                <input name="city_name" type="text" placeholder="search">
                <label for="sb"><img src="img/search.svg" alt="search icon" class="search-icon-my" style="cursor: pointer;"></label>
                <input id="sb" name="sb" type="submit" hidden>
            </form>
            <ul class="nav-menu">
                <li class="nav-item-my"><a href="index.php" class="nav-link-my">Home</a></li>
                <li class="nav-item-my"><a href="profile.php" class="nav-link-my">Profile</a></li>
                <?php
                if (!isset($_SESSION['user'])) { 
                ?>
                <li class="nav-item-my"><a href="login.php" class="nav-link-my">Become a G</a></li>
                <?php
                }
                if (isset($_SESSION['user'])) { ?>

                    <li class="nav-item-my"><a href="logout.php" class="nav-link-my">Logout</a></li>
                <?php } ?>
            </ul>


            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

        </nav>

    </header>