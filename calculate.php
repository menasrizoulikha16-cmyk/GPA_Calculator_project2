<?php
// 1. الاتصال بقاعدة البيانات (XAMPP)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gpa_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// التأكد من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = "Student_User"; // يمكنك تغييره لاستقبال اسم حقيقي
    $grades = $_POST['grade'];
    $credits = $_POST['credits'];

    $total_points = 0;
    $total_credits = 0;

    for ($i = 0; $i < count($grades); $i++) {
        $total_points += $grades[$i] * $credits[$i];
        $total_credits += $credits[$i];
    }

    $gpa = ($total_credits > 0) ? ($total_points / $total_credits) : 0;

    // 2. تخزين النتيجة في قاعدة البيانات (مطلوب في Step 4)
    $sql = "INSERT INTO results (student_name, gpa) VALUES ('$student_name', '$gpa')";

    if ($conn->query($sql) === TRUE) {
        // إرجاع النتيجة كـ JSON لكي يقرأها الجافا سكريبت ويحرك الشريط
        echo json_encode(["gpa" => round($gpa, 2), "status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
$conn->close();
?>
