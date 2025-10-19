<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Fun Evaluator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Image Fun Evaluator</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data" id="uploadForm">
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" required>

        <label>Select categories to rate:</label>
        <div class="categories">
            <label><input type="checkbox" name="categories[]" value="Scary"> Scary</label>
            <label><input type="checkbox" name="categories[]" value="Funny"> Funny</label>
            <label><input type="checkbox" name="categories[]" value="Cute"> Cute</label>
            <label><input type="checkbox" name="categories[]" value="Weird"> Weird</label>
            <label><input type="checkbox" name="categories[]" value="Beautiful"> Beautiful</label>
        </div>

        <button type="submit">Evaluate!</button>
    </form>

    <?php if(isset($_SESSION['image_path'])): ?>
        <div class="result">
            <h2>Result:</h2>
            <img src="<?= $_SESSION['image_path'] ?>" alt="Uploaded Image">
            <div class="ratings">
                <?php foreach($_SESSION['ratings'] as $category => $score): ?>
                    <div class="rating">
                        <strong><?= $category ?>:</strong> 
                        <?= $score ?>/10
                        <div class="stars">
                            <?php for($i=0; $i<$score; $i++): ?>
                                ★
                            <?php endfor; ?>
                            <?php for($i=$score; $i<10; $i++): ?>
                                ☆
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php session_unset(); ?>
    <?php endif; ?>
</div>
<script src="script.js"></script>
</body>
</html>
