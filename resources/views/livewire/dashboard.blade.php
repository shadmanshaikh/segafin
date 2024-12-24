<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
new class extends Component {
    //
    public $name;
    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->to('/');
        }
    }
}; ?>

<div>
<x-header title="Dashboard" separator progress-indicator />
    <div class="lg:px-4 sm:px-4 md:px-2">
    <div class="grid lg:grid-cols-[1fr_1fr_1fr_1fr] sm:grid grid-cols-[1fr] md:grid grid-cols-[1fr] gap-2">
            
            <x-stat title="Total Stocks" value="44" icon="o-envelope" tooltip="Hello" />
    
            <x-stat
                title="In Stocks"
                description="This month"
                value="22"
                icon="o-arrow-trending-up"
                tooltip-bottom="There" />
            
            <x-stat
                title="Out Stocks"
                description="This month"
                value="34"
                icon="o-arrow-trending-down"
                tooltip-left="Ops!" />
            
            <x-stat
                title="Sales"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-down"
                class="text-black-500"
                color="text-indigo-500"
                tooltip-right="Gosh!" />
        </div>    
    </div>
</div>
