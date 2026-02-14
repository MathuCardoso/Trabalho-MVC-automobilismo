document.addEventListener("DOMContentLoaded", () => {
  const url = "https://servicodados.ibge.gov.br/api/v1/paises/";
  const select = document.getElementById("inpNac");

  async function getPaises() {
    const nomeSelecionado = select.getAttribute("nomeSelecionado");

    let paises = await fetch(url);
    paises = await paises.json();

    paises.forEach((p) => {
      let option = document.createElement("option");
      option.textContent = p.nome.abreviado;
      if (nomeSelecionado === option.textContent) {
        option.setAttribute("selected", null);
      }
      select.appendChild(option);
    });
  }

  getPaises();
});
