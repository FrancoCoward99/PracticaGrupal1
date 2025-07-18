//ARRAY = []
//JSON = {}

//Un array es un conjunto de elementos. Pueden ser de cualquier tipo(Cadenas, Números, JSON...)

document.addEventListener('DOMContentLoaded', function () {

    const array = [1, 2, 3, 4, 5]

const tasks = [
    {
        id: 1,
        title: "Completar Tarea Progra",
        description: "Preparar y subir la tarea"
    },
    {
        id: 2,
        title: "Limpiar casa",
        description: "Preparar casa para las visitas"
    },
    {
        id: 3,
        title: "Limpiar casa",
        description: "Preparar casa para las visitas"
    },
    {
        id: 4,
        title: "Limpiar casa",
        description: "Preparar casa para las visitas"
    },
    {
        id: 5,
        title: "Limpiar casa",
        description: "Preparar casa para las visitas"
    }
]


function cargaTareas() {

    const taskList = document.getElementById("task-list")

    taskList.innerHTML = ''

    tasks.forEach(function (task) {

        const taskCard = document.createElement("div")
        taskCard.className = "col-md-4 mb-3"
        taskCard.innerHTML = `       
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title"> ${task.title} </h5>
                    <p class="card-text">${task.description}</p>
                </div>

                <div class="card-footer">
                    <button class="btn btn-secondary btn-sm edit-task">Editar</button>
                    <button class="btn btn-secondary btn-sm delete-task">Eliminar</button>
                </div>
        </div>`;

        taskList.appendChild(taskCard)

    })

}

cargaTareas();

})
