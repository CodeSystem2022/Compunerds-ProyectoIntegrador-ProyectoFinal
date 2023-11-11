let profile = document.querySelector('header .flex  .profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');    
    navbar.classList.remove('active');
}

let navbar = document.querySelector('header .flex  .navbar');

document.querySelector('#menu-bar').onclick = () =>{
    navbar.classList.toggle('active');
    profile.classList.remove('active');
}

window.onscroll = () =>{
    profile.classList.remove('active');
    navbar.classList.remove('active');
}

document.querySelectorAll('input[type="number"]').forEach(input =>{
    input.oninput = () => {
        if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLength);
    }
});