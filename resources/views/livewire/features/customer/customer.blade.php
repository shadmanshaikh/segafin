<?php

use App\Models\soadb;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;
    public $customer_name;

    public function totalBalance(){
        $getBalance = soadb::where('customer_name', $this->customer_name)->sum('totalamount');
        // dd($getBalance);
        return $getBalance;
    }
    public function with(): array
    {
        return [
            'totalBalance' => $this->totalBalance(), 
        ];
    }


}; ?>

<div>
    <!-- HEADER -->
    <x-header title="{{$customer_name}}" separator progress-indicator></x-header>
    <div>
         <x-card title="Statement of Accounts">
            <p class="text-xl">Total Amount Balance : {{$totalBalance}}</p>
        </x-card>
    </div>


</div>
