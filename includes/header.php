<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="list_users.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">User Management System</span>
    </a>

    <?php if(isset($_SESSION['username']) && !empty($_SESSION['username'])){ ?>
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php" class="nav-link" aria-current="page">Add User</a></li>
        <li class="nav-item"><a href="list_users.php" class="nav-link">List Users</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
    </ul>
    <?php }?>

    </header>