<x-layout>
    <x-admin.layout heading="Landlord Applications">
        @if($properties->count())
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
                                                    {{ $property->street }}, {{ $property->town_or_city }}
                                                </div>
                                            </div>
                                        </td>                                 

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/applications/properties/{{ $property->id }}">
                                                @csrf
                                                @method('patch')

                                                <button class="text-xs text-blue-400">Accept</button>
                                            </form>
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/applications/properties/{{ $property->id }}">
                                                @csrf
                                                @method('delete')

                                                <button class="text-xs text-red-400">Reject</button>
                                            </form>
                                        </td>     

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-gray-400">
                                                    {{ $property->created_at->diffForHumans() }}
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
            <p>There are currently no property applications</p>
        @endif
    </x-admin.layout>
</x-layout>