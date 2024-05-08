<?php

require ('65475.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $word = strtolower(trim($_POST['word']));
    $response = strtolower(trim($_POST['response']));

    if (!empty($word) || !empty($response)) {
        $sql = "INSERT INTO wordlist (word, response) VALUES (:word, :response)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":word", $word, PDO::PARAM_STR);
        $stmt->bindParam(":response", $response, PDO::PARAM_STR);
        $stmt->execute();

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <title>Sairus AI</title>
</head>

<body>
    <section class="section">
        <div class="container">
            <div class="box">
                <form action="" method="post">
                    <h1 class="title is-size-1 has-text-centered">Sairus AI</h1>
                    <p class="has-text-centered">Bir kelime ve karşılığını giriniz. (Kural Yoktur!)</p>
                    <br>
                    <textarea class="textarea" placeholder="Kelime" rows="10" name="word" required></textarea>
                    <br>
                    <textarea class="textarea" placeholder="Kelimenin karşılığı" rows="10" name="response"
                        required></textarea>
                    <br>
                    <div class="buttons is-centered">
                        <button class="button is-info">Gönder</button>
                    </div>
                </form>

                <p>Sistemi Deneyin. <a href="/try.php">Dene!</a></p>
            </div>
        </div>
    </section>
</body>

</html>