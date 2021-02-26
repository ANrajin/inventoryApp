<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Inventory Management </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> &nbsp Home <span class="sr-only">(current)</span></a>
        </li>
        <?php
            if(isset($_SESSION['user_id'])){
        ?>
        <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-user"></i> &nbsp Logout</a>
        </li>
        <?php
            }
        ?>
        </ul>
    </div>
</nav>
