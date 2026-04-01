<?php
require_once 'functions.php';

$message = '';

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if ($_POST['action'] === 'add') {
            $result = addStudent(
                $_POST['name'], $_POST['email'],
                $_POST['course'], $_POST['marks']
            );
            $message = $result['message'];
        }

        if ($_POST['action'] === 'update') {
            $result = updateStudent(
                $_POST['id'], $_POST['name'],
                $_POST['email'], $_POST['course'], $_POST['marks']
            );
            // Redirect to clear the URL and reset the form
            header('Location: index.php?msg=' . urlencode($result['message']));
            exit;
        }

        if ($_POST['action'] === 'delete') {
            $result = deleteStudent($_POST['id']);
            $message = $result['message'];
        }
    }
}

// Load student for editing if edit button clicked
$editStudent = null;
if (isset($_GET['edit'])) {
    $editStudent = getStudentById((int)$_GET['edit']);
}

$students = getAllStudents();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student CRUD App</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; color: #333; }
        h1 { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        .message { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; }
        .card { background: white; border-radius: 8px; padding: 24px; margin-bottom: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 16px; color: #2c3e50; }
        .form-group { margin-bottom: 14px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; font-size: 14px; }
        input[type=text], input[type=email], input[type=number] {
            width: 100%; padding: 10px; border: 1px solid #ccc;
            border-radius: 6px; font-size: 14px;
        }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; }
        .btn-primary { background: #2c3e50; color: white; }
        .btn-warning { background: #f39c12; color: white; }
        .btn-danger  { background: #e74c3c; color: white; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #2c3e50; color: white; }
        tr:hover { background: #f9f9f9; }
        .actions { display: flex; gap: 8px; }
    </style>
</head>
<body>

<h1>🎓 Student Management System</h1>
<div class="container">

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- ADD / EDIT FORM -->
    <div class="card">
        <h2><?= $editStudent ? '✏️ Edit Student' : '➕ Add New Student' ?></h2>
        <form method="POST">
            <input type="hidden" name="action" value="<?= $editStudent ? 'update' : 'add' ?>">
            <?php if ($editStudent): ?>
                <input type="hidden" name="id" value="<?= $editStudent['id'] ?>">
            <?php endif; ?>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required
                    value="<?= htmlspecialchars($editStudent['name'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required
                    value="<?= htmlspecialchars($editStudent['email'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Course</label>
                <input type="text" name="course" required
                    value="<?= htmlspecialchars($editStudent['course'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Marks</label>
                <input type="number" name="marks" step="0.01" min="0" max="100" required
                    value="<?= htmlspecialchars($editStudent['marks'] ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary">
                <?= $editStudent ? 'Update Student' : 'Add Student' ?>
            </button>
        </form>
    </div>

    <!-- STUDENTS TABLE -->
    <div class="card">
        <h2>📋 All Students</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th>
                    <th>Course</th><th>Marks</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['email']) ?></td>
                    <td><?= htmlspecialchars($s['course']) ?></td>
                    <td><?= $s['marks'] ?></td>
                    <td class="actions">
                        <a href="?edit=<?= $s['id'] ?>">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                        <form method="POST" onsubmit="return confirm('Delete this student?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $s['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>