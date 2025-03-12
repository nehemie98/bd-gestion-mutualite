<?php 
// session_start();

?>
<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#">Mutualité</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="admin.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-users"></i> membres
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="fas fa-user-plus"></i> Ajouter un membre
                        </button>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="admin.php">Admin Page</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-landmark"></i> patrimoine
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="biens.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-building"></i> Biens
                        </a>
                        <a href="location.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-handshake"></i> Locations
                        </a>
                        <a href="demandes.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-hand-holding-usd"></i> Demandes
                        </a>  
                        <a href="enregistrer_bien.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-plus"></i> Enregistrer un Bien
                        </a>      

                    </div>
                </li>

                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFinance" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-coins"></i> Finance
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownFinance">
                        <a href="cotisations.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-money-bill-wave"></i> Cotisation
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMessage" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope"></i> Messages
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMessage">
                        <a href="message.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-envelope-open-text"></i> Voir les messages
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownGalerie" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-images"></i> Galerie
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownGalerie">
                        <a href="galerie.php" class="btn btn-secondary mb-3 dropdown-item">
                            <i class="fas fa-images"></i> Voir la galerie
                        </a>
                    </div>

                <li><a href="activites.php" class="btn btn-secondary mb-3 me-2" style="padding: 10px; background-color: #6c757d;"><i class="fa-solid fa-calendar"></i> Activités</a></li>

                <li><a href="../index.php" class="btn btn-secondary mb-3" style="padding: 10px; background-color: #343a40;"><i class="fa-solid fa-house"></i> Acceuil</a></li></ul>
            <form class="d-flex ms-auto">
                <input class="form-control me-2" type="search" onkeyup="showResult(this.value)"  placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="images/<?php echo $_SESSION['image']; ?>" alt="Profile Image" class="rounded-circle" width="30" height="30">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="images/<?php echo $_SESSION['image']; ?>">Profile</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
<!-- End of Topbar -->
