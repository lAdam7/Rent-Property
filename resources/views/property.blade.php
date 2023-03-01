<x-layout>
    @if(!$property->approved)
        <div class="flex justify-center m-4">
            <div class="bg-blue-500 p-2 text-white rounded-xl">
                <p class="text-xl"><strong>This property is not currently listed</strong></p>
                <p class="text-sm">To make this property listed you need to wait for an admin to approve the property information that has been set, it will then appear in searches</p>
            </div>
        </div>
    @else
        <x-view-property :property="$property" />
    @endif
</x-layout>