<div>
    <h1>welcome in livewire </h1>
     <h3> {{ $num }}  </h3>
    <button wire:click='add'>+</button>
    <button wire:click='sub'>-</button>
    <hr>

<input type="text" wire:model.live="name">

{{$name}}
</div>
