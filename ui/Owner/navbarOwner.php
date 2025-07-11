<nav class="navbar">
    <div class="logo">
        🐕 PawWalk
    </div>
    
    <ul class="nav-links" id="navLinks">
        <li><a href="#" class="active">Dashboard</a></li>
        <li><a href="#">My Dogs</a></li>
        <li><a href="#">Book Walk</a></li>
        <li><a href="#">History</a></li>
        <li><a href="#">Invoices</a></li>
    </ul>
    
    <div class="mobile-menu" onclick="toggleMenu()">☰</div>
    <a class="btn btn-danger" name="logout" href="<?= "?pid=" . base64_encode("ui/Owner/homepage.php"). "&sesion=close"?>">Logout</a>
</nav>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e3f2fd 0%, #f8fbff 100%);
    min-height: 100vh;
    color: #2c3e50;
}

/* Navbar */
.navbar {
    background: white;
    padding: 1rem 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #42a5f5;
}

.nav-links {
    display: flex;
    gap: 2rem;
    list-style: none;
}

.nav-links a {
    text-decoration: none;
    color: #546e7a;
    font-weight: 500;
    transition: color 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 20px;
}

.nav-links a:hover,
.nav-links a.active {
    color: #42a5f5;
    background: #e3f2fd;
}

/* Main Content */
.main-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.welcome-section {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
    text-align: center;
}

.welcome-title {
    font-size: 2rem;
    color: #1976d2;
    margin-bottom: 0.5rem;
}

.welcome-subtitle {
    color: #546e7a;
    font-size: 1.1rem;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.dashboard-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #42a5f5, #64b5f6);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin-bottom: 1rem;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1976d2;
    margin-bottom: 0.5rem;
}

.card-description {
    color: #546e7a;
    line-height: 1.5;
}

/* Quick Actions */
.quick-actions {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1976d2;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #42a5f5;
    color: white;
}

.btn-primary:hover {
    background: #1976d2;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(66, 165, 245, 0.3);
}

.btn-outline {
    background: transparent;
    color: #42a5f5;
    border: 2px solid #42a5f5;
}

.btn-outline:hover {
    background: #42a5f5;
    color: white;
    transform: translateY(-2px);
}

/* Mobile Responsive */
.mobile-menu {
    display: none;
    cursor: pointer;
    font-size: 1.5rem;
    color: #42a5f5;
}

@media (max-width: 768px) {
    .navbar {
        padding: 1rem;
    }

    .nav-links {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        flex-direction: column;
        padding: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .nav-links.active {
        display: flex;
    }

    .mobile-menu {
        display: block;
    }

    .main-container {
        padding: 1rem;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .action-buttons {
        flex-direction: column;
    }

    .btn {
        justify-content: center;
    }
}
</style>
    
