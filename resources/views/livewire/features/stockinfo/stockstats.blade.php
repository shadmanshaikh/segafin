<?php

use App\Models\Stocks;
use Livewire\Volt\Component;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Mary\Traits\Toast;
new class extends Component {
    use Toast;
    public $name , $code;
    public string $search = '';
    public bool $addProductDrawer = false;
    public bool $drawer = false;
    public bool $addStockDrawer = false;
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
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-1 font-bold'],
            ['key' => 'purchaseqty', 'label' => 'Purchase Qty'],
            ['key' => 'salesqty', 'label' => 'Sale Qty'],
            ['key' => 'balanceqty', 'label' => 'Balance Qty'],
            ['key' => 'totalpurchaseamount', 'label' => 'Total Purchase Amount'],
            ['key' => 'avgpurchaseprice', 'label' => 'Average Purchase Price'],
            ['key' => 'stockvalue', 'label' => 'Stock Value'],
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
        $allusers = Stocks::all();
        
        return $allusers
            ->sortBy($this->sortBy) // Correcting the sortBy usage
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(function ($item) {
                    return str($item->name)->contains($this->search, true); // Accessing the 'name' attribute directly
                });
            });
    }
    public function saveStock()
    {
        Stocks::create([
            'name' => $this->name,
            'itemcode' => $this->code,
            'purchaseqty' => 0,
            'salesqty' => 0, 
            'balanceqty' => 0,
            'totalpurchaseamount' => 0,
            'avgpurchaseprice' => 0,
            'stockvalue' => 0
        ]);

        $this->addProductDrawer = false;
        $this->name = '';
        $this->success('Stock added successfully');
    }
    public function getuser($id){
        $finder = User::find($id);
        dd($id);
    }
    public function with(): array
    {
        return [
            'users' => $this->users(),
            'headers' => $this->headers()
        ];
    }
}; ?>

<div>
<x-header title="Stock Statement" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
</x-header>

<!-- add Stock Drawer -->
 <div class="flex justify-end">
    <x-button icon="o-plus" class="btn-sm btn-primary mb-3" label="Add product" wire:click="$toggle('addProductDrawer')" />
 </div>
<x-drawer wire:model="addProductDrawer" title="Add Stock" right separator with-close-button class="lg:w-1/3">
    <x-form wire:submit.prevent="saveStock">
        <div class="space-y-4">
            <x-input label="Product Code" wire:model="code" placeholder="Enter product code" />
            <x-input label="Product Name" wire:model="name" placeholder="Enter product name" />
        </div>
        <x-slot:actions>
            <x-button label="Cancel" icon="o-x-mark" wire:click="$set('addProducts', false)" />
            <x-button type="submit" label="Save" icon="o-check" class="btn-primary" spinner />
        </x-slot:actions>
    </x-form>
</x-drawer>
<!--  -->
    <x-card>
        <x-table :headers="$headers" :rows="$users" :sort-by="$sortBy">

        </x-table>
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass" @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>
</div>
