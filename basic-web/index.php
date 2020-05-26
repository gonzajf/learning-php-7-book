<?php
$looking = isset($_GET['title']) || isset($_GET['author']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookstore</title>
</head>

<body>
    <p>
<?php
    if (isset($_COOKIE['username'])) {
        echo "You are " . $_COOKIE['username'];
    } else {
        echo "You are not authenticated.";
    }
?>
    </p>
<?php
if (isset($_GET['title']) && isset($_GET['author'])) {
?>
    <p>The book you are looking for is</p>
        <ul>
            <li><b>Title</b>: <?php echo $_GET['title']; ?></li>
            <li><b>Author</b>: <?php echo $_GET['author']; ?></li>
        </ul>
<?php
    } else {
?>
    <p>You are not looking for a book?</p>
<?php
    }
?>
</body>
</html>