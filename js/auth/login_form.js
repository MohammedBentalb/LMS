import {
  validateAndShowError,
  watchElementAndValidate,
} from "../validation/validation.js";

const authForm= document.querySelector("form");
const userEmail = document.querySelector("#user-email");
const userPassword = document.querySelector("#user-password");

let errorArray = [];

watchElementAndValidate(userEmail, errorArray);
watchElementAndValidate(userPassword, errorArray);


authForm.addEventListener("submit", function (e) {
  e.preventDefault();
  errorArray = validateAndShowError(userEmail, errorArray);
  errorArray = validateAndShowError(userPassword, errorArray);
  if (errorArray.length === 0) {
   this.submit();
  }
  console.log(errorArray);
});

console.log(errorArray);
