<?php
include 'configuration.php';
include 'database.php';
include 'configuration_sql.php';

$dbConnection = connectToDatabase();
$messageBoardCategories = getCategory($dbConnection);
$messageBoardItems = getItems($dbConnection);

$config = [
    'tableHeaders' => [
        'email' => 'Электронная почта',
        'category' => 'Категория объявления',
        'title' => 'Заголовок объявления',
        'description' => 'Текст объявления'
    ]
];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Laba5</title>
    <meta charset="UTF-8">
</head>

<body>
<form name="userAd" action="storage.php" method="post">
    <label>Add ad:</label><br><br>
    <label>Ad category:</label><br>
    <select name="adCategory">

        <?php
        foreach (crt::$allcategories as $categoryName) {
            echo "<option>" . $categoryName . "</option>";
        }
        ?>

    </select><br><br>
    <label>Ad name:</label>
    <input name="adTitle"><br><br>
    <label>Your email:</label>
    <input name="adEmail"><br><br>
    <label>Ad text:</label><br>
    <textarea name="adText" rows="10" cols="150"></textarea><br><br>
    <button type="submit">Send Ad</button>
</form>

<p>Ad list:</p>
<table border="1">
    <tr>
        <th>Category</th>
        <th>Name</th>
        <th>Email</th>
        <th>Text</th>
    </tr>

    <?php
    foreach (crt::$adsDict as $categoryName => $categoryData) {
        foreach ($categoryData as $titleEmailText) {
            echo "<tr>";
            echo "<td>" . $categoryName . "</td>";
            echo "<td>" . $titleEmailText['title'] . "</td>";
            echo "<td>" . $titleEmailText['email'] . "</td>";
            echo "<td>" . $titleEmailText['text'] . "</td>";
            echo "</tr>";
        }
    }
    ?>

</table>
</body>
</html>