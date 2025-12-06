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
    return (errorArr = errorArr.includes(fieldName)
      ? errorArr
      : [...errorArr, fieldName]);

  return (errorArr = errorArr.filter((e) => e !== fieldName));
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
    console.log(preview);

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
  const targetField = document.querySelector(`#course-${fieldName}`);
  if (!fieldError || !targetField) return;

  fieldError.classList.toggle("is-hidden", msg.trim() == "");
  fieldError.textContent = msg;
  targetField.classList.toggle("wrong-content", msg.trim() !== "");
}

function handleImageErrorState(parentPreview, preview) {}
