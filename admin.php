<?php 
session_start();
require_once("connexion/connexion.php");

if (isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);

    try {
        $sql = "UPDATE `admin` SET `nom` = :name, `email` = :email WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

// Vérifier si $pdo est défini
if (!isset($pdo)) {
    die("Erreur de connexion à la base de données.");
}

// Get the current page number from the query string, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 4; // Number of entries to show in a page
$offset = ($page - 1) * $limit;

// Prepare the SQL query with LIMIT and OFFSET
$stmt = $pdo->prepare("SELECT * FROM `user` LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of rows in the table
$totalRowsQuery = $pdo->query("SELECT COUNT(*) FROM `user`");
$totalRows = $totalRowsQuery->fetchColumn();
$totalPages = ceil($totalRows / $limit);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion d'une mutualite</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
<?php include("navigation.php");?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include("entete.php"); ?>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<div class='text-success'><center>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</center></div>";
                }
                if (isset($msg) && $msg != "") {
                    echo "<div class='text-success'><center>" . htmlspecialchars($msg) . "</center></div>";
                }
                if (isset($errormsg) && $errormsg != "") {
                    echo "<div class='text-danger'><center>" . htmlspecialchars($errormsg) . "</center></div>";
                }
                ?>

                
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div id="livesearch"> </div>
        </div>

    </div>
</div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ajouter un membre</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="fas fa-user-plus"></i> Membres
                        </button>
                        <button type="button" class="btn btn-success mb-3">
                            <i class="fas fa-tasks"></i> Activités
                        </button>
                        <button type="button" class="btn btn-warning mb-3">
                            <i class="fas fa-landmark"></i> Patrimoine
                        </button>
                        <button type="button" class="btn btn-info mb-3">
                            <i class="fas fa-cogs"></i> Paramètres
                        </button>
                    </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-6 col-sm-12 col-xs-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Liste des membres</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-xl">
                    <thead class="table-dark">
                        <tr>
                    <th>matricule</th>
                    <th>Nom</th>
                    <th>postnom</th>
                    <th>contact</th>
                    <th>genre</th>
                    <th>fonction</th>
                    <th>Adresse</th>
                    <th>mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row) { ?>
                        <tr>
                    <td><?php echo htmlspecialchars($row['matricule']); ?></td>
                    <td><?php echo htmlspecialchars($row['nom']); ?></td>
                    <td><?php echo htmlspecialchars($row['postnom']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['genre']); ?></td>
                    <td><?php echo htmlspecialchars($row['fonction']); ?></td>
                    <td><?php echo htmlspecialchars($row['Adresse']); ?></td>
                    <td><?php echo htmlspecialchars($row['mail']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <h2 class="mb-4">Gestion des Membres</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">
            Ajouter un Membre
        </button>

        <table class="table table-bordered table-responsive-xl" id="tables">
            <thead>
                <tr>
                    <th>matricule</th>
                    <th>Nom</th>
                    <th>postnom</th>
                    <th>contact</th>
                    <th>genre</th>
                    <th>fonction</th>
                    <th>Adresse</th>
                    <th>mail</th>
                    <th class="th-read">actions</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($result as $row) { ?>
                <tr>
                    
                    <td><?php echo htmlspecialchars($row['matricule']); ?></td>
                    <td><?php echo htmlspecialchars($row['nom']); ?></td>
                    <td><?php echo htmlspecialchars($row['postnom']); ?></td>
                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                    <td><?php echo htmlspecialchars($row['genre']); ?></td>
                    <td><?php echo htmlspecialchars($row['fonction']); ?></td>
                    <td><?php echo htmlspecialchars($row['Adresse']); ?></td>
                    <td><?php echo htmlspecialchars($row['mail']); ?></td>
                    <td>
                        <button class="btn btn-info btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editMemberModal" data-id="<?php echo htmlspecialchars($row['matricule']); ?>" data-name="<?php echo htmlspecialchars($row['nom']); ?>" data-email="<?php echo htmlspecialchars($row['mail']); ?>">Edit</button>
                        <a href="supprimer.php?sup=<?php echo htmlspecialchars($row['matricule']); ?>"><button class="btn btn-danger btn-sm">Delete</button></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php } ?>
                <li class="page-item <?php if($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Ajouter un Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="adminpost.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="membermatricule" class="form-label">Matricule</label>
                            <input name="matricule" type="text" class="form-control" id="membermatricule" placeholder="Matricule">
                        </div>
                        <div class="mb-3">
                            <label for="memberName" class="form-label">Nom</label>
                            <input name="nom" type="text" class="form-control" id="memberName" placeholder="Nom">
                        </div>
                        <div class="mb-3">
                            <label for="memberpostnom" class="form-label">Postnom</label>
                            <input name="postnom" type="text" class="form-control" id="memberpostnom" placeholder="Postnom">
                        </div>
                        <div class="mb-3">
                            <label for="memberfonction" class="form-label">Fonction</label>
                            <input name="fonction" type="text" class="form-control" id="memberfonction" placeholder="Fonction">
                        </div>
                        <div class="mb-3">
                            <label for="memberEmail" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="memberEmail" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="memberadresse" class="form-label">Adresse</label>
                            <input name="adresse" type="text" class="form-control" id="memberadresse" placeholder="Adresse">
                        </div>
                        <div class="mb-3">
                            <label for="memberphotos" class="form-label">Photo</label>
                            <input name="photos" type="file" class="form-control" id="memberphotos" placeholder="Photo">
                        </div>
                        <div class="mb-3">
                            <label for="memberContact" class="form-label">Contact</label>
                            <input name="contact" type="text" class="form-control" id="memberContact" placeholder="Contact">
                        </div>
                        <div class="mb-3">
                            <label for="memberGenre" class="form-label">Genre</label>
                            <select name="genre" class="form-control" id="memberGenre">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="envoie">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMemberModalLabel">Modifier un Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMemberForm" action="admin.php" method="post">
                        <input type="hidden" name="id" id="editMemberId">
                        <div class="mb-3">
                            <label for="editMembermatricule" class="form-label">Matricule</label>
                            <input name="matricule" type="text" class="form-control" id="editMembermatricule" placeholder="Matricule">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberName" class="form-label">Nom</label>
                            <input name="nom" type="text" class="form-control" id="editMemberName" placeholder="Nom">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberpostnom" class="form-label">Postnom</label>
                            <input name="postnom" type="text" class="form-control" id="editMemberpostnom" placeholder="Postnom">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberfonction" class="form-label">Fonction</label>
                            <input name="fonction" type="text" class="form-control" id="editMemberfonction" placeholder="Fonction">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberEmail" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="editMemberEmail" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberadresse" class="form-label">Adresse</label>
                            <input name="adresse" type="text" class="form-control" id="editMemberadresse" placeholder="Adresse">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberphotos" class="form-label">Photo</label>
                            <input name="photos" type="file" class="form-control" id="editMemberphotos" placeholder="Photo">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberContact" class="form-label">Contact</label>
                            <input name="contact" type="text" class="form-control" id="editMemberContact" placeholder="Contact">
                        </div>
                        <div class="mb-3">
                            <label for="editMemberGenre" class="form-label">Genre</label>
                            <select name="genre" class="form-control" id="editMemberGenre">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {
        require_once("connexion/connexion.php");
        $id = htmlspecialchars($_POST['id']);
        $matricule = htmlspecialchars($_POST['matricule']);
        $name = htmlspecialchars($_POST['nom']);
        $postnom = htmlspecialchars($_POST['postnom']);
        $fonction = htmlspecialchars($_POST['fonction']);
        $email = htmlspecialchars($_POST['email']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $photos = htmlspecialchars($_POST['photos']);
        $contact = htmlspecialchars($_POST['contact']);
        $genre = htmlspecialchars($_POST['genre']);

        try {
            $sql = "UPDATE `admin` SET `matricule` = :matricule, `nom` = :name, `postnom` = :postnom, `fonction` = :fonction, `email` = :email, `adresse` = :adresse, `photos` = :photos, `contact` = :contact, `genre` = :genre WHERE `matricule` = :matricule";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':matricule', $id, PDO::PARAM_INT);
            $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':postnom', $postnom, PDO::PARAM_STR);
            $stmt->bindParam(':fonction', $fonction, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':photos', $photos, PDO::PARAM_STR);
            $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);
            $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
    ?>
    </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="max-height: 500px; overflow: hidden;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/association.jpg" class="d-block w-100" alt="..." style="max-height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/Digital.jpg" class="d-block w-100" alt="..." style="max-height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/imgf.jpg" class="d-block w-100" alt="..." style="max-height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Bienvenue dans l'application de gestion de mutualité</h1>
                <p class="lead">Simplifiez la gestion de votre mutualité avec notre application intuitive et efficace. Gérez les membres, suivez les cotisations et accédez à des rapports détaillés en quelques clics.</p>
                <p>Rejoignez-nous et découvrez comment notre solution peut transformer la gestion de votre mutualité, en vous offrant des outils puissants et une interface conviviale pour une expérience utilisateur optimale.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="indexs.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = button.getAttribute('data-id');
                const matricule = button.getAttribute('data-matricule');
                const name = button.getAttribute('data-name');
                const postnom = button.getAttribute('data-postnom');
                const fonction = button.getAttribute('data-fonction');
                const email = button.getAttribute('data-email');
                const adresse = button.getAttribute('data-adresse');
                const photos = button.getAttribute('data-photos');
                const contact = button.getAttribute('data-contact');
                const genre = button.getAttribute('data-genre');

                document.getElementById('editMemberId').value = id;
                document.getElementById('editMembermatricule').value = matricule;
                document.getElementById('editMemberName').value = name;
                document.getElementById('editMemberpostnom').value = postnom;
                document.getElementById('editMemberfonction').value = fonction;
                document.getElementById('editMemberEmail').value = email;
                document.getElementById('editMemberadresse').value = adresse;
                document.getElementById('editMemberphotos').value = photos;
                document.getElementById('editMemberContact').value = contact;
                document.getElementById('editMemberGenre').value = genre;
            });
        });
    });
</script>
