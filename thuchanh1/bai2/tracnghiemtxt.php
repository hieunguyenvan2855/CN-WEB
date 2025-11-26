<?php
$filename = __DIR__ . "/Quiz.txt";
if (!file_exists($filename)) {
    die("Không tìm thấy file Quiz.txt");
}

$content = file_get_contents($filename);

// Tách các câu hỏi theo khoảng trắng dòng
$raw_questions = preg_split("/\n\s*\n/", trim($content));

$questions = [];
foreach ($raw_questions as $q) {
    $lines = explode("\n", trim($q));
    $question_text = $lines[0];
    $options = [];
    $answer = "";

    foreach ($lines as $line) {
        if (preg_match("/^[A-D]\./", $line)) {
            // Ví dụ: "A. TextView"
            $key = substr($line, 0, 1);
            $text = trim(substr($line, 2));
            $options[$key] = $text;
        }
        if (strpos($line, "ANSWER:") !== false) {
            $answer = trim(str_replace("ANSWER:", "", $line));
        }
    }

    $questions[] = [
        "question" => $question_text,
        "options" => $options,
        "answer" => $answer
    ];
}

$score = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($questions as $i => $q) {
        $user = $_POST["q$i"] ?? "";
        if ($user == $q['answer']) $score++;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bài thi trắc nghiệm Android</title>
</head>
<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #eef2f7;
        margin: 0;
        padding: 40px 15%;
        color: #333;
    }

    h1 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 30px;
        color: #2457c5;
        font-weight: bold;
    }

    form {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .question-block {
        background: #f9fbff;
        border-left: 5px solid #4a6cf7;
        padding: 18px;
        margin-bottom: 25px;
        border-radius: 10px;
        transition: 0.3s;
    }

    .question-block:hover {
        background: #eef3ff;
        transform: translateX(3px);
    }

    .question-block b {
        font-size: 20px;
        display: block;
        margin-bottom: 12px;
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
        margin: 20px auto 0;
        padding: 14px 30px;
        background: #4a6cf7;
        border: none;
        color: white;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.25s;
    }

    button:hover {
        background: #2f4fd9;
        transform: translateY(-2px);
    }

    /* Hiển thị kết quả */
    h2 {
        margin-top: 40px;
        color: #0c6d37;
        font-size: 26px;
        font-weight: bold;
    }

    .result {
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 12px;
        font-size: 18px;
    }

    .correct {
        background: #d5f8e4;
        border-left: 6px solid #0c8f33;
    }

    .wrong {
        background: #ffe1e1;
        border-left: 6px solid #d92c2c;
    }

    h3 {
        text-align: center;
        font-size: 24px;
        margin-top: 20px;
        color: #ba1a67;
    }
</style>

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
        ?>
            <p>Câu <?= $i+1 ?>: <?= $user == $q['answer'] ? "✅ Đúng" : "❌ Sai (Đáp án: ".$q['answer'].")" ?></p>
        <?php endforeach; ?>
        <h3>Tổng điểm: <?= $score ?> / <?= count($questions) ?></h3>
    <?php endif; ?>
</body>
</html>
