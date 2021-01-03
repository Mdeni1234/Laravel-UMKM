<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;


class Dashboard extends Component
{
    use WithFileUploads;
    public $products, $product_id, $title, $desc, $category, $image, $banner, $edit;
    public $isModal = 0;
    public function render()
    {
        $this->products = Product::orderBy('created_at', 'DESC')->get();
        return view('livewire.dashboard');
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
        $this->title = '';
        $this->desc = '';
        $this->image = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'desc' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);
   
        Product::updateOrCreate(
        [
            'title' => $this->title,
            'description' => $this->desc,
            'category' => $this->category,
            'profile_img' => $this->image->store('image', 'public'),
            'highlight' => false,
            'banner' => false
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
        $edit = true;
        $product = Product::findOrFail($id);
        $this->title = $product->title;
        $this->desc = $product->description;
        $this->image = $product->profile_img;
        $this->banner = $product->banner;

    
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
