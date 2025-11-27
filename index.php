<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Todo App</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-3">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Todo App</a>
    </div>
  </nav>

  <!-- Formulaire d'ajout -->
  <form method="post" class="mb-3">
    <div class="input-group">
      <input type="text" name="title" class="form-control" placeholder="Nouvelle tâche" required>
      <button type="submit" name="action" value="new" class="btn btn-primary">Ajouter</button>
    </div>
  </form>

  <!-- Liste des tâches -->
  <ul class="list-group">
    <?php foreach ($taches as $tache): ?>
      <li class="list-group-item <?php echo $tache['done'] ? 'list-group-item-success' : 'list-group-item-warning'; ?>">
        <?php echo htmlspecialchars($tache['title']); ?>
        <form method="post" class="d-inline float-end">
          <input type="hidden" name="id" value="<?php echo $tache['id']; ?>">
          <button type="submit" name="action" value="toggle" class="btn btn-sm btn-secondary">Toggle</button>
          <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">Supprimer</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>