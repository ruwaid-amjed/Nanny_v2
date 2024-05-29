<?php
include '../config/db.php';  // Ensure path is correct

$city = $_POST['city'] ?? '';
$filter = $_POST['filter'] ?? '';

$sql = "SELECT 
    users.userID,info.f_name, info.l_name, info.gender, addr.city, bio.bioText, exp.paidYear,
    (price.maxPrice + price.minPrice) / 2 as averagePrice, files.path as profilePic
    FROM
        information info
    JOIN
        address addr ON info.addressID = addr.addressID
    JOIN
        bio ON info.bioID = bio.bioID
    JOIN
        experience exp ON info.expID = exp.expID
    JOIN
        price ON info.priceID = price.priceID
    JOIN
        files ON files.userID = info.informationID AND files.description = 'الصورة الشخصية'
        JOIN
        users ON users.informationID = info.informationID
    WHERE
        users.role = 'مربية'";

if (!empty($city)) {
    $sql .= " AND addr.city = '{$city}'";
}

if ($filter === 'price_asc') {
    $sql .= " ORDER BY averagePrice ASC";
} elseif ($filter === 'price_desc') {
    $sql .= " ORDER BY averagePrice DESC";
}

$result = $conn->query($sql);
    echo '<div class="card-container">';
while ($row = $result->fetch_assoc()) {
    echo '<div class="card">';
    echo '<div class="card-image"><img src="'.$row['profilePic'].'" alt="'.$row['f_name'].'"></div>';
    echo '<div class="card-info">';
    echo '<h2>'.$row['f_name'].' '.$row['l_name'].'</h2>';
    echo '<p>مربيه في '.$row['city'].'</p>';
    echo '<p class="ellipsis">'.$row['bioText'].'</p>';
    echo '<div class="card-details">';
    echo '<span>عدد سنوات الخبره : '.$row['paidYear'].'</span>';
    echo '</div>';
    echo '<div class="card-price">'.(float)$row['averagePrice'].' دينار للساعه</div>';
    echo '</div>';
    echo '<a href="../userSitter/sitter.php?userID='.$row['userID'].'" class="card-arrow">';
    echo '<i class="fas fa-chevron-right"></i>';
    echo '</a>';
    echo '</div>';
}
echo '</div>';

$conn->close();
?>
