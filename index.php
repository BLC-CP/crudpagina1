<?php

$conn = mysqli_connect('localhost', 'root', '', 'crud1halaman');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand  text-white" href="index.php">BLC-AMLM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">CRUD Iha pagina ida nia laran</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <?php

    if (isset($_POST['create'])) {
        $nreEst = $_GET['id'];
        if ($_GET['page'] == 'edit') {

            $nre = $_POST['nre'];
            $nrn = $_POST['naran'];
            $sexo = $_POST['sexo'];
            $email = $_POST['email'];
            $id_departamentu = $_POST['id_departamentu'];
            if ($_FILES['foto']['error'] === 4) {
                $foto = $_POST['img'];
            } else {
                $foto = $_FILES['foto']['name'];
            }

            $insert =  mysqli_query($conn, "UPDATE tb_estudante SET
            nre='$nre',
            nrn='$nrn', 
            sexo='$sexo', 
            email='$email', 
            id_departamentu='$id_departamentu', 
            foto='$foto'
            
            WHERE nre='$nreEst';

             ");
        } else {
            $nre = $_POST['nre'];
            $nrn = $_POST['naran'];
            $sexo = $_POST['sexo'];
            $email = $_POST['email'];
            $id_departamentu = $_POST['id_departamentu'];
            $foto = $_FILES['foto']['name'];



            move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $foto);

            $insert =  mysqli_query($conn, "INSERT INTO tb_estudante VALUES('$nre', '$nrn', '$sexo', '$email', '$id_departamentu', '$foto') ");

            echo "<script>
                    document.location.href='index.php';
                </script>";
        }
    }


    if (isset($_GET['page'])) {
        $nre = $_GET['id'];
        if ($_GET['page'] == 'edit') {

            $equery = mysqli_query($conn, "SELECT * FROM tb_estudante WHERE nre = '$nre' ");
            $datas = mysqli_fetch_array($equery);
        } else {
            $delete =  mysqli_query($conn, "DELETE FROM  tb_estudante WHERE nre='$_GET[id]' ");
        }
    }

    ?>






    <!-- MOdal -->


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl " ata-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Input Dadus Estudante</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-6">

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="nre" class="form-label">Nre</label>
                                        <input type="text" name="nre" value="<?= @$datas['nre'] ?>" class="form-control" id="nre" placeholder="Nre..">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Naran" class="form-label">Naran</label>
                                        <input type="text" name="naran" value="<?= @$datas['nrn'] ?>" class="form-control" id="Naran" placeholder="Naran..">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Sexo" class="form-label">Sexo : </label>
                                        <input type="radio" name="sexo" id="Sexo" value="Mane" <?= @$datas['sexo'] == 'Mane' ? 'checked' : null ?>> Mane
                                        <input type="radio" name="sexo" id="Sexo" value="Feto" <?= @$datas['sexo'] == 'Feto' ? 'checked' : null ?>> Feto
                                    </div>


                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Email" class="form-label">Email : </label>
                                    <input type="email" name="email" value="<?= @$datas['email'] ?>" class="form-control" id="Email" placeholder="Email..">
                                </div>
                                <div class="mb-3">
                                    <label for="id_departamentu" class="form-label">Departamentu</label>
                                    <select name="id_departamentu" id="id_departamentu" class="form-select">
                                        <option disabled selected>Hili Departamentu</option>
                                        <?php

                                        $query =  mysqli_query($conn, "SELECT * FROM tb_departamentu");
                                        while ($dd  = mysqli_fetch_array($query)) {

                                        ?>
                                            <option <?php if (@$datas['id_departamentu'] == @$dd['id_departamentu']) echo "selected"; ?> value="<?= @$dd['id_departamentu']; ?>"><?= @$dd['nrn_departamentu']; ?></option>

                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" value="<?= @$datas['foto'] ?>" id="foto" class="form-control">
                                    <input type="hidden" name="img" value="<?= @$datas['foto'] ?>">
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm" name="create">Proses Data</button>
                    <button type="reset" class="btn btn-primary btn-sm" name="reset">Reset Field</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir MOdal -->



    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header bg-primary">
                        <!-- <a href="" class="btn btn-primary btn-sm">Add Student</a> -->
                        Dadus Estudante
                    </h5>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <a class="btn btn-primary mb-2 btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-whatever="@getbootstrap"> Aumenta Dadus</a>
                            <thead>
                                <tr>
                                    <th>Nre</th>
                                    <th>Naran</th>
                                    <th>Sexo</th>
                                    <th>Email</th>
                                    <th>Departamentu</th>
                                    <th>Foto</th>
                                    <th>Aksaun</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $query =  mysqli_query($conn, "SELECT * FROM tb_estudante ORDER BY nre DESC");
                                while ($data  = mysqli_fetch_array($query)) :

                                ?>
                                    <tr class="align-middle">
                                        <td><?= $data['nre']; ?></td>
                                        <td><?= $data['nrn']; ?></td>
                                        <td><?= $data['sexo']; ?></td>
                                        <td><?= $data['email']; ?></td>
                                        <td><?= $data['id_departamentu']; ?></td>
                                        <td>
                                            <img src="img/<?= $data['foto'] ?>" alt="Foto Estudante" width="40px">
                                        </td>
                                        <td>
                                            <a href="index.php?page=edit&id=<?= $data['nre']; ?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Hadia</a>
                                            <a href="index.php?page=delete&id=<?= $data['nre']; ?>" onclick="return confirm(' Tebes atu hamos <?= $data['nrn']; ?> ')" class="btn btn-danger btn-sm">Hamos</a>
                                        </td>
                                    </tr>

                                <?php endwhile; ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500
        });
    </script> -->

</body>

</html>