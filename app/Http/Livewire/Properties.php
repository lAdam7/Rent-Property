<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Property;
use App\Models\PropertyType;

class Properties extends Component
{
    use WithPagination;

    public $typesSelected = [];
    public $searchTerm;
    public $sort_by;
    public $furnished;
    public $garden;
    public $parking;


    public function mount(){
        $this->sort_by = 'created_at.DESC'; 
        $this->searchTerm = "";
        $this->furnished = false;
        $this->garden = false;
        $this->parking = false;
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function typePressed($key)
    {   
        $index = array_search($key, $this->typesSelected);

        if ($index === false) {
            array_push($this->typesSelected, $key);
        } else {
            array_splice($this->typesSelected, $index, 1);
        }
    }

    public function flipFurnished()
    {
        $this->furnished = !$this->furnished;
        $this->resetPage();
    }

    public function flipGarden()
    {
        $this->garden = !$this->garden;
        $this->resetPage();
    }

    public function flipParking()
    {
        $this->parking = !$this->parking;
    }

    private function splitSort($str)
    {
        return (explode('.', $str ));
    }

    public function render()
    {   
        $split = $this->splitSort($this->sort_by);

        $properties = Property::orderBy($split[0], $split[1])
            ->filter([
                'search' => $this->searchTerm,
                'property_type' => $this->typesSelected,
                'includes' => [
                    'furnished' => $this->furnished,
                    'garden' => $this->garden,
                    'parking' => $this->parking
                ]
            ])
            ->paginate(15)
            ->withQueryString();


        return view('livewire.properties', [
            'properties' => $properties,
            'types' => PropertyType::all(),
            'typesSelected' => $this->typesSelected,
            'includes' => [
                'furnished' => $this->furnished,
                'garden' => $this->garden,
                'parking' => $this->parking
            ]
        ]);
    }
}

/*
@foreach ($properties as $property)
                <article
                    class="flex justify-center transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"
                >
                    <div class="py-6 px-5">
                        {{ $property->street }}, {{ $property->town_or_city }}
                    </div>
                    <div class="py-6 px-5">
                        |
                    </div>
                    <div class="py-6 px-5">
                        £{{ $property->price }} {{ ucwords($property->frequency->name) }}
                    </div>
                </article>
            @endforeach
        

            {{ $properties->links() }}
            */
            