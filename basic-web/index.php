<?php
require_once 'functions.php';
$looking = isset($_GET['title']) || isset($_GET['author']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookstore</title>
</head>

<body>
<?php
$booksJson = file_get_contents('books.json');
$books = json_decode($booksJson, true);
?>
<?php foreach ($books as $book): ?>
<ul>
    <li><?php echo printableTitle($book); ?> </li>
</ul>
<?php endforeach; ?>

    <p><?php echo loginMessage(); ?></p>

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