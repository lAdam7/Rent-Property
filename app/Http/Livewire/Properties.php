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


    public function mount(){
        $this->sort_by = 'created_at.DESC'; 
        $this->searchTerm = "";
     }

    public function updatingSearchTerm()
    {
        dd('asd');
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

    private function splitSort($str)
    {
        return (explode('.', $str ));
    }

    public function render()
    {   
        $split = $this->splitSort($this->sort_by);

        $properties = Property::orderBy($split[0], $split[1])
            ->filter(['search' => $this->searchTerm])
            ->paginate(10)
            ->withQueryString();


        return view('livewire.properties', [
            'properties' => $properties,
            'types' => PropertyType::all(),
            'typesSelected' => $this->typesSelected
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
            