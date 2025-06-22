<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equation Solver</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div class="container">
        <h2>Equation Solver</h2>
        <form method="post">
            <label for="equation">Enter equation (e.g., x + 3 = 7):</label><br>
            <input type="text" id="equation" name="equation" required>
            <br>
            <button type="submit">Solve</button>
        </form>
        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $equation = trim($_POST['equation']);
                
                function solveEquation($equation) {
                    $equation = str_replace(' ', '', $equation);
                    $parts = explode('=', $equation);
                    if (count($parts) != 2) {
                        return ["error" => "Invalid equation format. Use x + a = b, x - a = b, x * a = b, or x / a = b."];
                    }
                    
                    $left = $parts[0];
                    $right = $parts[1];
                    
                    if (strpos($left, '+') !== false) {
                        $operator = '+';
                        $terms = explode('+', $left);
                        if (count($terms) != 2 || $terms[0] !== 'x') {
                            return ["error" => "Invalid format for + operator. Use x + a = b."];
                        }
                        $a = (int)$terms[1];
                        $x = (int)$right - $a;
                    } elseif (strpos($left, '-') !== false) {
                        $operator = '-';
                        $terms = explode('-', $left);
                        if (count($terms) != 2 || $terms[0] !== 'x') {
                            return ["error" => "Invalid format for - operator. Use x - a = b."];
                        }
                        $a = (int)$terms[1];
                        $x = (int)$right + $a;
                    } elseif (strpos($left, '*') !== false) {
                        $operator = '*';
                        $terms = explode('*', $left);
                        if (count($terms) != 2 || $terms[0] !== 'x') {
                            return ["error" => "Invalid format for * operator. Use x * a = b."];
                        }
                        $a = (int)$terms[1];
                        if ($a == 0) {
                            return ["error" => "Division by zero is not allowed (multiplication by 0)."];
                        }
                        $x = (int)$right / $a;
                    } elseif (strpos($left, '/') !== false) {
                        $operator = '/';
                        $terms = explode('/', $left);
                        if (count($terms) != 2 || $terms[0] !== 'x') {
                            return ["error" => "Invalid format for / operator. Use x / a = b."];
                        }
                        $a = (int)$terms[1];
                        if ($a == 0) {
                            return ["error" => "Division by zero is not allowed."];
                        }
                        $x = (int)$right * $a;
                    } else {
                        return ["error" => "Operator (+, -, *, /) not found."];
                    }
                    
                    return [
                        "operator" => $operator,
                        "variable_pos" => "first",
                        "solution" => $x
                    ];
                }
                
                $result = solveEquation($equation);
                if (isset($result['error'])) {
                    echo "<span class='error'>{$result['error']}</span>";
                } else {
                    echo "Operator: {$result['operator']}<br>";
                    echo "Variable position: {$result['variable_pos']} term<br>";
                    echo "Solution: x = {$result['solution']}";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>