<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calculator">
        <input type="text" id="display" readonly>
        <div class="buttons">
            <button type="button" data-value="(">(</button>
            <button type="button" data-value=")">)</button>
            <button type="button" class="clear" onclick="clearDisplay()">C</button>
            <button type="button" data-value="/">/</button>

            <button type="button" data-value="7">7</button>
            <button type="button" data-value="8">8</button>
            <button type="button" data-value="9">9</button>
            <button type="button" data-value="*">×</button>

            <button type="button" data-value="4">4</button>
            <button type="button" data-value="5">5</button>
            <button type="button" data-value="6">6</button>
            <button type="button" data-value="-">-</button>

            <button type="button" data-value="1">1</button>
            <button type="button" data-value="2">2</button>
            <button type="button" data-value="3">3</button>
            <button type="button" data-value="+">+</button>

            <button type="button" data-value="0">0</button>
            <button type="button" data-value=".">.</button>
            <button type="button" class="equals" onclick="calculate()">=</button>
        </div>
    </div>

    <script src="script.js"></script>

    <?php
    if (isset($_GET['result'])) {
        echo "<script>document.getElementById('display').value = '" . htmlspecialchars($_GET['result']) . "';</script>";
    }
    ?>
</body>
</html>