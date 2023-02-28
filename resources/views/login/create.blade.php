<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Login</h1>

                <form method="POST" action="/login" style="mt-10">
                    @csrf
                
                    <x-form.input name="email" type="email" autocomplete="username"/>
                    <x-form.input name="password" type="password" autocomplete="password"/>

                    <div class="mb-6 text-center">
                        <x-form.button>Login</x-form.button>
                    </div>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>