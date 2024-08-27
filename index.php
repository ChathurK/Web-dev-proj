<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">Inventory System</a>

        <!-- Sign Up and Login Buttons placed outside of collapse div -->
        <div class="ml-auto d-lg-none">
            <a href="php/signup.php" class="btn btn-primary mr-2">Sign Up</a>
            <a href="php/login.php" class="btn btn-secondary">Login</a>
        </div>

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Navbar Items -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="php/login.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="php/login.php">View Inventory</a></li>
            </ul>
        </div>

        <!-- Sign Up and Login Buttons for Larger Screens -->
        <div class="d-none d-lg-block ml-auto">
            <a href="php/signup.php" class="btn btn-primary mr-2">Sign Up</a>
            <a href="php/login.php" class="btn btn-secondary">Login</a>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/laptop.jpg" class="d-block w-100" alt="Laptops">
                <div class="carousel-caption">
                    <h5>Explore Our Laptop Collection</h5>
                    <p>Find the best laptops for your business needs.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/computer.jpg" class="d-block w-100" alt="PCs">
                <div class="carousel-caption">
                    <h5>High-Performance PCs</h5>
                    <p>Choose from a variety of powerful desktop computers.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/phone.jpg" class="d-block w-100" alt="Mobiles">
                <div class="carousel-caption">
                    <h5>Latest Mobile Devices</h5>
                    <p>Stay connected with the latest smartphones.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/printers.jpg" class="d-block w-100" alt="Printers">
                <div class="carousel-caption">
                    <h5>Efficient Printers</h5>
                    <p>Discover our range of printers for all your needs.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Description Section -->
    <div class="container header-content">
        <h1>Welcome to the Inventory Management System</h1>
        <p>Manage your inventory with ease and efficiency. Our system offers a comprehensive solution for tracking,
            managing, and optimizing your business assets. Join us today and take control of your inventory!</p>
        <div class="auth-buttons">
            <a href="php/signup.php" class="btn btn-primary btn-lg">Sign Up</a>
            <a href="php/login.php" class="btn btn-secondary btn-lg">Login</a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="container stats-section">
        <div class="row">
            <div class="col-md-3" data-aos="fade-up">
                <div class="card stats-card p-4">
                    <img src="https://img.icons8.com/?size=100&id=2884&format=png&color=000000" alt="Laptops">
                    <div class="card-body">
                        <h3>1500+</h3>
                        <p>Laptops</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card stats-card p-4">
                    <img src="https://img.icons8.com/?size=100&id=1345&format=png&color=000000" alt="PCs">
                    <div class="card-body">
                        <h3>800+</h3>
                        <p>PCs</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card stats-card p-4">
                    <img src="https://img.icons8.com/?size=100&id=11409&format=png&color=000000" alt="Mobiles">
                    <div class="card-body">
                        <h3>2000+</h3>
                        <p>Mobiles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card stats-card p-4">
                    <img src="https://img.icons8.com/?size=100&id=6361&format=png&color=000000" alt="Printers">
                    <div class="card-body">
                        <h3>100+</h3>
                        <p>Printers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2030 Inventory Management System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init();
    </script>
</body>

</html>