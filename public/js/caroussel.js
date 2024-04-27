const images = [];
let indexChoisi = 0;

console.log("Carroussel chargement..");

function replaceImages() {
  let imageDevant = null;
  let imageDevantMax = 0;
  let imageDevantIndex;

  for (let i = 0; i < images.length; i++) {
    const image = images[i];
    const valBase = ((i + 1 + indexChoisi) * Math.PI * 2) / images.length;
    const valCos = (Math.cos(valBase) + 1) * 50;
    const valSin = (Math.sin(valBase) + 1) * 50;

    if (valSin > imageDevantMax) {
      imageDevantMax = valSin;
      imageDevant = image;
      imageDevantIndex = i;
    }

    // console.log(Math.abs(valCos) < 0.0001 ? 0 : valCos)
    // console.log(Math.abs(valSin) < 0.0001 ? 0 : valSin)

    const nouveauLeft = valCos * 0.7;
    const nouveauWidth = 200 + valSin * 4;
    const nouveauZIndex = Math.floor(valSin * 4);

    image.style.left = nouveauLeft + "%";
    image.style.top = valSin + "px";
    image.style.width = nouveauWidth + "px";
    image.style.zIndex = nouveauZIndex;
    image.style.filter = `blur(${10 - valSin / 10}px)`;
  }

  imageDevant.style.top = "0px";
  imageDevant.style.width = "700px";
  imageDevant.style.filter = "blur(0)";

  for (let image of document.getElementById("petits-points").children)
    image.style.backgroundColor = "transparent";

  document.getElementById("petits-points").children[
    document.getElementById("petits-points").children.length -
      1 -
      imageDevantIndex
  ].style.backgroundColor = "#7b9b9b";
}

export function loadImages() {
  document.getElementById("caroussel-gauche").addEventListener("click", () => {
    indexChoisi--;
    replaceImages();
  });

  document.getElementById("caroussel-droite").addEventListener("click", () => {
    indexChoisi++;
    replaceImages();
  });

  let compteur = 1;
  let limite = 100;

  while (compteur < limite) {
    console.log("tour");
    const image = document.getElementById("image-caroussel-" + compteur++);
    if (image != null) {
      // console.log(image)
      images.push(image);
      // console.log("image loadee réussi : " + compteur++)
    } else {
      // console.log("Pas réussi à load : " + compteur)
      break;
    }
  }
  // console.log(images)
  //
  const petitsPointsDiv = document.getElementById("petits-points");
  for (let i = 0; i < images.length; i++) {
    const point = document.createElement("div");
    point.classList.add("petit-point");
    point.style.backgroundColor = "transparent";

    petitsPointsDiv.appendChild(point);
  }

  replaceImages(indexChoisi);

  console.log(images);

  setInterval(() => {
    indexChoisi++;
    replaceImages(indexChoisi - 1);
  }, 5000);
}

loadImages();
