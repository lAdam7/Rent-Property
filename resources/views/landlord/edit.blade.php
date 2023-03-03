<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-4xl mx-auto mt-10">
            <x-panel>
                <form method="POST" action="/dashboard/properties/edit/{{ $property->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
        
                    <x-form.input name="name" :value="old('name', $property->name)" required />
                    <x-form.input name="street" :value="old('street', $property->street)" required />
                    <x-form.input name="town or city" :value="old('town_or_city', $property->town_or_city)" required />
                    
                    <div class="flex justify-between">  
                        <x-form.input name="available" type="date" value="{{ date('Y-m-d') }}" required />

                        <x-form.field>  
                            <x-form.label name="type" />
        
                            <select name="property_type_id" id="property_type_id">
        
        
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('property_type_id', $property->property_type_id) == $type->id ? 'selected' : '' }}>{{ ucwords($type->name) }}</option>
                                @endforeach
                            </select>
        
                            <x-form.error name="type" />
                        </x-form.field>
                    </div>
                    <div class="flex justify-between">
                        <x-form.input name="deposit" type="number" :value="old('deposit', $property->deposit)" required />
                        <x-form.input name="price" type="number" :value="old('price', $property->price)" required />
                        <x-form.input name="min tenancy" :value="old('min_tenancy', $property->min_tenancy)" required />
                    </div>

                    <div class="flex justify-between">
                        <input type="hidden" name="furnished" value="0">
                        <x-form.input 
                            id="furnished"
                            name="furnished" 
                            type="checkbox"
                            value="1"
                            x-init="({{ $property->furnished }}) ? document.getElementById('furnished').setAttribute('checked','checked') : null"
                        />

                        <input type="hidden" name="garden" value="0">
                        <x-form.input 
                            id="garden"
                            name="garden" 
                            type="checkbox"
                            value="1"
                            x-init="({{ $property->garden }}) ? document.getElementById('garden').setAttribute('checked','checked') : null"
                        />

                        <input type="hidden" name="parking" value="0">
                        <x-form.input 
                            id="parking"
                            name="parking" 
                            type="checkbox"
                            value="1"
                            x-init="({{ $property->parking }}) ? document.getElementById('parking').setAttribute('checked','checked') : null"
                        />

                        <x-form.input name="bedrooms" type="number" :value="old('bedrooms', $property->bedrooms)" required />
                        <x-form.input name="bathrooms" type="number" :value="old('bathrooms', $property->bathrooms)" required />
                    </div>

                    <x-form.textarea name="body">{{ old('body', $property->body) }}</x-form.textarea>
        
        
                    <x-form.button>Update</x-form.button>
        
        
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
{{-- dashboard/properties/edit/{property} --}}