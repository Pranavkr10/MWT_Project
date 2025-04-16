<?php
$correctAnswers = [
    'q1' => 'A',
    'q2' => 'B',
    'q3' => 'A',
    'q4' => 'A',
    'q5' => 'A',
    'q6' => 'A',
    'q7' => 'A',
    'q8' => 'A',
];

$score = 0;

// Avoid notices if a question is missing from POST
foreach ($correctAnswers as $question => $answer) {
    if (isset($_POST[$question]) && $_POST[$question] === $answer) {
        $score++;
    }
}

$username = isset($_POST['username']) ? trim($_POST['username']) : 'Anonymous';

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert result using prepared statement
$stmt = $conn->prepare("INSERT INTO results (username, score) VALUES (?, ?)");
$stmt->bind_param("si", $username, $score);
$stmt->execute();
$stmt->close();

echo "<h2>Thank you for taking the quiz, $username! Your score is $score / 8</h2>";

$conn->close();
?>
