@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-6 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            
            <ul>
                @if (request()->is('admin*'))
                    <li>
                        <a href="/admin/applications/landlords" class="{{ request()->routeIs('applications/landlords') ? 'text-blue-500' : '' }}">Landlord Applications</a>
                    </li>

                    <li>
                        <a href="/admin/applications/properties" class="{{ request()->routeIs('applications/properties') ? 'text-blue-500' : '' }}">Property Applications</a>
                    </li>
                @else
                    <li>
                        <a href="properties" class="{{ request()->is('dashboard/properties') ? 'text-blue-500' : '' }}">Manage Properties</a>
                    </li>
                    <li>
                        <a href="add" class="{{ request()->is('dashboard/add') ? 'text-blue-500' : '' }}">Add Property</a>
                    </li>
                @endif
            </ul>
        </aside>
        
        <main class="flex-1">
            <div {{ $attributes(['class' => "border border-gray-200 p-6 rounded-lg"]) }}>
                {{ $slot }}
            </div>
        </main>
    </div>
</section>