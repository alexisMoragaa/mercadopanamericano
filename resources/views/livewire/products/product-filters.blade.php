<div class="flex flex-col md:flex-row md:justify-end md:items-center gap-4 mb-4 mt-4">

  <x-text-input type="text" wire:model.live.debounce.250ms="productName" placeholder="Buscar por nombre…" class="input" />
  
  <select wire:model.change="categoryId" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    <option value="">Todas las categorías</option>
    @foreach($categories as $id => $label)
      <option value="{{ $id }}">{{ $label }}</option>
    @endforeach
  </select>

</div>