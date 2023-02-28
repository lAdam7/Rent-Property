<div>
    <div class="flex justify-center space-x-5">
        {{-- <input type="text" placeholder="Search City or Town" wire:model="searchTerm" > --}}
        <x-form.input name="search city or town" required autocomplete="email" />

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
                </article>
    @endforeach

    {{ $properties->links() }}
</div>
