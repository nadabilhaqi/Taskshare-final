<script>
  const token = localStorage.getItem("token");
  if (!token) {
    alert("Harap login terlebih dahulu");
    window.location.href = "index.php";
  }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Tugas Teman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">
  <div class="container">
    <h1 class="mb-4">Tugas Teman</h1>

    <div class="mb-3">
      <a href="index.php?c=AppController&m=myTasks" class="btn btn-outline-primary">Tugas Saya</a>
      <a href="index.php?c=AppController&m=friendTasks" class="btn btn-primary">Tugas Teman</a>
    </div>

    <?php if (!empty($friendTasks)): ?>
      <?php foreach ($friendTasks as $task): ?>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($task['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($task['deadline']) ?> | <?= htmlspecialchars($task['category']) ?></p>
            <a href="index.php?c=AppController&m=copyTask&id=<?= $task['id'] ?>" class="btn btn-sm btn-outline-success">Copy</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Tidak ada tugas teman.</p>
    <?php endif; ?>

  </div>
</body>

</html>