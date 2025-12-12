export function watchElementAndValidate(element) {
  if (!element) return;
  element.addEventListener("input", () => {
    validateAndShowError(element);
  });
}

export function validateAndShowError(element, errorArr) {
  const fieldName = element.id.split("-")[1];
  const result = validatingFormInput(element);
  showFieldError(fieldName, result);
  if (!errorArr) return;
  if (result)
    return errorArr.includes(fieldName) ? errorArr : [...errorArr, fieldName];

  return errorArr.filter((e) => e !== fieldName);
}

export function validatingFormInput(element) {
  const AllowedTypes = ["image/jpeg", "image/jpg", "image/png"];
  const preview = document.querySelector(".preview-image img");
  const parentpreview = document.querySelector(".preview-image");
  if (!element) return "the element not found";
  if (element.type === "file") {
    if (
      element.files.length === 0 ||
      !AllowedTypes.includes(element.files[0].type)
    ) {
      element.previousElementSibling.classList.remove("full");
      element.previousElementSibling.classList.add("empty");
      parentpreview.classList.add("is-hidden");
      return "incorrect file format";
    }
    preview.src = URL.createObjectURL(element.files[0]);
    parentpreview.classList.remove("is-hidden");
    element.previousElementSibling.classList.add("full");
    element.previousElementSibling.classList.remove("empty");
    return "";
  }
  if (!element.value.trim()) return "field can not be empty";
  return "";
}

export function showFieldError(fieldName, msg) {
  if (!fieldName) throw new Error("field error name must be set");
  const fieldError = document.querySelector(`p[data-error-name=${fieldName}]`);
  const targetField =
    document.querySelector(`#course-${fieldName}`) ??
    document.querySelector(`#section-${fieldName}`);
  if (!fieldError || !targetField) return;

  fieldError.classList.toggle("is-hidden", msg.trim() == "");
  fieldError.textContent = msg;
  targetField.classList.toggle("wrong-content", msg.trim() !== "");
}

export function editeValidatingImage(element) {
  const editField = document.querySelector(".edit-image-field");
  editField.classList.remove("is-hidden");
  editField.style.color = "green";
  const AllowedTypes = ["image/jpeg", "image/jpg", "image/png"];
  const preview = document.querySelector(".preview-image img");

  element.addEventListener("change", function () {
    if (
      element.files.length === 0 ||
      !AllowedTypes.includes(element.files[0].type)
    ) {
      element.previousElementSibling.classList.remove("full");
      editField.textContent = "Old image will persist if not changed";
      preview.src = "../../assets/1.jpg";
      preview.classList.add("is-hidden");
      return;
    }
    preview.src = URL.createObjectURL(element.files[0]);
    preview.classList.remove("is-hidden");
    element.previousElementSibling.classList.add("full");
    editField.textContent = "New image will be sent";
  });
}

export function validatingPosition(element, errorArr, positionArray) {
  if (!element || !positionArray || !errorArr) return ;
  const fieldName = element.id.split("-")[1];
  positionArray = positionArray.filter((p) => p.input !== element.id);

  
  if (Number(element.value.trim()) === 0 || isNaN(Number(element.value.trim()))) {
    showFieldError(fieldName, "Invalid position; must be greater than 0");
    return {errArray: errorArr.includes(fieldName) ? errorArr : [...errorArr, fieldName], positionArray};
  }
  
  const foundDouble = positionArray.find(p => p.position === element.value.trim())
  if(foundDouble){
    showFieldError(fieldName, `Can't accept duplicated position: ${element.value.trim()}`);
    return {errArray: errorArr.includes(fieldName) ? errorArr : [...errorArr, fieldName], positionArray};
  }

  showFieldError(fieldName, "");
  return { errArray: errorArr.filter((e) => e != fieldName), positionArray : [...positionArray, {input: element.id, position: element.value.trim()}]};
}


export function watchPositionAndValidate(element, state) {
  if (!element) return;
    element.addEventListener("input", () => {
      const result = validatingPosition( element, state.errorArray, state.positionArray);
    state.errorArray = result.errArray;
    state.positionArray = result.positionArray;
  });
}