const profile = document.querySelector(".profile");
const profileOptions = profile.querySelector(".options");

profile.addEventListener('click', ()=>{    
    profileOptions.classList.toggle('is-hidden')
})