<?php require_once dirname(__FILE__) . '/../config.php'; ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Kalkulator kredytowy</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { margin: 20px; padding: 20px; width: 300px; border: 1px solid #ccc; border-radius: 5px; }
        .result, .error-messages { margin: 20px; padding: 10px; border-radius: 5px; width: 300px; }
        .result { background-color: #ff0; }
        .error-messages { background-color: #f88; }
    </style>
</head>
<body>

<div class="form-container">
    <form action="<?= _APP_URL; ?>/app/calc.php" method="post">
        <label for="id_amount">Kwota kredytu:</label><br>
        <input id="id_amount" type="text" name="amount" value="<?= htmlspecialchars($amount ?? '') ?>"><br>

        <label for="id_years">Liczba lat:</label><br>
        <input id="id_years" type="number" name="years" value="<?= htmlspecialchars($years ?? '') ?>"><br>

        <label for="id_interest">Oprocentowanie roczne (%):</label><br>
        <input id="id_interest" type="number" name="interest" min="0" step="0.01" value="<?= htmlspecialchars($interest ?? '') ?>"><br>

        <input type="submit" value="Oblicz">
    </form>
</div>

<!--Wyświeltenie listy błędów, jeśli istnieją-->
<?php if (!empty($messages)): ?>
    <div class="error-messages">
        <ol>
            <?php foreach ($messages as $msg): ?>
                <li><?= htmlspecialchars($msg); ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
<?php endif; ?>

<?php if (isset($result)): ?>
    <div class="result">
        Miesięczna rata kredytu: <?= htmlspecialchars($result); ?> zł
    </div>
<?php endif; ?>

</body>
</html>
