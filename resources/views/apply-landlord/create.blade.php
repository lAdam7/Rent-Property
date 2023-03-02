<x-layout>

    {{-- @php
        dd(is_null(auth()->user()->landlord_application()));
    @endphp --}}

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Apply to be a Landlord</h1>
                <p class="text-center text-sm text-gray-500 mb-5">These contact details will be given to interested potential tenants!</p>
                
                <form method="POST" action="/apply" style="mt-10">
                    @csrf
                    
                    <x-form.input name="contact email" type="email" value="{{ auth()->user()->email }}"/>
                    <x-form.input name="contact number" type="tel" pattern="^\d{11}$" required />
                    <x-form.textarea name="notes" />

                    <div class="mb-6 text-center">
                        <x-form.button>Submit</x-form.button>
                    </div>
                </form>
            </x-panel>
        </main>
    </section>

</x-layout>