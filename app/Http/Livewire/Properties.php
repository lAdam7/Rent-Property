<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Property;
use App\Models\PropertyType;

class Properties extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sort_by;


    public function mount(){
        $this->sort_by = 'created_at.DESC'; 
        $this->searchTerm = "";
     }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    private function splitSort($str)
    {
        return (explode('.', $str ));
    }

    public function render()
    {   
        
        // $properties = Property::orderBy("town_or_city", 'ASC');

        // $properties->(function ($q) {
        //     if (!empty($this->searchTerm)) {
        //         $properties = $properties->orWhere('town_or_city', 'like', '%' . $this->searchTerm . '%');
        //     }
        // });

        
        // //$properties = $properties->orWhere('property_type_id', $this->property_type);

        // $properties = $properties->paginate(10);
        $split = $this->splitSort($this->sort_by);

        $properties = Property::orderBy($split[0], $split[1])
            ->when($this->searchTerm, function($builder) {
                return $builder->where('town_or_city', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('street', 'like', '%' . $this->searchTerm . '%');
            })
            //->where('property_type_id', $this->property_type)
            ->paginate(10);


// Order::where('user_id', '=', auth()->id())
//     ->when($this->filter, function ($builder) {
//         $builder->where('status', $this->filter);
//     })
//     ->when($this->search, function ($builder) {
//         $builder->where(function ($builder) {
//             $builder->where('shipping_name', 'like', '%' . $this->search . '%')
//                 ->orWhere('order_no', 'like', '%' . $this->search . '%');
//         });
//     })
//     ->orderBy($this->sortColumn,$this->sortDirection)
//     ->paginate(10);


        return view('livewire.properties', [
            'properties' => $properties,
            'types' => PropertyType::all()
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
            