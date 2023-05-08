<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $Welcome = "Bienvenid@, estas son tus tareas!";
    public $listeners =['taskSaved']; //palabra reservada para eventos (es como decir que esta escuchando) padre
 //ahora esto se encuentra en main.blade.php
    public function taskSaved($acciontarea){
        session()->flash('message', $acciontarea); //MENSAJE QUE SE MUESTRA CUANDO GUARDA
    }
    public function render()
    {
        return view('livewire.main');
    }
}
