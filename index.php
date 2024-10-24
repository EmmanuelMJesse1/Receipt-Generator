<?php
// Read recipes from the JSON file
$json_data = file_get_contents('recipes.json');
$recipes = json_decode($json_data, true);

// Function to get a random recipe
function getRandomRecipe($recipes) {
    $random_recipe = $recipes[array_rand($recipes)];
    echo "<h2>Recipe: " . $random_recipe['name'] . "</h2>";
    echo "<h3>Ingredients:</h3><ul>";
    foreach ($random_recipe['ingredients'] as $ingredient) {
        echo "<li>" . $ingredient . "</li>";
    }
    echo "</ul>";
    echo "<p>Cooking time: " . $random_recipe['time'] . "</p>";
}


// Main logic
if (isset($_POST['get_recipe'])) {
    $max_time = isset($_POST['max_time']) ? (int)$_POST['max_time'] : 0;
    if ($max_time > 0) {
        $filtered_recipes = array_filter($recipes, function($recipe) use ($max_time) {
            $time = (int) filter_var($recipe['time'], FILTER_SANITIZE_NUMBER_INT);
            return $time <= $max_time;
        });
        if (!empty($filtered_recipes)) {
            getRandomRecipe($filtered_recipes);
        } else {
            echo "<p>No recipes available within that time range.</p>";
        }
    } else {
        getRandomRecipe($recipes);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Recipe Generator</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Random Recipe Generator</h1>
    <form method="POST">
    <label for="time">Maximum Cooking Time (minutes):</label>
    <input type="number" name="max_time" id="time">
    <button type="submit" name="get_recipe">Get a Recipe</button>
</form>

</body>
</html>

