<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ac.css">
    <title>Admin panel</title>
</head>

<body>
    <header>
        <?php include '../config/config.php'; ?>


        <nav class="navbar">
            <a href='index.php'>
                <h1 class="logo" alt="logo global classroom" style="cursor: pointer;" href='index.php'>CobraW</h1>
            </a>

            <ul class="nav-menu">
                <li class="nav-item-my"><a href="index.php" class="nav-link-my">Favorites</a></li>
                <li class="nav-item-my"><a href="manage-users.php" class="nav-link-my">Users</a></li>
                <li class="nav-item-my"><a href="logs.php" class="nav-link-my">Logs</a></li>
                <li class="nav-item-my"><a href="logout.php" class="nav-link-my">Logout</a></li>
            </ul>


            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

        </nav>

    </header>