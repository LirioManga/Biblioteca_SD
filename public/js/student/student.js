const routes = {
    "/student": "inicio",
    "/student/inicio": "inicio",
    "/student/requisicoes": "requisicoes",
    "/student/recursos": "recursos",
    "/student/perfil": "perfil",
  };

  function navigate(path) {
    const sectionId = routes[path] || "inicio";
    
    // Esconde todas as seções
    document.querySelectorAll("main > section").forEach(section => {
      section.style.display = "none";
    });

    // Mostra apenas a correspondente
    const section = document.getElementById(sectionId);
    if (section) {
      section.style.display = "block";
    } else {
      // Fallback
      document.getElementById("inicio").style.display = "block";
    }
  }

  document.querySelectorAll(".route-link").forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const path = this.getAttribute("href");
      history.pushState({}, "", path);
      navigate(path);
    });
  });

  window.addEventListener("popstate", () => {
    navigate(location.pathname);
  });

  window.addEventListener("DOMContentLoaded", () => {
    navigate(location.pathname);
  });