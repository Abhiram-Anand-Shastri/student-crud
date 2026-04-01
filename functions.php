<?php
require_once 'db.php';

// ── CREATE ───────────────────────────────────
function addStudent($name, $email, $course, $marks) {
    $conn = getConnection();
    $stmt = $conn->prepare(
        "INSERT INTO students (name, email, course, marks) VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("sssd", $name, $email, $course, $marks);

    if ($stmt->execute()) {
        $id = $conn->insert_id;
        $stmt->close(); $conn->close();
        return ['success' => true, 'message' => 'Student added!', 'id' => $id];
    }
    $err = $stmt->error;
    $stmt->close(); $conn->close();
    return ['success' => false, 'message' => 'Error: ' . $err];
}

// ── READ ALL ─────────────────────────────────
function getAllStudents() {
    $conn = getConnection();
    $result = $conn->query("SELECT * FROM students ORDER BY created_at DESC");
    $students = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $students;
}

// ── READ ONE ─────────────────────────────────
function getStudentById($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
    $stmt->close(); $conn->close();
    return $student;
}

// ── UPDATE ───────────────────────────────────
function updateStudent($id, $name, $email, $course, $marks) {
    $conn = getConnection();
    $stmt = $conn->prepare(
        "UPDATE students SET name=?, email=?, course=?, marks=? WHERE id=?"
    );
    $stmt->bind_param("sssdi", $name, $email, $course, $marks, $id);

    if ($stmt->execute()) {
        $stmt->close(); $conn->close();
        return ['success' => true, 'message' => 'Student updated!'];
    }
    $err = $stmt->error;
    $stmt->close(); $conn->close();
    return ['success' => false, 'message' => 'Error: ' . $err];
}

// ── DELETE ───────────────────────────────────
function deleteStudent($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close(); $conn->close();
        return ['success' => true, 'message' => 'Student deleted!'];
    }
    $err = $stmt->error;
    $stmt->close(); $conn->close();
    return ['success' => false, 'message' => 'Error: ' . $err];
}
?>