<div>

    <div class="flex justify-center space-x-5">
        <x-form.input name="search city or town" required autocomplete="email" />

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
                                <x-coolicon-check x-init="typesSelectedString = '{{ ucwords($type->name) }}' + '{{ count($typesSelected) > 1 ? ' + ' . count($typesSelected)-1 : '' }}'" class="h-6 w-6 text-blue-600" />
                            @endif
                        </div>
                    @endforeach
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

    @foreach ($properties as $property)
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
    @endforeach

    {{ $properties->links() }}
</div>
