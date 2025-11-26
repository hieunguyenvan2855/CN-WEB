<?php
$filename = __DIR__ . "/65HTTT_Danh_sach_diem_danh.csv";

if (!file_exists($filename)) {
    die("Không tìm thấy file CSV");
}

$rows = [];
if (($handle = fopen($filename, "r")) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $rows[] = $data;
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html>
<style>
    body {
    font-family: "Segoe UI", Tahoma, sans-serif;
    background: #f7f9fc;
    margin: 0;
    padding: 30px 10%;
}

h1 {
    text-align: center;
    color: #2a4d9b;
    font-size: 32px;
    margin-bottom: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,0.1);
}

th {
    background: #4a6cf7;
    color: white;
    padding: 12px;
    font-size: 18px;
}

td {
    padding: 10px;
    font-size: 16px;
    color: #333;
}

tr:nth-child(even) {
    background: #f2f6ff;
}

tr:hover {
    background: #e6edff;
    transition: 0.25s;
}
</style>
<head>
    <meta charset="UTF-8">
    <title>Danh sách điểm danh</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Danh sách điểm danh lớp 65HTTT</h1>
    <table>
        <tr>
            <?php foreach ($rows[0] as $header): ?>
                <th><?= htmlspecialchars($header) ?></th>
            <?php endforeach; ?>
        </tr>
        <?php for ($i = 1; $i < count($rows); $i++): ?>
            <tr>
                <?php foreach ($rows[$i] as $cell): ?>
                    <td><?= htmlspecialchars($cell) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>
