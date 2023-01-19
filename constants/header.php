<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Cobra Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
</head>

<body>

    <header>


        <nav class="navbar">
            <a href='index.php'><h1 class="logo" alt="logo global classroom" style="cursor: pointer;" href='index.php'>CobraW</h1></a>
            <form class="search-input" method="POST" action="search.php">
                <input name="city_name" type="text" placeholder="search">
                <label for="sb"><img src="img/search.svg" alt="search icon" class="search-icon-my" style="cursor: pointer;"></label>
                <input id="sb" name="sb" type="submit" hidden>
            </form>
            <ul class="nav-menu">
                <li class="nav-item-my"><a href="index.php" class="nav-link-my">Home</a></li>
                <li class="nav-item-my"><a href="onama.php" class="nav-link-my">About Us</a></li>
                <li class="nav-item-my"><a href="profile.php" class="nav-link-my">Profile</a></li>
            </ul>


            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

        </nav>

    </header>