<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Register</h1>
                <form method="POST" action="/register" style="mt-10">
                    @csrf

                    <x-form.input name="email" type="email" required autocomplete="email" />
                    <div class="flex justify-between">
                        <x-form.input name="forename" required autocomplete="given-name" />
                        <x-form.input name="surname" required autocomplete="family-name" />
                    </div>
                    <x-form.input name="password" type="password" required autocomplete="new-password" />
                    <x-form.input name="password_confirmation" type="password" required autocomplete="new-password" />
                
                    <div class="mb-6 text-center">
                        <x-form.button>Register</x-form.button>
                    </div>

            </form>
            </x-panel>
        </main>
    </section>
</x-layout>