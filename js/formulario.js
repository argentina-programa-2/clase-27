const registrar = (e) => {
  e.preventDefault();
  const data = Object.fromEntries(new FormData(e.target));

  fetch("./api/registrar.php", {
    method: "POST",
    body: JSON.stringify(data),
  })
    .then((res) => res.json())
    .then((data) => {
      document.querySelector("#form-registro").reset();
      bootstrap.Modal.getOrCreateInstance("#registroModal").hide();
      const alert = document.querySelector(".alert");
      if (!data.message.includes("Error")) {
        alert.classList.add("alert-success");
      } else {
        alert.classList.add("alert-danger");
      }
      alert.textContent = data.message;
      setTimeout(() => {
        if (!data.message.includes("Error")) {
          alert.classList.remove("alert-success");
        } else {
          alert.classList.remove("alert-danger");
        }
        alert.textContent = "";
      }, 2000);
    });
};

const login = (e) => {
  e.preventDefault();
  const dataForm = Object.fromEntries(new FormData(e.target));

  fetch("./api/login.php", {
    method: "POST",
    body: JSON.stringify(dataForm),
  })
    .then((res) => res.json())
    .then((data) => {
      const dataLS = {
        id: data.user[0].id,
        username: data.user[0].username,
        email: data.user[0].email,
      };
      localStorage.setItem("userBlog", JSON.stringify(dataLS));
      const alert = document.querySelector(".alert");
      if (!data.message.includes("Error")) {
        alert.classList.add("alert-success");
        document.querySelector("#form-login").reset();
        bootstrap.Modal.getOrCreateInstance("#loginModal").hide();
        checkLogin();
      } else {
        alert.classList.add("alert-danger");
      }
      alert.textContent = data.message;
      setTimeout(() => {
        if (!data.message.includes("Error")) {
          alert.classList.remove("alert-success");
        } else {
          alert.classList.remove("alert-danger");
        }
        alert.textContent = "";
      }, 2000);
    });
};

// document.querySelector("#form-registro").addEventListener("submit", (e) => {
//   e.preventDefault();
//   const data = Object.fromEntries(new FormData(e.target));

//   fetch("./api/registrar.php", {
//     method: "POST",
//     body: JSON.stringify(data),
//   })
//     .then((res) => res.json())
//     .then((data) => {
//       document.querySelector("#form-registro").reset();
//       bootstrap.Modal.getOrCreateInstance("#registroModal").hide();
//       const alert = document.querySelector(".alert");
//       if (!data.message.includes("Error")) {
//         alert.classList.add("alert-success");
//       } else {
//         alert.classList.add("alert-danger");
//       }
//       alert.textContent = data.message;
//       setTimeout(() => {
//         if (!data.message.includes("Error")) {
//           alert.classList.remove("alert-success");
//         } else {
//           alert.classList.remove("alert-danger");
//         }
//         alert.textContent = "";
//       }, 2000);
//     });
// });

// document.querySelector("#form-login").addEventListener("submit", (e) => {
//   e.preventDefault();
//   const dataForm = Object.fromEntries(new FormData(e.target));

//   fetch("./api/login.php", {
//     method: "POST",
//     body: JSON.stringify(dataForm),
//   })
//     .then((res) => res.json())
//     .then((data) => {
//       const dataLS = {
//         id: data.user[0].id,
//         username: data.user[0].username,
//         email: data.user[0].email,
//       };
//       localStorage.setItem("userBlog", JSON.stringify(dataLS));
//       const alert = document.querySelector(".alert");
//       if (!data.message.includes("Error")) {
//         alert.classList.add("alert-success");
//         document.querySelector("#form-login").reset();
//         bootstrap.Modal.getOrCreateInstance("#loginModal").hide();
//         checkLogin();
//       } else {
//         alert.classList.add("alert-danger");
//       }
//       alert.textContent = data.message;
//       setTimeout(() => {
//         if (!data.message.includes("Error")) {
//           alert.classList.remove("alert-success");
//         } else {
//           alert.classList.remove("alert-danger");
//         }
//         alert.textContent = "";
//       }, 2000);
//     });
// });
