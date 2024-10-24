<?php
// Database connection
$servername = "localhost";
$username = "root"; // Use your username
$password = ""; // Use your password
$dbname = "recipe_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert recipes
$sql = "INSERT INTO recipes (name, ingredients, time, instructions) VALUES
('Spaghetti Bolognese', 'Spaghetti, Ground Beef, Tomato Sauce, Garlic, Onion, Olive Oil', 30, '1. Cook spaghetti. 2. Fry garlic and onion. 3. Add ground beef, cook until brown. 4. Add tomato sauce.'),
('Chicken Stir Fry', 'Chicken Breast, Bell Pepper, Soy Sauce, Garlic, Onion, Olive Oil', 20, '1. Fry garlic and onion. 2. Add chicken breast, cook until brown. 3. Add bell pepper and soy sauce. 4. Stir-fry until cooked.'),
('Pancakes', 'Flour, Eggs, Milk, Sugar, Butter, Baking Powder', 15, '1. Mix dry ingredients. 2. Add milk and eggs. 3. Heat a pan with butter and cook pancakes.');";

if ($conn->query($sql) === TRUE) {
    echo "Recipes inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
