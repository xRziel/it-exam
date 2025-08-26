<?php
session_start(); // ต้องเป็นบรรทัดแรกสุด (ก่อนมีการส่ง output ใด ๆ)

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "connect.php";
?>
<head>
  <!-- Existing -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #00ffddff, #ff00bfff);
        min-height: 100vh;
        padding: 40px 20px;
        color: #222;
    }

    .container {
        background: #ffffffdd;
        padding: 40px 35px;
        border-radius: 25px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        max-width: 1100px;
        margin: auto;
        backdrop-filter: blur(10px);
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #222;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-shadow: 1px 1px 2px #ccc;
    }

    p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    p a.btn.delete {
        font-size: 14px;
        padding: 7px 14px;
        vertical-align: middle;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 15px;
        text-decoration: none;
        color: white;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgb(0 0 0 / 0.1);
        user-select: none;
    }

    .btn.add {
        background: linear-gradient(135deg, #4facfe, #00c6ff);
        box-shadow: 0 4px 15px #00c6ffaa;
    }

    .btn.add:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px #00c6ffcc;
    }

    .btn.edit {
        background: linear-gradient(135deg, #ffb347, #ffcc33);
        color: #222;
        box-shadow: 0 4px 15px #ffcc3399;
    }

    .btn.edit:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px #ffcc33cc;
    }

    .btn.delete {
        background: linear-gradient(135deg, #ff5f6d, #ffc371);
        box-shadow: 0 4px 15px #ffc371aa;
    }

    .btn.delete:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px #ffc371cc;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        margin-top: 20px;
        font-size: 16px;
        color: #444;
    }

    table th, table td {
        padding: 14px 18px;
        text-align: center;
        vertical-align: middle;
    }

    table th {
        background: #4facfe;
        color: white;
        font-weight: 700;
        border-radius: 15px;
        user-select: none;
        box-shadow: 0 4px 12px rgb(79 172 254 / 0.6);
    }

    table tr {
        background: #f9faff;
        box-shadow: 0 6px 10px rgb(0 0 0 / 0.05);
        border-radius: 15px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    table tr:hover {
        background-color: #e0f3ff;
        box-shadow: 0 10px 25px rgb(79 172 254 / 0.3);
    }

    table td:first-child {
        font-weight: 600;
        color: #0077cc;
    }

    /* Link button inside table */
    table td a.btn {
        padding: 6px 12px;
        font-size: 14px;
        box-shadow: none;
    }

  </style>
</head>
<body>
<div class="container">
  <h2>ข้อมูลอุปกรณ์</h2>
  <p>ยินดีต้อนรับ, <?php echo $_SESSION['username']; ?> 
     | <a class="btn delete" href="logout.php"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a></p>
  <a class="btn add" href="formDev.php"><i class="bi bi-plus-circle"></i> เพิ่มข้อมูลใหม่</a>
  <table>
    <tr>
      <th>ลำดับที่</th>
      <th>ชื่ออุปกรณ์</th>
      <th>ราคาอุปกรณ์</th>
      <th>จำนวน</th>
      <th>สถานที่เก็บอุปกรณ์</th>
      <th>การจัดการ</th>
    </tr>
    <?php
    $sql = "SELECT * FROM device";
    $result = mysqli_query($con, $sql);
    $i=1;
    while($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row['dev_name']; ?></td>
      <td><?php echo number_format($row['price'], 2); ?> บาท</td>
      <td><?php echo $row['amount']; ?></td>
      <td><?php echo $row['location']; ?></td>
      <td>
        <a class="btn edit" href="editDev.php?dev_id=<?php echo $row['dev_id']; ?>"><i class="bi bi-pencil-square"></i> แก้ไข</a>
        <a class="btn delete" href="delDev.php?dev_id=<?php echo $row['dev_id']; ?>" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบข้อมูลนี้?');"><i class="bi bi-trash"></i> ลบ</a>
      </td>
    </tr>
    <?php $i++; } ?>
  </table>
</div>
</body>
</html>