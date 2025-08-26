<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Status</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <?php
  session_start(); // เพิ่มบรรทัดนี้เพื่อเริ่ม session

  require_once 'connect.php';

  // ตรวจสอบว่ามีการส่ง POST จริงหรือไม่
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    $alert_message = '';
    $alert_icon = '';
    $redirect_page = '';

    if (empty($username) || empty($password)) {
      $alert_message = 'กรุณากรอก username หรือ password';
      $alert_icon = 'warning';
      $redirect_page = 'login.php';
    } else {
      // ป้องกัน SQL Injection ด้วย prepared statement
      $stmt = $con->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $alert_message = 'ยินดีต้อนรับเข้าสู่ระบบ';
        $alert_icon = 'success';
        $redirect_page = 'showDev.php';
      } else {
        $alert_message = 'username or password invalid';
        $alert_icon = 'error';
        $redirect_page = 'login.php';
      }
      $stmt->close();
    }
  } else {
    // กรณีเข้าหน้านี้แบบไม่ส่ง POST
    $alert_message = 'กรุณากรอก username และ password ผ่านแบบฟอร์ม';
    $alert_icon = 'warning';
    $redirect_page = 'login.php';
  }
  ?>
  <script>
    swal({
      title: '<?php echo $alert_message; ?>',
      icon: '<?php echo $alert_icon; ?>',
      button: 'OK',
    }).then(function() {
      window.location = '<?php echo $redirect_page; ?>';
    });
  </script>
</body>

</html>
