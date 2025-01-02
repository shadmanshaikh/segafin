<?php

namespace App\Livewire\Features\Invoice;

use App\Models\invoicedb;
use App\Models\soadb;
use App\Models\Stocks;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;


class MakeInvoice extends Component
{
    use Toast;
    public bool $addProducts = false;
    public $products = [
        ['product' => '', 'quantity' => '', 'price' => '', 'amount' => '']
    ];
    public $invoiceNumber , $contractPeriod , $customerName , $address , $typePS , $doi ;
    public $totalamount;
    public $productName;
    public function mount(){
        $users = User::take(5)->get();
        $this->productName = Stocks::all();
        // dd($users); 
    }
    public function render()
    {
        return view('livewire.features.invoice.make-invoice');
    }
    public function addItems()
    {
        $this->products[] = ['product' => '', 'quantity' => 0 , 'amount' => 0.00 , 'price' => 0.00];
    }
    public function removeItem($index)
    {
        // Only remove if there are multiple rows
        if (count($this->products) > 1) {
            unset($this->products[$index]);
            // Re-index the array to maintain proper indices
            $this->products = array_values($this->products);
        }
    }

    public function save(){
        $typeOfPS = '';
        if($this->typePS == 1){
            $typeOfPS = 'Purchase';
        }else { $typeOfPS = 'Sales';}

        foreach ($this->products as $product) {
            $this->totalamount += (float) ($product['amount'] ?? 0);  // Convert to float to ensure decimal handling
        }

            

        $this->products = [];
        $this->totalamount = 0;
        $this->success('Invoice Saved' , redirectTo: 'invoice-list');
        // dd($this->invoiceNumber , $this->contractPeriod , $this->customerName , $this->address , $typeOfPS , $this->products , $this->totalamount);
    }
}
