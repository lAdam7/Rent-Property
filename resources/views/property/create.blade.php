<x-layout>
    <x-admin.layout heading="Add Property">
        <form method="POST" action="add">
            @csrf

            <x-form.input name="name" required />
            <x-form.input name="street" required />
            <x-form.input name="town or city" required />
            <x-form.input name="available" type="date" value="{{ date('Y-m-d') }}" required />
            <div class="flex justify-between">
                <x-form.input name="deposit" type="number" value=0 required />
                <x-form.input name="price" type="number" value=0 required />
                
                <x-form.field>
                    <x-form.label name="frequency" />

                    <select name="property_frequency_id" id="property_frequency_id">


                        @foreach ($frequencies as $frequency)
                            <option value="{{ $frequency->id }}" {{ old('property_frequency_id') == $frequency->id ? 'selected' : '' }}>{{ ucwords($frequency->name) }}</option>
                        @endforeach
                    </select>

                    <x-form.error name="frequency" />
                </x-form.field>
            </div>

            <div class="flex justify-between">
                <x-form.input name="min tenancy" />

                <x-form.field>
                    <x-form.label name="type" />

                    <select name="property_type_id" id="property_type_id">


                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('property_type_id') == $frequency->id ? 'selected' : '' }}>{{ ucwords($type->name) }}</option>
                        @endforeach
                    </select>

                    <x-form.error name="type" />
                </x-form.field>
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

                <x-form.input name="bedrooms" type="number" value=2 required />
                <x-form.input name="bathrooms" type="number" value=2 required />
            </div>

            <x-form.textarea name="body" />

            <x-form.button>Submit</x-form.button>


        </form>
    </x-admin.layout>
</x-layout>