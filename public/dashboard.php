<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../public/login.html");
    exit();
}

$user = $_SESSION['user'];
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 min-h-screen flex items-center justify-center">

  <div class="bg-white/90 backdrop-blur-lg p-8 rounded-xl shadow-2xl w-full max-w-xl" x-data="{ user: '<?php echo $user; ?>' }">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">👋 Welcome, <span x-text="user"></span>!</h1>

    <p class="text-gray-700 mb-6">You are now logged in. This is your dashboard.</p>

    <form action="../php/logout.php" method="post">
      <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded w-full">
        🔓 Logout
      </button>
    </form>
  </div>

</body>
</html>

