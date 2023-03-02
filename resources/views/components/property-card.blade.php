@props(['property'])

<a style="text-decoration-line: none; color: rgba(0,0,0, 1)" href="/property/{{ $property->id }}">
    <article
    x-data=""
    class="my-5 transition-colors duration-300 hover:bg-gray-100 border rounded-xl"
    style="border-color: rgb(229 231 235)"
>
<div 
    class="py-2 px-5 pb-3"
>
    <div class="flex justify-between flex-wrap">
        <h1 class="text-xl">
            <strong>{{ $property->street }}, {{ $property->town_or_city }}</strong>
        </h1>

        <span class="mt-2 block text-gray-400 text-xs">
                Added <time>{{ $property->created_at->diffForHumans() }}</time>
        </span>
    </div>

    <div class="flex">
        
        <img class="w-80 object-contain" src="/images/bedroom.jpg" alt="Blog Post illustration">
       

        <div class="px-3 basis-1/2 flex flex-col space-y-2">

            <div class="flex flex-wrap space-x-7 border-b">
                <p><strong>{{ ucwords($property->type->name) }}</strong></p>
                <div class="flex">
                    <x-bed />
                    
                    <p class="pl-1"><strong>4</strong></p>
                </div>
                <div class="flex">
                    <x-bath />
                    
                    <p class="pl-1"><strong>4</strong></p>
                </div>
            </div>
            
            <p class="flex-1">{{ strlen($property->body) > 300 ? substr($property->body,0,300)."..." : $property->body }}</p>

            <div class="flex justify-between">
                <p class="text-sm"><strong>Deposit: £{{ $property->deposit }}</strong></p>
                <p class="text-sm"><strong>£{{ $property->price }} pcm</strong></p>
            </div>
        </div>
        
    </div>

</div>
</article>
</a>