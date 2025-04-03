<?php
// Database Connection
$servername = "db";
$username = "admin";
$password = "1234";
$dbname = "sample_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Pagination Setup
$items_per_page = 20; // จำนวนรายการต่อหน้า
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // หน้าปัจจุบัน
$offset = ($current_page - 1) * $items_per_page; // คำนวณ OFFSET
// Fetch Total Records
$total_sql = "SELECT COUNT(*) AS total FROM titanic";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $items_per_page); // จำนวนหน้าทั้งหมด
// Fetch Paginated Data
$sql = "SELECT * FROM titanic LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);
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
        <?php if ($result->num_rows > 0): ?>
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
                <?php while ($row = $result->fetch_assoc()): ?>
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
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <!-- Pagination Links -->
        <nav>
            <ul class="pagination justify-content-center">
                <!-- Previous Page Link -->
                <li class="page-item <?php echo $current_page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a>
                </li>
                <!-- Page Number Links -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <!-- Next Page Link -->
                <li class="page-item <?php echo $current_page >= $total_pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php else: ?>
        <p class="text-center">No records found in the Titanic table.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>