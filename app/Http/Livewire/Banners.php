<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use App\Models\Product;
use Livewire\Component;

class Banners extends Component
{
    use WithFileUploads;
    public $products, $product_id, $banner;
    public $isModal = 0;
    public function render()
    {
        $this->products = Product::orderBy('created_at', 'DESC')->get();
        return view('livewire.banners');
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isModal = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isModal = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->product_id = '';
        $this->banner = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'product_id' => 'required',
            'banner' => 'required',

        ]);
   
        Product::updateOrCreate(
        [
            'product_id' => $this->id,
            'banner' => $this->image->store('banners', 'public')
        ]);
        
        session()->flash('message', 
            $this->product_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->title = $product->title;
        $this->desc = $product->desc;
        $this->image = $product->image;

    
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
