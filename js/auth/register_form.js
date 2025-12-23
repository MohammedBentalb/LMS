import {
  validateAndShowError,
  validatePasswordMatch,
  watchElementAndValidate,
} from "../validation/validation.js";

const authForm= document.querySelector("form");
const userName = document.querySelector("#user-name");
const userEmail = document.querySelector("#user-email");
const userPassword = document.querySelector("#user-password");
const userPasswordMatch = document.querySelector("#user-match");

let errorArray = [];

watchElementAndValidate(userName, errorArray);
watchElementAndValidate(userEmail, errorArray);
watchElementAndValidate(userPassword, errorArray);
watchElementAndValidate(userPasswordMatch, errorArray);


authForm.addEventListener("submit", function (e) {
  e.preventDefault();
  errorArray = validateAndShowError(userName, errorArray);
  errorArray = validateAndShowError(userEmail, errorArray);
  errorArray = validateAndShowError(userPassword, errorArray);
  errorArray = validateAndShowError(userPasswordMatch, errorArray);
  errorArray = validatePasswordMatch(userPassword, userPasswordMatch, errorArray)
  if (errorArray.length === 0) {
   this.submit();
  }
  console.log(errorArray);
});

console.log(errorArray);
