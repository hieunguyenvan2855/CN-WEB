<?php
    include 'bai1.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản trị hoa</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    </style>
</head>
<body>
    <h1>Bảng quản trị hoa</h1>
    <table>
        <tr>
            <th>Tên hoa</th>
            <th>Mô tả</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($flowers as $flower): ?>
        <tr>
            <td><?php echo $flower['name']; ?></td>
            <td><?php echo $flower['mota']; ?></td>
            <td><img src="<?php echo $flower['image']; ?>" width="100"></td>
            <td>
                <button>Sửa</button>
                <button>Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>