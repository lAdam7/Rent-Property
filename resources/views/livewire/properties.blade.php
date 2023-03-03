<div>
    <div class="flex justify-center space-x-5 flex-wrap bg-gray-150 mt-10">
        {{-- <x-form.input wire:model="searchTerm" name="search city or town" required /> --}}
        <x-form.field>
            <x-form.label name="search city or town" />
        
            <input 
                wire:model="searchTerm"
                class="border border-gray-200 p-2 w-full rounded" 
                name="search city or town" 
                id="search_city_or_town" 
            />
        </x-form.field>

        <script>  
            function initialize() {
                var input = document.getElementById('search_city_or_town');
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: 'GB'}
                };
                var autocomplete = new google.maps.places.Autocomplete(input, options);

                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    Livewire.emit('updateTerm', place['formatted_address']);
                });
            }
        </script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDtgYgD8fRvBnmXX7qVU_tpSwFTUKuwUqw&libraries=places&region=GB&callback=initialize" ></script>
        
        <x-form.field>
            <x-form.label name="property type" />

            <div x-data="{ show: false, typesSelectedString: '' }" @click.away="show = false" class="relative" style="width: 200px">
                <div @click="show = !show" class="border border-gray-200 p-2 w-full rounded">
                    {!! (count($typesSelected) === 0) ? 'None' : '<p class="truncate ... overflow-hidden" x-text="typesSelectedString"></p>' !!}
                </div>

                <div x-show="show" class="absolute border z-100 border-gray-200 bg-white p-2 rounded mt-3 w-full" style="display: none">
                    @foreach ($types as $type)
                        <div 
                            wire:click="typePressed({{ $type->id }})"
                            @click="show = false"
                            class="flex justify-between hover:bg-gray-300 p-2"
                        >
                            <p class="select-none">
                                {{ ucwords($type->name) }}
                            </p>

                            @if (in_array($type->id, $typesSelected))
                                <x-check 
                                    x-init="typesSelectedString = '{{ ucwords($type->name) }}' + '{{ count($typesSelected) > 1 ? ' + ' . count($typesSelected)-1 : '' }}'"
                                />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </x-form.field>

        {{-- Includes --}}
        <x-form.field>
            <x-form.label name="Include" />

            <div x-data="{ show: false, includesSelectedString: '' }" @click.away="show = false" class="relative" style="width: 200px">
                <div @click="show = !show" class="border border-gray-200 p-2 w-full rounded">
                    {!! count(array_filter($includes)) === 0 ? 'None' : '<p class="truncate ... overflow-hidden" x-text="includesSelectedString"></p>' !!}
                </div>                                                                      
                <div x-show="show" class="absolute border z-100 border-gray-200 bg-white p-2 rounded mt-3 w-full" style="display: none">


                    <div
                        class="flex justify-between hover:bg-gray-300 p-2"
                        wire:click="flipFurnished()"
                        @click="show = false"
                    >
                        <p class="select-none">
                            Furnished
                        </p>

                        @if ($includes['furnished'])
                            <x-check 
                                x-init="includesSelectedString = 'Furnished' + '{{ count(array_filter($includes)) > 1 ? ' + ' . count(array_filter($includes))-1 : '' }}'"
                            />
                            
                        @endif
                    </div>
                    <div
                        class="flex justify-between hover:bg-gray-300 p-2"
                        wire:click="flipGarden()"
                        @click="show = false"
                    >
                        <p class="select-none">
                            Garden
                        </p>

                        @if ($includes['garden'])
                            <x-check 
                                x-init="includesSelectedString = 'Garden' + '{{ count(array_filter($includes)) > 1 ? ' + ' . count(array_filter($includes))-1 : '' }}'"
                            />
                            
                        @endif
                    </div>
                    <div
                        class="flex justify-between hover:bg-gray-300 p-2"
                        wire:click="flipParking()"
                        @click="show = false"
                    >
                        <p class="select-none">
                            Parking
                        </p>

                        @if ($includes['parking'])
                            <x-check
                                x-init="includesSelectedString = 'Parking' + '{{ count(array_filter($includes)) > 1 ? ' + ' . count(array_filter($includes))-1 : '' }}'"
                            />                           
                        @endif
                    </div>




                </div>
            </div>
        </x-form.field>

        <x-form.field>
            <x-form.label name="sort by" />

            <select class="border border-gray-200 p-2 w-full rounded" wire:model="sort_by">
                <option value="created_at.DESC">Newest Listed</option>
                <option value="created_at.ASC">Oldest Listed</option>
                <option value="price.DESC">Highest Price</option>
                <option value="price.ASC">Lowest Price</option>
            </select>
        </x-form.field>
    </div>
    
    <main class="max-w-3xl mx-auto">
        @if($properties->count())
            @foreach ($properties as $property)
                <x-property-card :property="$property"/>
            @endforeach
        @else
            <p class="text-center"><strong>We have no properties matching your search!</strong></p>
        @endif
    </main>

    {{-- @foreach ($properties as $property)
                <article
                    class="flex justify-center transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"
                >
                    <div class="py-6 px-5">
                        {{ $property->street }}, {{ $property->town_or_city }}
                    </div>
                    <div class="py-6 px-5">
                        |
                    </div>
                    <div class="py-6 px-5">
                        £{{ $property->price }} {{ ucwords($property->frequency->name) }}
                    </div>
                    <div class="py-6 px-5">
                        |
                    </div>
                    <div class="py-6 px-5">
                        <strong>{{ ucwords($property->type->name) }}</strong>
                    </div>
                </article>
    @endforeach --}}

    {{-- {{ $properties->links() }} --}}
</div>
