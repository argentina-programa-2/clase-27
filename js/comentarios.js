const enviarComentario = async (comentario, idPublicacion) => {
  const { username } = JSON.parse(localStorage.getItem("userBlog"));
  const resUsuario = await fetch(`./api/usuarios.php?username=${username}`, {
    method: "GET",
  });
  const { id } = await resUsuario.json();
  const dataComentario = {
    post_id: idPublicacion,
    content: comentario,
    author_id: id,
  };

  const resComentarios = await fetch("./api/comentarios.php", {
    method: "POST",
    body: JSON.stringify(dataComentario),
  });

  const dataa = await resComentarios.json();

  console.log(dataa);

  document.querySelector(`#form-comentario${idPublicacion}`).reset();
  await listarComentarios(idPublicacion);
  return dataa;
};

const listarComentarios = async (idPublicacion) => {
  const resComentarios = await fetch(
    `./api/comentarios.php?post_id=${idPublicacion}`,
    {
      method: "GET",
    }
  );
  const { comentarios } = await resComentarios.json();
  const divComentarios = document.querySelector(
    `.comentarios-${idPublicacion}`
  );
  divComentarios.innerHTML = ``;
  if (comentarios.length === 0) {
    divComentarios.innerHTML = `<p>No hay ningun comentario. Se el primero!</p>`;
  } else {
    comentarios.map(async (comentario, c) => {
      console.log(`vuelta: ${c}`);
      let isHour = false;
      var minutosComentario = Math.abs(
        (new Date().getTime() - new Date(comentario.created_at).getTime()) /
          60000
      );

      //Compruebo si pongo en horas o minutos
      if (Math.abs(minutosComentario) > 60) {
        isHour = true;
        minutosComentario = minutosComentario / 60;
      }

      divComentarios.innerHTML += `
                <div class="comentario">
                    <img src="./assets/profile.webp" alt="perfil default" />
                    <div class="content-comentario">
                        <div class="header-comentario">
                            <h5>${comentario.author_id}</h5>
                            <span>Hace ${Math.round(
                              Math.abs(minutosComentario)
                            )} ${isHour ? "hs" : "min"}</span>
                        </div>
                        <p>${comentario.content}</p>
                    </div>
                </div>
                `;
    });
  }
};
