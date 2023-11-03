const listarPublicaciones = () => {
  fetch("./api/publicaciones.php", {
    method: "GET",
  })
    .then((res) => res.json())
    .then(async (data) => {
      const divPublicaciones = document.querySelector(".publicaciones");
      divPublicaciones.innerHTML = "";

      data.publicaciones.map(async (publicacion, index) => {
        divPublicaciones.innerHTML += `
              <div class="card publicacion ${
                publicacion.imagen ? "" : "imageDefault"
              }" ${
          publicacion.imagen
            ? `style="background-image:url('data:image/jpg;base64,${publicacion.imagen}');background-size: cover;background-position: center;"`
            : ""
        }>
                  <div class="card-body">
                      <h5 class="card-title text-light">${publicacion.title}</h5>
                      <p class="card-text text-light">${publicacion.content}</p>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comentarioModal${
                        publicacion.id
                      }">Ver comentarios</button>
      
                      <div class="modal modalComentario${
                        publicacion.id
                      } fade" id="comentarioModal${
          publicacion.id
        }" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                              <div id="form-login" class="modal-content">
                                  <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">
                                          Comentarios
                                      </h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="comentarios-${
                                        publicacion.id
                                      }">
                                      
                                      </div>
                                  </div>
                                  <hr>
                                  ${
                                    localStorage.getItem("userBlog")
                                      ? ` <form id="form-comentario${publicacion.id}" class="d-flex flex-row align-items-center p-3 m-0">
                                              <input type="text" class="form-control" id="comentario" name="comentario" placeholder="Escribi tu comentario..." required>
                                              <button type="submit" class="btn btn-primary"> Enviar </button>
                                          </form>`
                                      : `<small class="text-danger text-center">Para comentar tenes que iniciar sesion</small>     
                                            <div class="d-flex flex-row align-items-center p-3 m-0">
                                                <input type="text" disabled class="form-control" id="comentario" name="comentario" placeholder="Escribi tu comentario..." required>
                                                <button type="submit" disabled class="btn btn-primary">
                                                    Enviar
                                                </button>
                                            </div>`
                                  }
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              `;

        await listarComentarios(publicacion.id);

        document
          ?.querySelector(`#form-comentario${publicacion.id}`)
          ?.addEventListener("submit", async (e) => {
            e.preventDefault();
            const comentario = Object.fromEntries(
              new FormData(e.target)
            ).comentario;
            const res = await enviarComentario(comentario, publicacion.id);
          });
      });
    });
};

listarPublicaciones();
