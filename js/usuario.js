const checkLogin = () => {
  const usuarioLoggeado = JSON.parse(localStorage.getItem("userBlog"));

  if (usuarioLoggeado === null) {
    document.querySelector(".logged").style.display = "none";
    document.querySelector(".noLogged").style.display = "flex";
    document.querySelector(
        "#user_name"
      ).textContent = ``;

  } else {
    document.querySelector(".noLogged").style.display = "none";
    document.querySelector(".logged").style.display = "flex";
    document.querySelector(
      "#user_name"
    ).textContent = `Bienvenido ${usuarioLoggeado.username}`;
  }
};

const cerrarSesion = () => {
  localStorage.removeItem("userBlog");
  checkLogin();
};

checkLogin();
