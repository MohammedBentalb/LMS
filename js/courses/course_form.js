import { validateAndShowError, watchElementAndValidate } from "../validation/validation.js";

const courseForm = document.querySelector("form");
const courseTitle = document.querySelector("#course-title");
const courseType = document.querySelector("#course-type");
const courseLevel = document.querySelector("#course-level");
const courseContent = document.querySelector("#course-content");
const courseImage= document.querySelector("#course-image");

let errorArray = [];

watchElementAndValidate(courseTitle);
watchElementAndValidate(courseType);
watchElementAndValidate(courseLevel);
watchElementAndValidate(courseContent);
watchElementAndValidate(courseImage);

courseForm.addEventListener("submit", function (e) {
  e.preventDefault();
  errorArray = validateAndShowError(courseTitle, errorArray);
  errorArray = validateAndShowError(courseLevel, errorArray);
  errorArray = validateAndShowError(courseType, errorArray);
  errorArray = validateAndShowError(courseContent, errorArray);
  errorArray = validateAndShowError(courseImage, errorArray);

  if (errorArray.length === 0) {
    this.submit();
  }
  console.log(errorArray);
});
