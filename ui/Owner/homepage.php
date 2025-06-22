<?php
if($_SESSION["role"] != "Owner"){
    header("Location: ?pid=". base64_encode("ui/failure/Forbidden403.php"));
    exit();
}
$owner = new Owner($_SESSION["userID"]);
$owner -> retrieve();

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET["sesion"])){
        $owner -> logout();
    }
}
?>
<?php
require_once __DIR__ . '/navbarOwner.php'; 
?>
<body>


    <!-- Main Content -->
    <div class="main-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome back, <?= $owner -> getName() . " " . $owner -> getLastName()?>! 🐾</h1>
            <p class="welcome-subtitle">Ready to give your furry friends the best walk experience?</p>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <div class="dashboard-card" onclick="navigateTo('dogs')">
                <div class="card-icon">🐕</div>
                <h3 class="card-title">Manage My Dogs</h3>
                <p class="card-description">Add, edit, or remove your dogs' profiles. Update their information and preferences.</p>
            </div>

            <div class="dashboard-card" onclick="navigateTo('book-walk')">
                <div class="card-icon">🚶</div>
                <h3 class="card-title">Request Walk</h3>
                <p class="card-description">Schedule a new walk for your dogs. Choose date, time, and your preferred walker.</p>
            </div>

            <div class="dashboard-card" onclick="navigateTo('history')">
                <div class="card-icon">📋</div>
                <h3 class="card-title">Walk History</h3>
                <p class="card-description">View all past walks, ratings, and feedback from your dog walkers.</p>
            </div>

            <div class="dashboard-card" onclick="navigateTo('choose-walker')">
                <div class="card-icon">👥</div>
                <h3 class="card-title">Choose Walker</h3>
                <p class="card-description">Browse and select from our verified dog walkers in your area.</p>
            </div>

            <div class="dashboard-card" onclick="navigateTo('invoices')">
                <div class="card-icon">💳</div>
                <h3 class="card-title">My Invoices</h3>
                <p class="card-description">View and manage your walk invoices, payments, and billing history.</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">⚡ Quick Actions</h2>
            <div class="action-buttons">
                <button class="btn btn-primary" onclick="quickAction('emergency-walk')">
                    🚨 Emergency Walk
                </button>
                <button class="btn btn-outline" onclick="quickAction('favorite-walker')">
                    ⭐ Book Favorite Walker
                </button>
                <button class="btn btn-outline" onclick="quickAction('add-dog')">
                    ➕ Add New Dog
                </button>
                <button class="btn btn-outline" onclick="quickAction('support')">
                    💬 Contact Support
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        function navigateTo(section) {
            alert(`Navigating to ${section.replace('-', ' ')} section`);
            switch(section) {
                case 'choose-walker':
                    window.location.href = "?pid=<?= base64_encode('ui/Owner/chooseWalker.php') ?>";
                    break;
                // ... other cases
                default:
                    alert(`Navigating to ${section.replace('-', ' ')} section`);
            }
        }


        function quickAction(action) {
            console.log(`Quick action: ${action}`);
            // Here you would implement actual quick actions
            alert(`${action.replace('-', ' ')} feature coming soon!`);
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar');
            const navLinks = document.getElementById('navLinks');
            
            if (!navbar.contains(event.target) && navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
            }
        });

        // Add some interactivity to cards
        document.querySelectorAll('.dashboard-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
