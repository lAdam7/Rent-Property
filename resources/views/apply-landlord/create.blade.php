<x-layout>

    {{-- @php
        dd(is_null(auth()->user()->landlord_application()));
    @endphp --}}

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Apply to be a Landlord</h1>
                
                <form method="POST" action="/apply" style="mt-10">
                    @csrf
                
                    <x-form.textarea name="notes" />

                    <div class="mb-6 text-center">
                        <x-form.button>Submit</x-form.button>
                    </div>
                </form>
            </x-panel>
        </main>
    </section>

</x-layout>