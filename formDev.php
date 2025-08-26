<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>เพิ่มข้อมูลอุปกรณ์</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #00ffddff, #ff00bfff);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}
.form-card {
    background: #fff;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 500px;
}
.form-card h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}
.form-control {
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    font-size: 15px;
}
.form-control:focus {
    border-color: #4facfe;
    box-shadow: 0 0 8px rgba(79,172,254,0.4);
    outline: none;
}
.btn-save {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #4facfe, #00c6ff);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}
.btn-save:hover {
    background: linear-gradient(135deg, #00c6ff, #4facfe);
    transform: scale(1.03);
}
</style>
</head>
<body>
<div class="form-card">
    <h2>เพิ่มข้อมูลอุปกรณ์</h2>
    <form action="addDev.php" method="post">
        <input type="text" name="dev_name" placeholder="ชื่ออุปกรณ์" class="form-control" required>
        <input type="number" step="0.01" name="price" placeholder="ราคาอุปกรณ์" class="form-control">
        <input type="number" step="1" name="amount" placeholder="จำนวน" class="form-control">
        <input type="text" name="location" placeholder="สถานที่เก็บ" class="form-control">
        <button type="submit" class="btn-save">💾 บันทึก</button>
    </form>
</div>
</body>
</html>
