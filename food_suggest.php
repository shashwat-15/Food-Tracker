<!DOCTYPE html>
<?php 
    include "header.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <label for="">Ingredient</label>
    <select name="" id="ingredients">
        <option value="chicken">Chicken</option>
        <option value="rice">Rice</option>
    </select>
    <input type="button" value="Add" id="add_ingredient">
    <input type="button" value="Suggest" id="suggest_food">
</body>

<script src="js/suggest_food.js"></script>
</html>
