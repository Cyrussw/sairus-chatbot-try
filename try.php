<?php

require ('65475.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $word = strtolower(trim($_POST['word']));

    try {
        if (!empty($word)) {
            $sql = "SELECT * FROM wordlist WHERE word = :word";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":word", $word, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) == 0) {
                $randomResponses = array(
                    "Tamam",
                    "Evet",
                    "Hayır",
                    "Kesinlikle",
                    "Olabilir",
                    "Düşünmem gerek",
                    "Neden olmasın",
                    "Anladım",
                    "Elbette",
                    "Tabii ki",
                    "Doğru",
                    "Yanlış",
                    "Daha sonra tekrar dene",
                    "Bu konuda biraz daha düşünebiliriz",
                    "Karar vermek zor",
                    "Her şey yoluna girecek",
                    "İşte bu!",
                    "Şimdi olmayabilir ama ilerleyen zamanlarda olabilir",
                    "Bunu biraz daha araştırmalıyım"
                );
                $randomIndex = rand(0, count($randomResponses) - 1);
                $result = $randomResponses[$randomIndex];
            } elseif (count($result) > 1) {
                $randomIndex = rand(0, count($result) - 1);
                $result = $result[$randomIndex]["response"];
            } else {
                $result = $result[0]["response"];
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
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
                    <p class="has-text-centered">Konuşmaya Başlayın!</p>

                    <?php
                    echo "<br>";
                    if (isset($_POST['word'])) {
                        if (isset($result)) {
                            ?>
                            <article class="message">
                                <div class="message-body">
                                    <b>Siz:</b> <?php echo $word; ?><br>
                                    <?php echo "<b>Sairus AI: </b>", $result; ?>
                                </div>
                            </article>
                            <?php
                        } else {
                            ?>
                            <article class="message">
                                <div class="message-body">
                                    <b>Sairus AI:</b> Sonuç Bulunamadı!<br>
                                </div>
                            </article>
                            <?php
                        }
                    }
                    ?>

                    <br>
                    <textarea class="textarea" placeholder="Kelime" rows="10" name="word" required></textarea>
                    <br>
                    <div class="buttons is-centered">
                        <button class="button is-info">Gönder</button>
                    </div>
                </form>

                <p>Sisteme kelime ekleyin. <a href="/">Kelime Ekle!</a></p>
            </div>
        </div>
    </section>
</body>

</html>