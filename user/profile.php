<?php
include "../include/connection.php";
include "../include/function.php";

$sql = "select u.* from user u where u.user_id=:user_id";
$stmt = $con->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
$stmt->execute(['user_id' => $_SESSION['user_id_' . $config['projectname']]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div class="modal-header">
    <h5 class="modal-title modal-label">ข้อมูลส่วนตัว</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12 text-center">
                    <img src="<?php echo $user['picture']; ?>" class="card-img-top" alt="...">
                    <p class="card-text pt-2">
                        <?php echo $user['prename'] . $user['user_first_name'] . " " . $user['user_last_name']; ?>
                    </p>
                </div>
                <div class="col-lg-8 col-12">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's
                        content.</p>

                </div>
            </div>
        </div>
    </div>
</div>