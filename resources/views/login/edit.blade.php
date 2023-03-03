<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Reset Password</h1>

                <form method="POST" action="/password/reset" style="mt-10">
                    @csrf
                    @method('patch')
                
                    <input type="hidden" name="email" type="email" value="{{ $email }}" />
                    <input type="hidden" name="token" value="{{ $token }}" />
                    
                    <x-form.input name="password" type="password" required autocomplete="new-password" />
                    <x-form.input name="password_confirmation" type="password" required autocomplete="new-password" />

                    <div class="text-center">
                        <x-form.button>Reset Password</x-form.button>
                    </div>
                    
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>