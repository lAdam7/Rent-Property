<x-layout>
    <x-admin.layout heading="Add Property">
        <form method="POST" action="add" enctype='multipart/form-data'>
            @csrf

            <p class="text-gray-500 text-xs">*Name is only visible to you, to help identify your properties</p>
            <x-form.input name="name" required :value="old('name', '')" />
            

            <x-form.input name="images[]" type="file" required multiple />

            <x-form.input name="street" required :value="old('street', '')" />
            <x-form.input name="town or city" required :value="old('town_or_city', '')" />

            <div class="flex justify-between">
                <x-form.input name="available" type="date" value="{{ date('Y-m-d') }}" required />
                
                <x-form.field>
                    <x-form.label name="type" />

                    <select name="property_type_id" id="property_type_id">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ ucwords($type->name) }}</option>
                        @endforeach
                    </select>

                    <x-form.error name="type" />
                </x-form.field>
            </div>


            <div class="flex justify-between">
                <x-form.input name="deposit" type="number" :value="old('deposit', 250)" required />
                <x-form.input name="price" type="number" :value="old('price', 500)" required />
                <x-form.input name="min tenancy" required :value="old('min_tenancy', '6 months')" />
            </div>

            <div class="flex justify-between">
                <input type="hidden" name="furnished" value="0">
                <x-form.input 
                    name="furnished" 
                    type="checkbox"
                    value="1"
                />

                <input type="hidden" name="garden" value="0">
                <x-form.input 
                    value="1"
                    name="garden" 
                    type="checkbox"
                />

                <input type="hidden" name="parking" value="0">
                <x-form.input 
                    value="1"
                    name="parking" 
                    type="checkbox"
                />

                <x-form.input name="bedrooms" type="number" :value="old('bedrooms', 1)" required />
                <x-form.input name="bathrooms" type="number" :value="old('bathrooms', 1)" required />
            </div>

            <x-form.textarea name="body" rows="15">{{ old('body', '') }}</x-form.textarea>

            <x-form.button>Submit</x-form.button>


        </form>
    </x-admin.layout>
</x-layout>