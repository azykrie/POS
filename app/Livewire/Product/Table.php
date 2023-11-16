<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    public $product_id;
    public $category_id;
    public $product_name;
    public $stock;
    public $price;
    public $search;

    use WithPagination;

    public function create()
    {
        $data = $this->validate([
            'category_id' => 'required',
            'product_name' => 'required|min:3',
            'stock' => 'required',
            'price' => 'required'
        ]);

        Product::create($data);
        session()->flash('success', 'Product has been created successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $this->product_id = $product->id;
        $this->product_name = $product->product_name;
        $this->category_id = $product->category->id;
        $this->stock = $product->stock;
        $this->price = $product->price ;
    
        $this->dispatch('show-edit-product-modal');
    }

    public function update(){
        $data = $this->validate([
            'category_id' => 'required',
            'product_name' => 'required|min:3',
            'stock' => 'required',
            'price' => 'required'
        ]);

        Product::where('id',$this->product_id)->update($data);
        session()->flash('message', 'User has been updated successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function delete($id){
        Product::find($id)->delete();
    }

    public function resetInput()
    {
        $this->reset('category_id', 'product_name', 'stock', 'price');
    }

    public function render()
    {
        return view('livewire.product.table', [
            'categories' => Category::all(),
            'products' => Product::latest()->where('product_name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
