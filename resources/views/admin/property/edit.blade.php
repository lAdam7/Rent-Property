<x-layout>
    <div class="flex space-x-6 justify-center pt-5">
        <form method="POST" action="/admin/applications/properties/{{ $property->id }}">
            @csrf
            @method('patch')
    
            <button class="border-2 border-green-400 px-4 py-1 rounded-lg text-green-400"><strong>Approve</strong></button>
        </form> 
        <a
            class="border-2 border-gray-400 px-4 py-1 rounded-lg text-gray-400" 
            href="/admin/applications/properties"
        >
            <strong>Back</strong>
        </a>
        <form method="POST" action="/admin/applications/properties/{{ $property->id }}">
            @csrf
            @method('delete')
    
            <button class="border-2 border-red-400 px-4 py-1 rounded-lg text-red-400"><strong>Reject</strong></button>
        </form>
    </div>

    <x-view-property :property="$property" />
</x-layout>