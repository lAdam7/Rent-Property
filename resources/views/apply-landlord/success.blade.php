<x-layout>
    <div class="text-center">
        <h2 class="text-xl pt-10">Application Status</h2>

        <p class="mt-4 px-8 inline-flex text-2xl leading-10 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{ auth()->user()->landlord->approved ? 'ACCEPTED' : 'PENDING' }}
        </p>

        @if(auth()->user()->landlord->approved)
            <p class="mt-4 text-sm">
                Visit your <a href="/dashboard/properties">property dashboard here</a>
            </p>
        @else
            <p class="mt-4 text-sm">
                Your application is awaiting approval by a site admin
            </p>
        @endif
    </div>
</x-layout>