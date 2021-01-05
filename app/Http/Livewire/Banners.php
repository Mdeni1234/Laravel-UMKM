<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Livewire\Component;

class Banners extends Component
{
    use WithFileUploads;
    use WithPagination;
    public  $product_id, $banner, $banner_img, $isBanner, $old_banner;
    public $isModal = 0;
    public function render()
    {
        return view('livewire.banners', [
            'products' => Product::where('banner_img', '!=', null)->latest()->paginate(5),
        ]);
    }
    public function create()
    {
        return redirect()->route('product');
    }

    public function closeBanner()
    {
        $this->isBanner = false;
    }
    public function resetInputFields() {
        $this->banner = 0;
        $this->banner_img = null;
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->banner_img);
        Product::updateOrCreate(['id' => $id],
        [
            'banner_img' => null,
            'banner_status' => 0,

        ]);
        session()->flash('message', 'Banner Deleted Successfully.');
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
        ]);
        
        session()->flash('message', 
            $this->product_id ? 'Banner Updated Successfully.' : 'Banner Created Successfully.');
  
        $this->closeModal();
        $this->isBanner = false;
        $this->resetInputFields();
    }

    public function Banner($id, $status) {
        $count = Product::where('highlight', '=', 1)->count();
        if($count <= 1) {
            if($status) {
                $this->banner_status = 0;
                error_log($status);
            } else {
                error_log("oke");
                $this->banner_status = 1;
            }
            Product::updateOrCreate(['id' => $id],
            [
                'banner' => $this->banner_status,
            ]);
            session()->flash('message', 'Status Updated');
        } else {
            session()->flash('error', 'Max 5');
        }
        
        
    }
}
