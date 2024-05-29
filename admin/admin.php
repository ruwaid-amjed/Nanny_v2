<?php
session_start();
include '../config/db.php';



// Retrieve messages from contact_us table
$sql = "SELECT * FROM contact_us";
$result_contact_us = $conn->query($sql);

// Retrieve sitters profiles
$sql = "SELECT * FROM users WHERE role='مربية'";
$result_sitters = $conn->query($sql);

// Retrieve statistics
$sql = "SELECT COUNT(*) AS count, role FROM users GROUP BY role";
$result_stats = $conn->query($sql);
$stats = [];
while ($row = $result_stats->fetch_assoc()) {
    $stats[$row['role']] = $row['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="admin.php">Nanny Admin Dashboard</a>
        </div>
        <div class="userOption">
            <select id="userOptions" onchange="handleSelectionlogout(this.value)">
                <option value="name" disabled selected>Admin</option>
                <option value="logout">Log Out</option>
            </select>
        </div>
    </header>

    <main>
        <section>
            <h2>Messages from Contact Us</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_contact_us->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Sitter Profiles</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_sitters->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['userID']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="../sittermainpage/sittermain.php?id=<?php echo $row['userID']; ?>">View</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <section class="statistics">
            <h2>Statistics</h2>
            <div class="stat-box">
                <div class="stat">
                    <h3>Parents</h3>
                    <p><?php echo isset($stats['عائلة']) ? $stats['عائلة'] : 0; ?></p>
                </div>
                <div class="stat">
                    <h3>Sitters</h3>
                    <p><?php echo isset($stats['مربية']) ? $stats['مربية'] : 0; ?></p>
                </div>
                <div class="stat">
                    <h3>Admins</h3>
                    <p><?php echo isset($stats['admin']) ? $stats['admin'] : 0; ?></p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Nanny. All rights reserved.</p>
    </footer>

    <script>
        function handleSelectionlogout(value) {
            if (value === 'logout') {
                window.location.href = '../login/login.php';
            }
        }
    </script>
</body>
</html>
