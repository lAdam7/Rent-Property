<x-layout>
    <x-admin.layout heading="Manage Properties">
        @if ($properties->count())
            <div class="flex flex-col">
            <div class ="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($properties as $property)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $property->name }}
                                                </div>
                                            </div>
                                        </td>    

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $property->street }}, {{ $property->towncity }}
                                                </div>
                                            </div>
                                        </td>    

                                        @if($property->approved)
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium text-gray-400">
                                                        £{{ $property->price }} pcm
                                                    </div>
                                                </div>
                                            </td>                          
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-4 inline-flex text-xs leading-6 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Pending
                                                </span>
                                            </td>
                                        @endif
                                        
                                        
                                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a 
                                            class="text-xs text-blue-400"
                                                href="/dashboard/properties/edit/{{ $property->id }}"
                                            >
                                                Edit
                                            </a>
                                        </td>

                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-gray-400">
                                                    {{ $property->updated_at->diffForHumans(null, false, true) }}
                                                </div>
                                            </div>
                                        </td>                                   

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
        @else
            <p>You currently have no properties registered</p>
        @endif
    </x-admin.layout>
</x-layout>