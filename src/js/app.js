document.addEventListener("DOMContentLoaded",
function(){
    eventListener();
    darkMode()

});

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme:dark)');
    if(prefiereDarkMode["matches"]){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }
    prefiereDarkMode.addEventListener('change',function(){
        if(prefiereDarkMode["matches"]){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    })

    const btDarkMode = document.querySelector('.dark-mode-boton');
    btDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    })
}

function eventListener(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click',navegacionResponsive)
    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="forma_contacto"]');
    metodoContacto.forEach(input =>input.addEventListener('click',mostrarMetodosContacto));
}
function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}
function mostrarMetodosContacto(e){
   const contactoDiv = document.querySelector('#contacto');
   if(e.target.value == 'llamada'){
    contactoDiv.innerHTML = `
    <p>Ingrese el numero que le gustaria ser contactado</p>
    <label for="cel">Celular</label>
    <input type="tel" placeholder="Tu número de celular" id="cel" name="cel" required>
    <p>Elija la fecha y la hora para ser contactado</p>
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" required>
    <label for="hora">Hora</label>
    <input type="time" id="hora" name="hora" min="09:00" max="18:00" required>
    `;
   }else{
    contactoDiv.innerHTML = `
    <p>Ingrese el correo donde le gustaria ser contactado</p>
    <label for="email">Email</label>
    <input type="email" placeholder="Tu correo electronico" id="email" name="email" required>
    `;
    
   }
   console.log(e);
}