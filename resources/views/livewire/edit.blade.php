
<x-slot name='content'>
    <div class="mb-4">
        <x-jet-label value="Titulo del producto" />
        <p>    </p>
          <H2 class="h5"> listado de roles</H2>

      {!! Form::model($user, ['routr'=>['livewire.update',$user], 'method'=>'put']) !!}
        @foreach ($roles as $role )
                    <div>
    <label>
    {!! Form::checkbox($roles[], $roles->id, null, ['class'=>'me-1']) !!}
    {{$role->name}}
    </label>

        </div>

        @endforeach
      {!! Form::close() !!}
    </div>
    <div class="mb-4">
        <x-jet-label value="email" />
        <x-jet-input wire:model="email" type="text" class="w-full" />
    </div>


</x-slot>


    <x-jet-danger-button wire:click='update' wire:loading.attr='disabled' class="disabled:opacity-25">
        Actualizar
    </x-jet-danger-button>
