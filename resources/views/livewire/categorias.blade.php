

<div>

  
    <div class='max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8 py-12'>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <x-table>
          
            <div class="px-6 py-4 flex items-center">
                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cant" class="mx-2">
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                    </select>
                    <samp>Entradas</samp>
                </div>
                <x-jet-input class="flex-1 mx-4" placeholder="Escriba que quiere buscar" type="text"
                    wire:model='search' />
                {{-- @livewire('create-horario') --}}

                
                            <!--se agrega para crear etiquetasssssssss alos nproductos -->
                            
                            id 
                <x-jet-danger-button wire:click="modal">
                    crear nueva categoria
                </x-jet-danger-button>
            </div>
          

            
            @if ($categorias->count())
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class=" w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click='order("id")'>
                             
                                {{-- sort --}}
                                @if ($sort == 'id')
                                
                                    @if ($direction == 'asc')
                                        <i class='fas fa-sort-alpha-up-alt float-right mt-1'></i>
                                    @else
                                        <i class='fas fa-sort-alpha-down-alt float-right mt-1'></i>
                                    @endif
                                @else
                                    <i class='fas fa-sort float-right mt-1'></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click='order("nombreCategoria")'>

                                

                                Categoria
                                {{-- sort --}}
                                @if ($sort == 'nombreCategoria')
                                
                                    @if ($direction == 'asc')
                                        <i class='fas fa-sort-alpha-up-alt float-right mt-1'></i>
                                    @else
                                        <i class='fas fa-sort-alpha-down-alt float-right mt-1'></i>
                                    @endif
                                @else
                                    <i class='fas fa-sort float-right mt-1'></i>
                                @endif
                            </th>
                            <th scope="col">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categorias as $item)  
                            <tr>
                                <td class=" ml-2 px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->id }} </div>
                                </td>
                                <td class="px-6 py-4 w-full">
                                    <div class="text-sm text-gray-900">{{ $item->nombreCategoria }}</div>
                                </td>
                                <td class="ext-sm font-medium flex">
                                    {{-- @livewire('edit-categoria', ['categoria' => $categoria], key($categoria->id)) --}}
                                    <button type="button" class="btn btn-success btn-sm py-1 px-2"
                                        wire:click="edit({{ $item->id }})">edit</button>
                                    <!--boton eliminar -->
                                    <button type="button" class="btn btn-danger btn-sm ml-2"
                                        wire:click="$emit('deleteCategoria', {{ $item->id  }})">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No existe ningun registro considente
                </div>
            @endif

            @if ($categorias->hasPages())
                <div class="px-6 py-3">
                    {{ $Categorias->links() }}
                </div>

            @else

            @endif

        </x-table>
    </div>


    <!-- donde se crear -->
    <x-jet-dialog-modal wire:model="open_save">
         <x-slot name='title'>
            crear una nueva Categoria
        </x-slot>

        <x-slot name='content'>
            <div class='mb4'>
                {{$nombreCategoria}}
                <x-jet-label value='titulo de la categoria' />
                <x-jet-input type="text" class='w-full' wire:model='nombreCategoria' />
                <x-jet-input-error for='nombreCategoria' />
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_save',false)">
                cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="create" wire:loading.remove wire:target='create'>
                crear Categoria
            </x-jet-danger-button>
            <samp wire:loading wire:target='create'>Cargando ...</samp>
        </x-slot>

    </x-jet-dialog-modal>


    <!-- donde se edita -->
    <x-jet-dialog-modal wire:model='open_edit'>

        <x-slot name='title'>
            Editar La Categoria
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label class="items-center gap-4  font-light px-4 py-3 rounded-lg bg-gradient-to-tr from-light-blue-500 to-light-blue-700 text-white shadow-md hover:bg-light-blue-700 hover:shadow-lg-light-blue" value="Titulo de la Categoria" />
                <x-jet-input wire:model="categoria.nombreCategoria" type="text" class="w-full" />
                @livewire('shared.tags', ['categoria_id' => $categoria_id])
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click='update' wire:loading.attr='disabled' class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>


    <!-- mensaje de eliminar -->
    @push('js')
        <script src="sweetalert2.all.min.js"></script>

        <script>
            livewire.on('deleteCategoria', categoriaid => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'advertencia',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, bórralo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emitTo('categorias', 'delete', categoriaid)
                        Swal.fire(
                            'Eliminado!',
                            'Su archivo ha sido eliminado.',
                            'exitosamente'
                        )
                    }
                })
            });
        </script>
    @endpush



</div>
<style>

.shadow.overflow-hidden.border-b.border-gray-200.sm\:rounded-lg {
    background-color: rgb(153, 5, 153);
}
</style>