<?php

namespace App\Livewire\Category;

use App\Models\category;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    public $category_name;
    public $category_id;
    public $search;
    use WithPagination;

    public function create()
    {
        $data = $this->validate([
            'category_name' => 'required'
        ]);

        Category::create($data);
        session()->flash('success', 'Category has been created successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        $this->category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->dispatch('show-edit-category-modal');
    }

    public function update()
    {
        $data = $this->validate([
            'category_name' => 'required'
        ]);

        category::where('id', $this->category_id)->update($data);
        session()->flash('message', 'Category has been updated successfully');
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        category::find($id)->delete();
    }

    public function resetInput()
    {
        $this->reset('category_name');
    }

    public function render()
    {
        return view('livewire.category.table', [
            'categories' => Category::latest()->where('category_name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
