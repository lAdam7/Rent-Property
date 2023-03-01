@props(['property'])

<section>
    <div class="relative mx-auto max-w-screen-xl px-4 py-8">
      <div>
        <h1 class="text-2xl font-bold lg:text-3xl">{{ $property->street }}, {{ $property->town_or_city }}</h1>
  
        <p class="mt-1 text-sm text-gray-500">Last Updated: {{ $property->updated_at->diffForHumans() }}</p>
      </div>
  
      <div class="grid gap-8 lg:grid-cols-4 lg:items-start">
        <div class="lg:col-span-3">
          <div class="relative mt-4">
            <img
              alt="Tee"
              src="/images/bedroom.jpg"
              class="h-90 w-full rounded-xl object-cover"
            />
          </div>
          
          <div>
            <div class="mt-1 flex flex-nowrap gap-1 overflow-scroll overflow-y-hidden">
            
              <img
                alt="Tee"
                src="/images/bedroom.jpg"
                class="h-24 w-full rounded-md object-cover"
              />
            
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
           
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
          
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            
                <img
                  alt="Tee"
                  src="/images/bedroom.jpg"
                  class="h-24 w-full rounded-md object-cover"
                />
            

  
            </div>
          </div>
        </div>

        <div class="mt-4">
            <p class="border-b"><strong>This property comes with...</strong></p>
            <p class="px-5 py-1">
                • {{ $property->bedrooms }} Bedrooms
            </p>
            <p class="px-5 py-1">
                • {{ $property->bathrooms }} Bathrooms
            </p>
            @if($property->furnished)
                <p class="px-5 py-1">
                    • Furnished
                </p>
            @endif
            @if($property->parking)
                <p class="px-5 py-1">
                    • Parking
                </p>
            @endif
            @if($property->garden)
                <p class="px-5 py-1">
                    • Garden
                </p>
            @endif

            <button
              type="submit"
              class="mt-5 w-full rounded bg-red-700 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white"
            >
                Contact Landlord
            </button>
        </div>

  
        <div class="lg:col-span-3">
          <div class="prose max-w-none">
            <p>
              {{ $property->body }}
          </div>
        </div>
      </div>
    </div>
  </section>
  