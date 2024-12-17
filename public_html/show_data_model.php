<?php
// Database Connection
$dsn = "mysql:host=db;dbname=sample_db;charset=utf8mb4";
$username = "admin";
$password = "1234";
try {
    // สร้าง PDO connection
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // เรียกใช้ TitanicModel
    require_once 'TitanicModel.php';
    $model = new TitanicModel($pdo);
    // ดึงข้อมูลทั้งหมดจาก Model
    $rows = $model->getAll();
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titanic Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Titanic Passenger Data</h2>
        <?php if (!empty($rows)): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Index</th>
                        <th>Passenger ID</th>
                        <th>Survived</th>
                        <th>Pclass</th>
                        <th>Name</th>
                        <th>Sex</th>
                        <th>Age</th>
                        <th>SibSp</th>
                        <th>Parch</th>
                        <th>Ticket</th>
                        <th>Fare</th>
                        <th>Cabin</th>
                        <th>Embarked</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['index']); ?></td>
                            <td><?php echo htmlspecialchars($row['PassengerId']); ?></td>
                            <td><?php echo htmlspecialchars($row['Survived']); ?></td>
                            <td><?php echo htmlspecialchars($row['Pclass']); ?></td>
                            <td><?php echo htmlspecialchars($row['Name']); ?></td>
                            <td><?php echo htmlspecialchars($row['Sex']); ?></td>
                            <td><?php echo htmlspecialchars($row['Age']); ?></td>
                            <td><?php echo htmlspecialchars($row['SibSp']); ?></td>
                            <td><?php echo htmlspecialchars($row['Parch']); ?></td>
                            <td><?php echo htmlspecialchars($row['Ticket']); ?></td>
                            <td><?php echo htmlspecialchars($row['Fare']); ?></td>
                            <td><?php echo htmlspecialchars($row['Cabin']); ?></td>
                            <td><?php echo htmlspecialchars($row['Embarked']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No records found in the Titanic table.</p>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>