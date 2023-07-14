
const lapso = document.querySelector('.lapso')
const notas = document.querySelectorAll('.notas')
const cantidad = document.querySelector('.cantidad')
const enviarCantidad = document.querySelector('.enviarCantidad')
const table = document.querySelector('.table thead tr')
const form = document.querySelector('.aaa')
const insertar = document.querySelectorAll('.insertar')


enviarCantidad.addEventListener("click", agregarCantidadNotas)

console.log(insertar);


function agregarCantidadNotas() {
    for(let i = 1; i <= cantidad.value; i++) {
        const lapsoNotas = document.createElement("th");
        lapsoNotas.textContent = `Notas ${i}`
        console.log(i);
        table.insertBefore(lapsoNotas, lapso)
    }



    
    for(let i = 1; i <= cantidad.value; i++) {
        

        const lapsoNotas = document.createElement("td");
        lapsoNotas.textContent = `Notas ${i}`
        console.log(i);
        form.insertBefore(lapsoNotas, insertar)
    }

    // notas.forEach(nota => {
        
    // });


}