<?php 
include 'bai1.php';   
?>
<style>
    body {
    font-family: "Segoe UI", Tahoma, sans-serif;
    background: linear-gradient(to bottom, #fffafc, #ffe6ef);
    margin: 0;
    padding: 40px 12%;
    color: #333;
}

h1 {
    text-align: center;
    font-size: 38px;
    margin-bottom: 50px;
    color: #d63384;
    letter-spacing: 1px;
}

.flower {
    background: #ffffffcc;
    padding: 25px;
    margin-bottom: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.flower:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.flower h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: #b30052;
    text-align: center;
}

.flower img {
    display: block;
    width: 100%;
    max-width: 450px;
    margin: 0 auto 20px auto;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
}

.flower p {
    font-size: 18px;
    line-height: 1.7;
    text-align: justify;
    padding: 0 10px;
    color: #444;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Danh sách hoa</title>
    <style>
        .flower { margin: 20px; }
        img { width: 200px; height: auto; }
    </style>
</head>
<body>

<h1>Những loài hoa đặc sắc</h1>

<?php foreach ($flowers as $flower): ?>
    <div class="flower">
        <h2><?php echo $flower['name']; ?></h2>
        <img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>">
        <p><?php echo $flower['mota']; ?></p>
    </div>
<?php endforeach; ?>

</body>
</html>
