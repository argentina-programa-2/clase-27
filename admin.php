<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center">Panel Adminstrador</h1>
    <div class="alert" role="alert">
    </div>
    <main class="container">
        <h3 class="text-center">Mis Publicaciones</h3>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarPublicacion">
            Agregar
        </button>

        <div class="modal fade" id="agregarPublicacion" tabindex="-1" aria-labelledby="agregarPublicacion" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="form-agregar" onsubmit="return agregarPublicacion(event)" class="modal-content" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Agregar Publicacion
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" aria-label="file example" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table">
            <thead class=" table-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Content</th>
                    <th class="text-center">created_at</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="publicaciones">
            </tbody>
        </table>
    </main>

    <script src="./js/publicacionesAdmin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>