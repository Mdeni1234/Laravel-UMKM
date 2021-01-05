<?php

namespace App\Http\Livewire;
use App\Models\Product;
use Livewire\WithPagination;

use Livewire\Component;

class Highlight extends Component
{
    use WithPagination;
    public $highlight;
    public function render()
    {
        return view('livewire.highlight', [
            'products' => Product::where('highlight', '=', true)->latest()->paginate(5),
        ]);
    }
    public function Highlight($id, $status) {
        if($status) {
            $this->highlight = 0;
        } else {
            $this->highlight = 1;
        }
        Product::updateOrCreate(['id' => $id],
        [
            'highlight' => $this->highlight,
        ]);
    }
}
