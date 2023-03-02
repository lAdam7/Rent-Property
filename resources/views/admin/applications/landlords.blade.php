<x-layout>
    <x-admin.layout heading="Landlord Applications">
        @if($applications->count())
            <div class="flex flex-col">
            <div class ="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($applications as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $application->user->forename . ' ' . $application->user->surname }}
                                                </div>
                                            </div>
                                        </td>                                

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Pending
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a class="text-xs text-blue-400" href="/admin/applications/landlords/edit/{{ $application->id }}">View</a>
                                        </td>

                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/applications/landlords/{{ $application->id }}">
                                                @csrf

                                                <button class="text-xs text-blue-400">Accept</button>
                                            </form>
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/admin/applications/landlords/{{ $application->id }}">
                                                @csrf
                                                @method('delete')

                                                <button class="text-xs text-red-400">Reject</button>
                                            </form>
                                        </td>      --}}

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-gray-400">
                                                    {{ $application->created_at->diffForHumans() }}
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
            <p>There are currently no landlord applications</p>
        @endif
    </x-admin.layout>
</x-layout>