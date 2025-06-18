<script>
  const token = localStorage.getItem("token");
  if (!token) {
    alert("Harap login terlebih dahulu");
    window.location.href = "index.php";
  }
</script>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Tugas Saya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
  <div class="container">
    <h2 class="mb-4">Daftar Tugas Saya</h2>

    <a href="index.php?c=AppController&m=groupedTasks" class="btn btn-info mb-3">Group by Category</a>
    <a href="index.php?c=AppController&m=friendTasks" class="btn btn-secondary mb-3">Tugas Teman</a>
    <a href="#" onclick="logout()" class="btn btn-danger btn-sm float-end">Logout</a>


    <?php foreach ($tasks as $task):
      $deadline = strtotime($task['deadline']);
      $now = strtotime(date('Y-m-d'));
      $daysLeft = ($deadline - $now) / (60 * 60 * 24);

      if ($task['status'] === 'completed') {
        $cardClass = 'bg-success text-white';
      } elseif ($daysLeft <= 0) {
        $cardClass = 'bg-danger text-white';
      } elseif ($daysLeft <= 2) {
        $cardClass = 'bg-warning text-dark';
      } else {
        $cardClass = 'bg-light text-dark';
      }
    ?>
      <div class="card mb-2 <?= $cardClass ?>">
        <div class="card-body">
          <strong><?= htmlspecialchars($task['title']) ?></strong><br>
          <small><?= $task['deadline'] ?> | <?= $task['category'] ?></small>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
<script>
  function logout() {
    localStorage.removeItem("token");
    window.location.href = "index.php?c=AppController&m=login";
  }
</script>

</html>