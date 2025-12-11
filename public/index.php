<?php
require_once __DIR__ . '/../config.php';

// Xử lý form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($name !== '' && $content !== '') {
        $stmt = $pdo->prepare("INSERT INTO messages (name, content) VALUES (:name, :content)");
        $stmt->execute([
            ':name' => $name,
            ':content' => $content
        ]);
        header('Location: index.php'); // tránh submit lại
        exit;
    }
}

// Lấy danh sách messages
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Guestbook đơn giản</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 40px auto; }
        form { margin-bottom: 30px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
        .message { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 4px; }
        .meta { font-size: 12px; color: #666; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Guestbook</h1>

    <form method="post">
        <label>Tên của bạn:</label>
        <input type="text" name="name" required>

        <label>Lời nhắn:</label>
        <textarea name="content" rows="4" required></textarea>

        <button type="submit">Gửi</button>
    </form>

    <h2>Các lời nhắn gần đây</h2>

    <?php if (empty($messages)): ?>
        <p>Chưa có lời nhắn nào.</p>
    <?php else: ?>
        <?php foreach ($messages as $msg): ?>
            <div class="message">
                <div class="meta">
                    <strong><?php echo htmlspecialchars($msg['name']); ?></strong>
                    &bull;
                    <?php echo htmlspecialchars($msg['created_at']); ?>
                </div>
                <div>
                    <?php echo nl2br(htmlspecialchars($msg['content'])); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
