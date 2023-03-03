@props(['property'])

<section x-data="{ show: false }">
    <div class="relative mx-auto max-w-screen-xl px-4 py-8">
      <div>
        <h1 class="text-2xl font-bold lg:text-3xl">{{ $property->street }}, {{ $property->town_or_city }}</h1>
  
        <p class="mt-1 text-sm text-gray-500">Last Updated: {{ $property->updated_at->diffForHumans() }}</p>
      </div>
  
      <div class="grid gap-8 lg:grid-cols-4 lg:items-start" style="width: 100%">
        <div x-data="{imageUrl: '{{ asset('images/thumbnails/' . $property->images[0]->thumbnail) }}'}" class="lg:col-span-3">
          <div class="relative mt-4">
            <img
              alt="Main image"
              width="100%"
              style="max-height: 500px; height: auto"
              :src="imageUrl"
              {{-- src='/images/bedroom.jpg' --}}
              class="rounded-xl object-cover"
            />
          </div>
          
          @if(count($property->images) > 1)
            <div>
              <div class="mt-1 flex flex-nowrap gap-1 overflow-scroll overflow-y-hidden">
                
                @foreach ($property->images as $image)
                  <img
                    @click="imageUrl='{{ asset('images/thumbnails/' . $image->thumbnail) }}'"
                    alt="Side image"
                    src="{{ asset('images/thumbnails/' . $image->thumbnail) }}"
                    class="rounded-md object-cover"
                    style="max-height: 100px; height: auto; width: auto;"
                  />
                @endforeach
              
              </div>
            </div>
          @endif



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
              @click="show=true"
            >
                Contact Landlord
            </button>
        </div>

  
        <div class="lg:col-span-3">
            <p>
              <strong>Property Type:</strong> {{ ucwords($property->type->name) }}
            </p>
            <p>
              <strong>Availability:</strong> {{ Carbon\Carbon::parse($property->available)->isPast() ? 'Available now' : Carbon\Carbon::parse($property->available)->format('d/m/Y'); }}
            </p>

          <div class="prose max-w-none">
            <p>
              {{ $property->body }}
            </p>
          </div>
        </div>
      </div>
    </div>


    <div 
    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-4 px-20  rounded-xl"
    @click.away="show=false"
    x-show="show"
  >
    <h2 class="border-b text-2xl"><strong>Landlord Contact Details</strong></h2>
    <br>
    <p><strong>Tel:</strong> {{ $property->landlord->contact_number }}</p>
    <p><strong>Email:</strong> {{ $property->landlord->contact_email }}</p>
    <br>
    <button
      type="submit"
      class="w-full rounded bg-red-700 px-6 py-3 text-sm font-bold uppercase tracking-wide text-white"
      @click="show=false"
    >
        Close
    </button>
  </div>

  </section>
  