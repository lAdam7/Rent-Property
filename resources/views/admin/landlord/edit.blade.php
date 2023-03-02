<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl border-b">User Details</h1>
                <p><strong>Name:</strong> {{ $landlord->user->forename }} {{ $landlord->user->surname }}</p>
                <p><strong>Registered Email:</strong> {{ $landlord->user->email }}</p>
                <p class="mb-3"><strong>Created Account:</strong> {{ $landlord->user->created_at->diffForHumans() }}</p>

                <h1 class="text-center font-bold text-xl border-b">Landlord Application</h1>
                <p><strong>Contact Email:</strong> {{ $landlord->contact_email }}</p>
                <p><strong>Contact Number:</strong> {{ $landlord->contact_number }}</p>
                <p><strong>Application Submitted:</strong> {{ $landlord->created_at->diffForHumans() }}</p>
                <br>
                <p><strong>Application Notes:</strong> {{ $landlord->notes }}</p>

                <div class="flex space-x-6 justify-center pt-5">
                    <form method="POST" action="/admin/applications/landlords/{{ $landlord->id }}">
                        @csrf
                        @method('patch')
                
                        <button class="border-2 border-green-400 px-4 py-1 rounded-lg text-green-400"><strong>Approve</strong></button>
                    </form> 
                    <a
                        class="border-2 border-gray-400 px-4 py-1 rounded-lg text-gray-400" 
                        href="/admin/applications/landlords"
                    >
                        <strong>Back</strong>
                    </a>
                    <form method="POST" action="/admin/applications/landlords/{{ $landlord->id }}">
                        @csrf
                        @method('delete')
                
                        <button class="border-2 border-red-400 px-4 py-1 rounded-lg text-red-400"><strong>Reject</strong></button>
                    </form>
                </div>
            </x-panel>
        </main>
    </section>
</x-layout>