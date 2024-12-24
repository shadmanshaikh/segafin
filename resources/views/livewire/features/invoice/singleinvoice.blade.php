<?php

use App\Models\invoicedb;
use Livewire\Volt\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;
new class extends Component {
    use Toast;

    public string $search = '';
    public $globalInvoiceNumber , $globalContractPeriod , $globalCustomerName , $globalAddress , $globalType , $globalData , $globaldoi , $globalDueDate , $globalTotalAmount;
    public bool $drawer = false;
    public $decodedJson;
    public $invoice_number;
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'email', 'label' => 'E-mail'],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        $allusers = User::all();
        
        return $allusers
            ->sortBy($this->sortBy) // Correcting the sortBy usage
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(function ($item) {
                    return str($item->name)->contains($this->search, true); // Accessing the 'name' attribute directly
                });
            });
    }
    public function InvoiceDetails() {
            
            $invoiceDetail = invoicedb::find($this->invoice_number);
            $this->globalInvoiceNumber = $invoiceDetail->invoicenumber;
            $this->globalCustomerName = $invoiceDetail->customername;
            $this->globalAddress = $invoiceDetail->address;
            $this->globalType = $invoiceDetail->typeps;
            $this->globaldoi = $invoiceDetail->doi;
            $this->globalContractPeriod = $invoiceDetail->contractperiod;

            $parseDate = Carbon::parse($this->globaldoi); // Parse the date
            $this->globalDueDate = $parseDate->copy()->addDays($this->globalContractPeriod)->format('d-m-Y'); // Format as dd-mm-yyyy
            $this->globaldoi = $parseDate->format('d-m-Y');

            $this->globalData = $invoiceDetail->data;
            $this->globalTotalAmount = $invoiceDetail->totalamount;
             
                // $this->decodedJson = json_decode($this->globalData, true);
                // dd($this->globalData);
            return $invoiceDetail;
          
            // dd($invoiceDetail);
    }
    public function getuser($id){
        $finder = User::find($id);
        dd($id);
    }
    public function with(): array
    {
        return [
            'users' => $this->users(),
            'headers' => $this->headers(),
            'invoicedetails' => $this->InvoiceDetails()
        ];
    }
}; ?>

<div>
    <x-header title="{{$globalInvoiceNumber}}"/>
    <x-card title="{{$globalInvoiceNumber}}" >
        <div class="grid grid-rows-1 grid-cols-2">
            <div class="flex justify-start ">
                <div>
                    <span class="xl font-bold">BILL TO :</span> 
                    <p class="xl font-bold">Customer Name : {{$globalCustomerName}}</p>
                    <p class="xl font-bold">Address : {{$globalAddress}}</p>
                </div>
            </div>
            <div class="flex justify-end">
                <div>
                     <span class="xl font-bold">INVOICE DETAILS :</span>
                     <p class="xl font-bold">Date of Issue : {{$globaldoi}}</p> 
                     <p class="xl font-bold">Invoice # : {{$globalInvoiceNumber}}</p> 
                     <p class="xl font-bold">Due Date : {{$globalDueDate}}</p> 
                </div>
            </div>
          
        </div>
        <div class="flex justify-center">
            <table class="table-auto border-collapse border mt-5 w-full">
                <thead>
                    <tr>
                        <th class="border border-gray-400 px-4 py-2">Product</th>
                        <th class="border border-gray-400 px-4 py-2">Quantity</th>
                        <th class="border border-gray-400 px-4 py-2">Amount</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($globalData as $item)
                        <tr>
                            <td class="border border-gray-400 px-4 py-2">{{ $item['product'] }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $item['quantity'] }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $item['amount'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <p class="xl mt-5 text-center">Totat Amount : {{$globalTotalAmount}}</p>
        </div>

    </x-card>


</div>
