<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/constants.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Cobra Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
</head>

<?php require 'constants/header.php'; ?>
<div class="content-my">

    <div class="card" style="width: 18rem; background-image: url('img/rain.jpg')">

        <div class="card-body">
            <h5 id="name-su" class="card-title"></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-su" class="list-group-item"> </li>
            <li id="country-su" class="list-group-item"> </li>
            <li id="humidity-su" class="list-group-item"> </li>
        </ul>
        <div class="card-body">

        </div>
    </div>

    <div class="card" style="width: 18rem; background-image: url('img/rain.jpg')">

        <div class="card-body">
            <h5 id="name-bg" class="card-title">Beograd</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-bg" class="list-group-item"> </li>
            <li id="country-bg" class="list-group-item"> </li>
            <li id="humidity-bg" class="list-group-item"> </li>
        </ul>
        <div class="card-body">

        </div>

    </div>

    <div class="card" style="width: 18rem; background-image: url('img/rain.jpg')">

        <div class="card-body">
            <h5 id="name-ns" class="card-title"></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-ns" class="list-group-item"> </li>
            <li id="country-ns" class="list-group-item"> </li>
            <li id="humidity-ns" class="list-group-item"> </li>
        </ul>
        <div class="card-body">

        </div>

    </div>

    <div class="card" style="width: 18rem; background-image: url('img/sunny2.jpg')">

        <div class="card-body">
            <h5 id="name-ni" class="card-title"></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-ni" class="list-group-item"> </li>
            <li id="country-ni" class="list-group-item"> </li>
            <li id="humidity-ni" class="list-group-item"> </li>
        </ul>
        <div class="card-body">

        </div>

    </div>

    <div class="card" style="width: 18rem; background-image: url('img/rain.jpg')">

        <div class="card-body">
            <h5 id="name-zr" class="card-title"></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-zr" class="list-group-item"> </li>
            <li id="country-zr" class="list-group-item"> </li>
            <li id="humidity-zr" class="list-group-item"> </li>
        </ul>
        <div class="card-body">

        </div>

    </div>
    <div class="card" style="width: 18rem; background-image: url('img/sunny2.jpg')">

        <div class="card-body">
            <h5 id="name-kg" class="card-title"></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-kg" class="list-group-item"> </li>
            <li id="country-kg" class="list-group-item"> </li>
            <li id="humidity-kg" class="list-group-item"> </li>
        </ul>
        <div class="card-body">

        </div>

    </div>
</div>

<?php require 'constants/footer.php'; ?>