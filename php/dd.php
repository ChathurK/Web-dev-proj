<!-- dashboard.php -->
<?php
// Include the database connection
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] !== "logg") {
    // Redirect to login page if session is not valid
    header('Location: login.php');
    exit();
}

include 'db_connect.php';
// Query to get the latest inventories
$sql = "SELECT id, name, category, quantity, price, added_date FROM item ORDER BY added_date DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/ss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <header class="bg-primary text-white py-3 d-flex justify-content-between align-items-center">
        <!-- Hamburger Menu for Mobile -->
        <button id="sidebarToggle" class="btn btn-outline-light d-md-none"><i class="fas fa-bars"></i></button>

        <!-- Navbar Brand -->
        <a class="navbar-brand text-white" href="dd.php">Inventory System</a>

        <!-- Search Bar and Logout Button for Desktop -->
        <div class="d-none d-md-flex align-items-center ml-auto">
            <div class="search-bar position-relative mr-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Laptop, PC, Mobile...">
                <i class="fas fa-search position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); color: #004080;"></i>
            </div>
            <a href="../index.php" class="btn btn-outline-light d-flex align-items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
        </div>

        <!-- Logout Button for Mobile (no search bar) -->
        <a href="../index.php" class="btn btn-outline-light d-md-none">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </header>

    <div class="wrapper">
        <nav class="sidebar bg-dark text-white p-3">
            <ul class="list-unstyled">
                <li><a href="dd.php" class="text-white"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="inventory.php" class="text-white"><i class="fas fa-list"></i> View Inventory</a></li>
                <li>
                    <a href="#addItemMenu" class="text-white" data-toggle="collapse"><i class="fas fa-plus"></i> Add Item <i class="fas fa-caret-down float-right"></i></a>
                    <ul id="addItemMenu" class="collapse list-unstyled pl-3">
                        <li><a href="inventory.php?category=laptops#laptop-table" class="text-white">Laptops</a></li>
                        <li><a href="inventory.php?category=pcs#pc-table" class="text-white">PCs</a></li>
                        <li><a href="inventory.php?category=mobiles#mobile-table" class="text-white">Mobiles</a></li>
                        <li><a href="inventory.php?category=printers#printer-table" class="text-white">Printers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#updateItemMenu" class="text-white" data-toggle="collapse"><i class="fas fa-edit"></i> Update Item <i class="fas fa-caret-down float-right"></i></a>
                    <ul id="updateItemMenu" class="collapse list-unstyled pl-3">
                        <li><a href="inventory.php?category=laptops#laptop-table" class="text-white">Laptops</a></li>
                        <li><a href="inventory.php?category=pcs#pc-table" class="text-white">PCs</a></li>
                        <li><a href="inventory.php?category=mobiles#mobile-table" class="text-white">Mobiles</a></li>
                        <li><a href="inventory.php?category=printers#printer-table" class="text-white">Printers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#deleteItemMenu" class="text-white" data-toggle="collapse"><i class="fas fa-trash"></i> Delete Item <i class="fas fa-caret-down float-right"></i></a>
                    <ul id="deleteItemMenu" class="collapse list-unstyled pl-3">
                        <li><a href="inventory.php?category=laptops#laptop-table" class="text-white">Laptops</a></li>
                        <li><a href="inventory.php?category=pcs#pc-table" class="text-white">PCs</a></li>
                        <li><a href="inventory.php?category=mobiles#mobile-table" class="text-white">Mobiles</a></li>
                        <li><a href="inventory.php?category=printers#printer-table" class="text-white">Printers</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="category-card bg-primary text-white text-center" onclick="window.location.href='category_inventory.php?category=laptop'">
                        <h2>Laptops</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card bg-primary text-white text-center" onclick="window.location.href='category_inventory.php?category=mobile'">
                        <h2>Mobiles</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card bg-primary text-white text-center" onclick="window.location.href='category_inventory.php?category=pc'">
                        <h2>PCs</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card bg-primary text-white text-center" onclick="window.location.href='category_inventory.php?category=printer'">
                        <h2>Printers</h2>
                    </div>
                </div>
            </div>

            <div class="latest-inventories mt-4">
                <h2>Latest Inventories</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if there are records in the database
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['category']}</td>
                                        <td>{$row['quantity']}</td>
                                        <td>{$row['price']}</td>
                                        <td>{$row['added_date']}</td>
                                      </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No items found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Button to View Full Inventory -->
                <div class="text-right mt-4">
                    <a href="inventory.php" class="btn btn-primary btn-lg"><i class="fas fa-list"></i> View Full Inventory</a>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        });

        // Search functionality
        function performSearch() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const categories = ['laptop', 'pc', 'mobile', 'printer'];

            if (categories.includes(query)) {
                // Redirect to category_inventory.php with the selected category
                window.location.href = `category_inventory.php?category=${query}`;
            } else {
                window.location.href = '../html/search-not-found.html';
            }

            searchInput.value = '';
        }

        document.getElementById('searchInput').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        });

        document.querySelector('.fa-search').addEventListener('click', performSearch);

        // Prevent back navigation after logout
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

