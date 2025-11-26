<?php
$filename = __DIR__ . "/questions.json";
if (!file_exists($filename)) {
    die("Không tìm thấy file questions.json");
}

$json = file_get_contents($filename);
$questions = json_decode($json, true);

if ($questions === null) {
    die("Lỗi JSON: " . json_last_error_msg());
}

$score = 0;

// Xử lý submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($questions as $i => $q) {
        $user = $_POST["q$i"] ?? "";
        $correct = $q['answer'];

        // Nếu answer là mảng
        if (is_array($correct)) {
            if (in_array($user, $correct)) {
                $score++;
            }
        } else {
            if ($user == $correct) {
                $score++;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài thi trắc nghiệm Android</title>
    <style>
       <style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #f3f6ff;
        margin: 0;
        padding: 30px 15%;
        color: #333;
    }

    h1 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 30px;
        color: #2a4d9b;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    form {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.1);
    }

    .question-block {
        background: #f8faff;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        border-left: 5px solid #4a6cf7;
        transition: 0.25s ease;
    }

    .question-block:hover {
        background: #eef3ff;
        transform: translateX(3px);
    }

    .question-block b {
        font-size: 20px;
        color: #222;
    }

    label {
        display: block;
        margin: 6px 0;
        font-size: 17px;
        cursor: pointer;
    }

    input[type="radio"] {
        transform: scale(1.2);
        margin-right: 8px;
        cursor: pointer;
    }

    button {
        display: block;
        margin: 20px auto 0 auto;
        padding: 12px 28px;
        background: #4a6cf7;
        border: none;
        color: #fff;
        font-size: 18px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.25s;
    }

    button:hover {
        background: #1f48e2;
        transform: translateY(-2px);
    }

    /* Kết quả */
    h2 {
        margin-top: 40px;
        font-size: 26px;
        color: #0d5c35;
    }

    .result {
        padding: 10px;
        background: #ffffffdd;
        border-left: 6px solid #0d5c35;
        margin-bottom: 10px;
        border-radius: 6px;
        font-size: 18px;
    }

    h3 {
        font-size: 24px;
        color: #d63384;
        text-align: center;
    }
</style>

    </style>
</head>
<body>
    <h1>Bài thi trắc nghiệm Android</h1>
    <form method="post">
        <?php foreach ($questions as $i => $q): ?>
            <p><b><?= ($i+1) . ". " . $q['question'] ?></b></p>
            <?php foreach ($q['options'] as $key => $text): ?>
                <label>
                    <input type="radio" name="q<?= $i ?>" value="<?= $key ?>"
                    <?= (isset($_POST["q$i"]) && $_POST["q$i"] == $key) ? "checked" : "" ?>>
                    <?= $key ?>. <?= $text ?>
                </label><br>
            <?php endforeach; ?>
            <br>
        <?php endforeach; ?>
        <button type="submit">Nộp bài</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Kết quả:</h2>
        <?php foreach ($questions as $i => $q): 
            $user = $_POST["q$i"] ?? "";
            $correct = $q['answer'];
            // Chuẩn hóa hiển thị đáp án đúng
            $correctDisplay = is_array($correct) ? implode(", ", $correct) : $correct;
        ?>
            <p>Câu <?= $i+1 ?>: <?= (is_array($correct) ? in_array($user, $correct) : $user == $correct) 
                ? "✅ Đúng" 
                : "❌ Sai (Đáp án: ".$correctDisplay.")" ?></p>
        <?php endforeach; ?>
        <h3>Tổng điểm: <?= $score ?> / <?= count($questions) ?></h3>
    <?php endif; ?>
</body>
</html>
