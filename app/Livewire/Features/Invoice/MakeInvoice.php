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

        foreach ($this->products as $product) {
            
            $stock = Stocks::where('name', $product['product'])->first();
            if ($stock) {
                dd(true);
                // $stock->purchaseqty += $product['quantity'];
                // $stock->totalpurchaseamount += $product['amount'];
                // $stock->save();
            }else{
                dd(false);
            }
        }
      
        // invoicedb::create([
        //     'invoicenumber' => $this->invoiceNumber ,
        //     'contractperiod' => $this->contractPeriod ,
        //     'customername' => $this->customerName ,
        //     'address' => $this->address ,
        //     'typeps' => $typeOfPS,
        //     'doi' => $this->doi ,
        //     'data' => $this->products,
        //     'totalamount' => $this->totalamount
        // ]);

        // soadb::create([
        //     'date' => $this->doi,
        //     'invoicenumber' => $this->invoiceNumber,
        //     'data' => $this->products,
        //     'customer_name' => $this->customerName,
        //     'totalamount' => $this->totalamount,
        //     'typeps' =>  $this->typePS
        // ]);



        $this->products = [];
        $this->totalamount = 0;
        $this->success('Invoice Saved' , redirectTo: 'invoice-list');
        // dd($this->invoiceNumber , $this->contractPeriod , $this->customerName , $this->address , $typeOfPS , $this->products , $this->totalamount);
    }
}
