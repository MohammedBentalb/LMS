import {
  validateAndShowError,
  validatingPosition,
  watchElementAndValidate,
  watchPositionAndValidate,
} from "../validation/validation.js";

const sectionForm = document.querySelector("form");
const sectionTitle = document.querySelector("#section-title");
const sectionContent = document.querySelector("#section-content");
const sectionPosition = document.querySelector("#section-position");
const addSectionButton = document.querySelector(".add-new-section");
const newSectionsContainer = document.querySelector(".new-sections");
const originalfileds = document.querySelectorAll(".form-field");
const fakeFields = [];
const positions = document.querySelector(".positions").textContent;

originalfileds.forEach((field) => {
  fakeFields.push(field);
});

let j = 0;
const initializePositions = positions.split(",").map((p) => {
  j++;
  return { input: `predefined-${j}`,  position: p };
});

const state = {
  errorArray: [],
  positionArray: positions ? initializePositions : [],
};

console.log(state.positionArray)
let newSectionsCounter = 0;

watchElementAndValidate(sectionTitle);
watchElementAndValidate(sectionContent);
watchPositionAndValidate(sectionPosition, state);

addSectionButton.addEventListener("click", function () {
  newSectionsCounter++;
  const div = document.createElement("div");
  const h3 = document.createElement("h3");
  h3.textContent = `${newSectionsCounter + 1}TH Section`;
  h3.classList.add("new-section-title");
  newSectionsContainer.appendChild(h3);
  newSectionsContainer.appendChild(div);
  fakeFields.forEach((f) => {
    let clone = f.cloneNode(true);
    clone.children[1].id = `${f.children[1].id}_${newSectionsCounter}`;
    clone.children[1].value = "";
    clone.children[2].dataset.errorName = `${f.children[2].dataset.errorName}_${newSectionsCounter}`;
    div.appendChild(clone);
    clone.children[1].name === "section-position[]"
      ? watchPositionAndValidate(clone.children[1], state)
      : watchElementAndValidate(clone.children[1]);
  });
});

sectionForm.addEventListener("submit", function (e) {
  console.log("we ran");
  const newfields = newSectionsContainer.querySelectorAll(".form-field");
  e.preventDefault();
  state.errorArray = validateAndShowError(sectionTitle, state.errorArray);
  state.errorArray = validateAndShowError(sectionContent, state.errorArray);
  const { errArray } = validatingPosition(
    sectionPosition,
    state.errorArray,
    state.positionArray
  );
  state.errorArray = [...errArray];

  console.log("we ran");
  newfields.forEach((f) => {
    if (f.children[1].name === "section-position[]") {
      const res = validatingPosition(
        f.children[1],
        state.errorArray,
        state.positionArray
      );
      state.errorArray = res.errArray;
      state.positionArray = res.positionArray;
    } else {
      state.errorArray = validateAndShowError(f.children[1], state.errorArray);
    }
  });

  console.log(state.errorArray);
  if (state.errorArray.length === 0) {
    this.submit();
  }
});
