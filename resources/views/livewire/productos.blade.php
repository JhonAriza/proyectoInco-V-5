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
                {{-- @livewire('create-producto') --}}
                <x-jet-danger-button wire:click="save{{$nombreProducto}}">
                    crear nueva producto
                </x-jet-danger-button>
            </div>
            @if ($productos->count())
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class=" w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click='order("id")'>
                                id
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
                                wire:click='order("nombreProducto")'>
                                nombreProducto
                                {{-- sort --}}
                                @if ($sort == 'nombreProducto')
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
                                wire:click='order("cantidad")'>
                                cantidad
                                {{-- sort --}}
                                @if ($sort == 'cantidad')
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
                                wire:click='order("nombre")'>
                                nombre del hp proveedopr
                                {{-- sort --}}
                                @if ($sort == 'nombre')
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
                            wire:click='order(" nombreMarca")'>
                            nombreMarca
                            {{-- sort --}}
                            @if ($sort == 'nombreMarca')
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
                        @foreach ($productos as $item)
                            <tr> 
                                <td class=" ml-2 px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                    
                                </td>
                                <td class="px-6 py-4 w-full">
                                    <div class="text-sm text-gray-900"> {{ $item->nombreProducto}}</div>
                                </td>
                                <td class=" ml-2 px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->cantidad }}</div>
                                </td>

                                <td class="px-6 py-4 w-full">
                                    @if ($item->id_proveedors == null)
                                        N/A
                                    @else
                                        <div class="text-sm text-gray-900">
                                            {{ $item->proveedor->nombre}}
                                        </div>
                                    @endif
                                </td>


                                <td class="px-6 py-4 w-full">
                                    @if ($item->id_marcas == null)
                                        N/A
                                    @else
                                        <div class="text-sm text-gray-900">
                                            {{ $item->marca->nombreMarca }}
                                        </div>
                                    @endif
                                </td>




                                <td class="ext-sm font-medium flex">
                                    {{-- @livewire('edit-producto', ['producto' => $producto], key($producto->id)) --}}
                                    <button type="button" class="btn btn-success btn-sm py-1 px-2"
                                        wire:click="edit({{ $item }})">edit</button>
                                    <!--boton eliminar -->
                                    <button type="button" class="btn btn-danger btn-sm ml-2"
                                        wire:click="$emit('deleteProducto', {{ $item->id }})">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No existe ningun registro considente de productos
                </div>
            @endif

            @if ($productos->hasPages())
                <div class="px-6 py-3">
                    {{ $productos->links() }}
                </div>
            @else
            @endif

        </x-table>
    </div>


    <!-- donde se crear -->
    <x-jet-dialog-modal wire:model="open_save">
    
        <x-slot name='title'>
            Crear un nuevo producto <br>La cantidad de los productos será tomada por la unidad del mismo
        </x-slot>

        <x-slot name='content'>
            <div class='mb4'>
                <x-jet-label value='titulo de la producto' />
                <x-jet-input type="text" class='w-full' wire:model='nombreProducto' />
                <x-jet-input-error for='nombreProducto' />
            </div>

            <div class='mb4'>
                <x-jet-label value='cantidad' />
                <x-jet-input type="text" class='w-full' wire:model='cantidad' />
                <x-jet-input-error for='cantidad' />
            </div>

  <!-- SE CREA SELECT PARA LA LLAVE FORANEA de Proveeedor -->
  <div class='mb4'>
    <x-jet-label value="Selelecionar Proveedor" />
    <select class="form-control" wire:model="SelectProveedor">
        <option value="">Selelecionar Proveedor</option>
        @foreach ($proveedor as $item)
            <option value="{{ $item->id }}">
                {{ $item->nombre}}
            </option>
        @endforeach
    </select>
</div>

  <!-- SE CREA SELECT PARA LA LLAVE FORANEA -->
  <div class='mb4'>
    <x-jet-label value="Selelecionar Marca" />
    <select class="form-control" wire:model="SelectMarca">
        <option value="">Selelecionar Marca</option>
        @foreach ($marca as $item)
            <option value="{{ $item->id }}">
                {{ $item->nombreMarca}}
            </option>
        @endforeach
    </select>
</div>



        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_save',false)">
                cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="create" wire:loading.remove wire:target='create'>
                crear Producto
            </x-jet-danger-button>
            <samp wire:loading wire:target='create'>Cargando ...</samp>
        </x-slot>

    </x-jet-dialog-modal>


    <!-- donde se edita -->
    <x-jet-dialog-modal wire:model='open_edit'>

        <x-slot name='title'>
            Editar del  producto
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Titulo del producto" />
                <x-jet-input wire:model="nombreProducto" type="text" class="w-full" />
            </div>

            <div class="mb-4">
                <x-jet-label value="cantidad" />
                <x-jet-input wire:model="cantidad" type="text" class="w-full" />
            </div>

            <!-- se crea  el modal parta editar la categoria -->
            <div class='mb4'>
                <x-jet-label value="Selelecionar Proveedor" />
                <select class="form-control" wire:model="SelectProveedor">
                    <option value="">Selelecionar Proveedor</option>
                    @foreach ($proveedor as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nombre}}
                        </option>
                    @endforeach
                </select>
            </div>
<!-- se crea  el modal para editar la categoria -->
            <div class='mb4'>
                <x-jet-label value="Selelecionar Marca" />
                <select class="form-control" wire:model="SelectMarca">
                    <option value="">Selelecionar Marca</option>
                    @foreach ($marca as $item)
                        <option value="{{ $item->id}}">
                            {{ $item->nombreMarca}}
                        </option>
                    @endforeach
                </select>
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
            livewire.on('deleteProducto', productoid => {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'advertencia',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, bórrarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        livewire.emitTo('productos', 'delete', productoid)
                        Swal.fire(
                            'Eliminado!',
                            'El producucto ha sido eliminado.',
                            'exitosamente'
                        )
                    }
                })
            });
        </script>
    @endpush



</div>
