<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $photo_name = basename($_FILES["photo"]["name"]);
    $target = "uploads/" . $photo_name;
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $pass, $photo_name);
    $stmt->execute();

    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 400px;
            margin: 80px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            color: #333;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #0d6efd;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h4 class="form-title">Tambah User Baru</h4>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            <input type="file" class="form-control" id="photo" name="photo" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
    </form>

    <div class="back-link">
        <a href="user.php">← Kembali ke daftar user</a>
    </div>
</div>

</body>
</html>
