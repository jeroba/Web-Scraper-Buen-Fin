<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            padding: 40px;
        }

        .search-input {
            padding: 6px 10px;
            width: 50%;
        }

        .search-button {
            padding: 6px 10px;
        }

        .lists-container {
            column-gap: 20px;
            display: flex;
            margin-top: 20px;
        }

        .list {
            width: 40%;
        }

        .list-item {
            background-color: #eee;
            border-radius: 5px;
            display: flex;
            column-gap: 10px;
            padding: 20px;
            box-shadow: 2px 2px 4px #eee;
            margin-bottom: 20px;
        }

        .list-item img {
            width: 100px;
        }

        .list-item .price {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php require('navbar.view.php')?>