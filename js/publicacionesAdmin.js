const listarPublicaciones = () => {
  const divPublicaciones = document.querySelector(".publicaciones");
  const user = JSON.parse(localStorage.getItem("userBlog"));
  console.log(user);
  divPublicaciones.innerHTML = ``;
  fetch(`./api/publicaciones.php?author_id=${user.id}`, {
    method: "GET",
  })
    .then((res) => res.json())
    .then((data) => {
      data.publicaciones.map((publicacion, index) => {
        divPublicaciones.innerHTML += `
                <tr>
                    <td class="text-center">${publicacion.id}</td>
                    <td class="text-center">${publicacion.title}</td>
                    <td class="text-center">${publicacion.content}</td>
                    <td class="text-center">${publicacion.created_at}</td>
                    

                    <td>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPublicacion${index}">
                            Editar
                        </button>

                        <div class="modal fade" id="editarPublicacion${index}" tabindex="-1" aria-labelledby="editarPublicacion${index}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form id="" class="modal-content form-editar">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Editar Publicacion
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <input type="text" style="display:none;" class="form-control" id="id" name="id" value="${publicacion.id}" required>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="${publicacion.title}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="content" cols="10" rows="10">${publicacion.content}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            Editar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarPublicacion${index}">
                            Eliminar
                        </button>

                        <div class="modal fade" id="eliminarPublicacion${index}" tabindex="-1" aria-labelledby="eliminarPublicacion${index}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form id="" class="modal-content form-eliminar">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Eliminar Publicacion
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" style="display:none;" class="form-control" id="id" name="id" value="${publicacion.id}" required>
                                        <p>Esta seguro que desea eliminar esta publicacion? Se borraran junto a sus comentarios.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </td>
                </tr>
                `;
        editarPublicacion(index);

        eliminarPublicacion(index);
      });
    });
};

const editarPublicacion = (index) => {
  const divEditarPublicaciones = document.querySelectorAll(`.form-editar`);
  divEditarPublicaciones.forEach((divEditarPublicacion) => {
    divEditarPublicacion.addEventListener("submit", async (e) => {
      e.preventDefault();
      const dataFormEditar = Object.fromEntries(new FormData(e.target));

      const resEditarPublicacion = await fetch("./api/publicaciones.php", {
        method: "PUT",
        body: JSON.stringify(dataFormEditar),
      });

      const { message } = await resEditarPublicacion.json();

      const alert = document.querySelector(".alert");
      if (!message.includes("Error")) {
        alert.classList.add("alert-success");
        divEditarPublicacion.reset();
        bootstrap.Modal.getOrCreateInstance(
          `#editarPublicacion${index}`
        ).hide();
      } else {
        alert.classList.add("alert-danger");
      }
      alert.textContent = message;
      setTimeout(() => {
        if (!message.includes("Error")) {
          alert.classList.remove("alert-success");
        } else {
          alert.classList.remove("alert-danger");
        }
        alert.textContent = "";
      }, 2000);
      listarPublicaciones();
    });
  });
};

const eliminarPublicacion = (index) => {
  const divEliminarPublicaciones = document.querySelectorAll(`.form-eliminar`);
  divEliminarPublicaciones.forEach((divEliminarPublicacion) => {
    divEliminarPublicacion.addEventListener("submit", async (e) => {
      e.preventDefault();
      const dataFormEditar = Object.fromEntries(new FormData(e.target));

      const resEliminarPublicacion = await fetch("./api/publicaciones.php", {
        method: "DELETE",
        body: JSON.stringify(dataFormEditar),
      });

      const { message } = await resEliminarPublicacion.json();

      const alert = document.querySelector(".alert");
      if (!message.includes("Error")) {
        alert.classList.add("alert-success");
        divEliminarPublicacion.reset();
        bootstrap.Modal.getOrCreateInstance(
          `#eliminarPublicacion${index}`
        ).hide();
      } else {
        alert.classList.add("alert-danger");
      }
      alert.textContent = message;
      setTimeout(() => {
        if (!message.includes("Error")) {
          alert.classList.remove("alert-success");
        } else {
          alert.classList.remove("alert-danger");
        }
        alert.textContent = "";
      }, 2000);
      listarPublicaciones();
    });
  });
};

const agregarPublicacion = async (e) => {
  e.preventDefault();
  const data = Object.fromEntries(new FormData(e.target));
  const formData = new FormData();

  const { id } = JSON.parse(localStorage.getItem("userBlog"));

  formData.append("title", data.title);
  formData.append("content", data.content);
  formData.append("author_id", id);
  formData.append("image", data.image);
  const dataPost = {
    title: data.title,
    content: data.content,
    author_id: id,
    image: data.image,
  };
  const resPublicacion = await fetch("./api/publicaciones.php", {
    method: "POST",
    body: formData,
  });

  const { message } = await resPublicacion.json();
  const alert = document.querySelector(".alert");
  if (!message.includes("Error")) {
    alert.classList.add("alert-success");
    document.querySelector("#form-agregar").reset();
    bootstrap.Modal.getOrCreateInstance("#agregarPublicacion").hide();
  } else {
    alert.classList.add("alert-danger");
  }
  alert.textContent = message;
  setTimeout(() => {
    if (!message.includes("Error")) {
      alert.classList.remove("alert-success");
    } else {
      alert.classList.remove("alert-danger");
    }
    alert.textContent = "";
  }, 2000);
  listarPublicaciones();
};

listarPublicaciones();
