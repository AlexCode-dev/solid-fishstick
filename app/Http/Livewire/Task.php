<?php

namespace App\Http\Livewire;

use App\Models\Task as ModelsTask; //crea un alias por que se llama igual que el componente
use Livewire\Component;

class Task extends Component
{
    public $tasks;
    public ModelsTask $task; //es el objeto de la tarea
    //se encuentra en la documentacion lifecyclehooks
    //se ejecuta 1 sola vez solamente cuando se carga la pagina

    protected $rules = ['task.text' =>'required|max:40'];
    public function mount(){
        $this->tasks = ModelsTask::orderBy('id','desc')->get();//obtiene todos los datos y lo almacena en la variable tasks//con ordenBy nos muestra ordenado del ultimo hacia abajo
        $this->task = new ModelsTask(); //creamos una nueva instancia, es decir es un objeto vacio podemos hacer un dd(this->task) para ver
    }
    //save, nos permite guardar los datos
    public function save(){
        $this->validate(); //se ejecutara el $rules
        $this->task->save();//guarda datos
       
        $this->mount();//limpiar datos y permite crear una tarea sin recargar la pagina
        $this->emitUp('taskSaved','Tarea Guardada Correctamente!'); //emite un evento hijo con un parametro que es el string('Tarea Guardada Correctamente!')
       
    }

    //para actualizarlo en "vivo" en el momento que añadimos la tarea por el input 
    //segun la documentacion tenemos que poner de esta manera el metodo + el objeto + lo que queremos actualizar de ese objeto..
    public function updatedTaskText(){
        $this->validate(['task.text' =>'required|max:40']);
    }

    //para editar el elemento 
    //usamos model binding // la otra forma es recibir el id y buscalo // se ejecuta el save automaticamente luego de dar guardar

    public function edit(ModelsTask $task){
        $this ->task = $task; 
  
    }

    //borrado de la otra forma
    public function delete($id){
        $taskToDelete= ModelsTask::find($id); // metodo para buscar ese id
        //si no es nullo entonces elimina
        if(!is_null($taskToDelete)){  
            $taskToDelete->delete();
            $this->emitUp('taskSaved','Tarea Borrada Correctamente!');
            $this->mount(); //para que se actualice solo
        }
    }

    //cuando clickeamos el checkbox
    public function done(ModelsTask $task){
        //update para actualizar el elemento
        $task->update(['done'=> !$task->done]); //si clickeamos, se actualiza en la base de datos
        $this->mount();//para actualizar la vista nuevamente
    }


    //renderiza la vista task
    public function render()
    {
        return view('livewire.task');
    }
}
