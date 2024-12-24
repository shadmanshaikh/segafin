<?php

use Livewire\Volt\Component;

new class extends Component {
    //
    public $changeText = "Dark";
    public function mount(){
        
    }
    public function onClick(){
        $this->changeText = "Light";
    }

}; ?>

<div>
    <x-header title="Settings" />
    <x-card >
        <div>
            <p class="text-xl mb-3" >Change the theme to {{$changeText}} mode</p>
        </div>

    </x-card>

</div>
