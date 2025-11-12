<?php
require_once __DIR__ . '/auth_check.php';
// allow secretary, dean, admin to view
require_secretary_dean_or_admin();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Scheduling — Calendar</title>
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
  <link rel="stylesheet" href="/modules/scheduling/assets/css/scheduling.css">
</head>
<body>
  <div class="scheduling-wrapper">
    <header>
      <h1>Scheduling</h1>
      <nav class="scheduling-nav">
        <a class="btn" href="/modules/scheduling/create.php">Create Appointment</a>
        <a class="btn" href="/modules/scheduling/requests.php">Pending Requests</a>
      </nav>
    </header>

    <main>
      <div id="calendar"></div>
    </main>
  </div>

  <script src="/modules/scheduling/assets/js/fullcalendar-init.js"></script>
</body>
</html>