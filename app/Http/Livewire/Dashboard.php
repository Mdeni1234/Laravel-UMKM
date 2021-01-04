<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Banner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;



class Dashboard extends Component
{
    use WithFileUploads;
    public $products, $product_id, $title, $desc, $category, $image, $banner, $edit, $profile, $old_profile, $old_banner, $isBanner, $highlight;
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
    public function closeBanner()
    {
        $this->isBanner = false;
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
        ]);
            if($this->image) {
                $this->profile = $this->image->store('image', 'public');
            } else {
                if($this->old_profile)  {
                    $this->profile = $this->old_profile;
                } else {
                    $this->validate([
                        'image' => 'required',
                    ]);
                }
            }
        Product::updateOrCreate(['id' => $this->product_id],
        [
            'title' => $this->title,
            'description' => $this->desc,
            'category' => $this->category,
            'profile_img' => $this->profile,
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
        $this->product_id = $product->id;
        $this->title = $product->title;
        $this->desc = $product->description;
        $this->category = $product->category;
        $this->old_profile = $product->profile_img;
        $this->old_banner = $product->banner;
        $this->image = null;
        $this->banner = null;
        $this->openModal();
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->profile_img);
        Product::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

    public function createBanner($id) {
        $this->resetInputFields();
        $this->product_id = $id;
        $this->isBanner = true;
    }

    public function storeBanner()
    {
        $this->validate([
            'banner' => 'required',
        ]);
        Product::updateOrCreate(['id' => $this->product_id],
        [
            'banner_img' => $this->banner->store('image', 'public'),
            'banner' => 1,
        ]);
        
        session()->flash('message', 
            $this->product_id ? 'Banner Updated Successfully.' : 'Banner Created Successfully.');
  
        $this->closeModal();
        $this->isBanner = false;
        $this->resetInputFields();
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
