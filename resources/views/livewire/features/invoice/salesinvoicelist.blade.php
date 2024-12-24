<?php

use App\Models\invoicedb;
use Livewire\Volt\Component;
use App\Models\User;
use Illuminate\Support\Collection;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator; 


new class extends Component {
    use Toast;
    use WithPagination;
    public string $search = '';
    public bool $drawer = false;
    public $invoice_number;
    public array $sortBy = ['column' => 'invoicenumber', 'direction' => 'asc'];

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
            ['key' => 'invoicenumber', 'label' => 'Invoice Number', 'class' => 'w-64'],
            ['key' => 'customername', 'label' => 'Customer Name'],
            ['key' => 'typeps' , 'label' => 'Type']
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): LengthAwarePaginator 
    {
        $allusers = invoicedb::query();
    
        return $allusers
            
            ->when($this->search, function ($query) {
                $query->where('invoicenumber', 'like', '%' . $this->search . '%');
            })->where('typeps' , 'sales')
            ->paginate(5); // Ensure we return paginated results
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
<x-header title="Invoice" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" />
        </x-slot:actions>
</x-header>


    <div class="flex justify-end">
        <x-button icon="o-plus" class="btn-primary btn-sm mb-3" link="make-invoice" label="Invoice"/>
    </div>
    <x-card>
        <x-table :headers="$headers" :rows="$users" :sortBy="$sortBy"  with-pagination>
            @scope('actions', $user)
           <!-- Correct way to pass the $id parameter to the Livewire method -->
           <x-button icon="o-eye" class="btn-ghost btn-sm" link="/invoice/{{$user->id}}" />

            @endscope
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
