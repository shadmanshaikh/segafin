


<div>
        {{-- Be like water. --}}
        <x-header title="Make Invoice" separator progress-indicator />

    <x-form wire:submit="save">

        <div class="lg:grid grid-rows-2 grid-cols-3 gap-3 mt-3">
            <div>
                <x-input label="Invoice #" placeholder="INV0001" wire:model="invoiceNumber"/>
            </div>
            <div>
                <x-datepicker label="Date of Issue"  icon="o-calendar" wire:model="doi"/>
            </div>
            <div>
                  <x-input label="Contract Period" placeholder="eg, 20" wire:model="contractPeriod"/>
            </div>
            <div>
                <x-input label="Customer Name" placeholder="John doe" wire:model="customerName"/>
            </div>
            <div>
                <x-input label="Address" placeholder="DCC , Deira" wire:model="address"/>
            </div>
            <div class="">
                    @php
                        $type = [
                                        [
                                            "id" => 1,
                                            "name" => "Purchase"
                                        ],
                                        [
                                            "id" => 2,
                                            "name" => "Sales"
                                        ]
                                    ]

                    @endphp
                <x-select label="Type" icon="o-cube" placeholder="Select Type"  :options="$type" wire:model="typePS" />
            </div>
        </div>

    <div>
        <x-card class="mt-3" title="Add products" shadow separator>
            <!-- Loop through the products array to display each product's input fields -->
         
            @foreach($products as $index => $product)
                <div class="lg:grid grid-rows-1 grid-cols-4 gap-3 mt-3" wire:key="product-{{ $index }}">
                    <div>
                    <x-select 
                        label="Product" 
                        icon="o-cube" 
                        :options="$productName" 
                        wire:model="products.{{ $index }}.product" 
                        placeholder="select product"
                    >   
           
                    </x-select>

                    <x-drawer wire:model="addProducts" class="w-11/12 lg:w-1/3" right>
                        <div>...</div>
                        <x-button label="Close" @click="$wire.showDrawer2 = false" />
                    </x-drawer>
                    </div>
                    <div>
                        <x-input 
                            label="Quantity" 
                            placeholder="3" 
                            wire:model="products.{{ $index }}.quantity" 
                        />
                    </div>
                    <div>
                         <x-input 
                            label="Price" 
                            placeholder="3" 
                            wire:model="products.{{ $index }}.price" 
                        />
                    </div>
                    <div>
                        <x-input 
                            label="Amount" 
                            placeholder="10000"
                            wire:model="products.{{ $index }}.amount" 
                        />
                    </div>

                    <!-- Remove button (only show if there is more than one product row) -->
                    @if(count($products) > 1)
                        <div class="mt-3">
                            <x-button 
                                icon="o-minus" 
                                class="btn btn-error btn-sm" 
                                wire:click="removeItem({{ $index }})">
                                Remove
                            </x-button>
                        </div>
                    @endif
                </div>
            @endforeach

            <!-- Button to trigger adding a new product row -->
            <x-button icon="o-plus" class="btn btn-primary btn-sm mt-3" wire:click="addItems"/>
        </x-card>
    </div>


        <div class="lg:grid grid-cols-1">
            <x-button label="save" class="btn btn-primary mt-3" type="submit" spinner="save"/>
        </div>

        </x-form>

    </div>
