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
                {{-- @livewire('create-user') --}}
                <x-jet-danger-button wire:click="save{{$name}}">
                    crear nueva users
                </x-jet-danger-button>
            </div>
            @if ($users->count())
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
                                wire:click='order("name")'>
                                name
                                {{-- sort --}}
                                @if ($sort == 'name')
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
                                wire:click='order("email")'>
                                email
                                {{-- sort --}}
                                @if ($sort == 'email')
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
                        @foreach ($users as $item)
                            <tr>
                                <td class=" ml-2 px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                </td>
                                <td class="px-6 py-4 w-full">
                                    <div class="text-sm text-gray-900">{{ $item->name}}</div>
                                </td>
                                <td class=" ml-2 px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->email }}</div>
                                </td>

                                <td class="ext-sm font-medium flex">
                                    {{-- @livewire('edit-user', ['user' => $user], key($user->id)) --}}
                                    <button type="button" class="btn btn-success btn-sm py-1 px-2"
                                        wire:click="edit({{ $item }})">edit</button>
                                    <!--boton eliminar -->
                                    <button type="button" class="btn btn-danger btn-sm ml-2"
                                        wire:click="$emit('deleteUser', {{ $item->id }})">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">
                    No existe ningun registro considente de users
                </div>
            @endif

            @if ($users->hasPages())
                <div class="px-6 py-3">
                    {{ $users->links() }}
                </div>
            @else
            @endif

        </x-table>
    </div>


    <!-- donde se crear -->
    <x-jet-dialog-modal wire:model="open_save">

        <x-slot name='title'>
            crear una nueva users
        </x-slot>

        <x-slot name='content'>
            <div class='mb4'>
                <x-jet-label value='nombre user' />
                <x-jet-input type="text" class='w-full' wire:model='name' />
                <x-jet-input-error for='name' />
            </div>

            <div class='mb4'>
                <x-jet-label value='email' />
                <x-jet-input type="text" class='w-full' wire:model='email' />
                <x-jet-input-error for='email' />
            </div>


        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_save',false)">
                cancelar
            </x-jet-secondary-button>

          <!--  <x-jet-danger-button wire:click="create" wire:loading.remove wire:target='create'>
                crear user
            </x-jet-danger-button> -->
            <samp wire:loading wire:target='create'>Cargando ...</samp>
        </x-slot>

    </x-jet-dialog-modal>


    <!-- donde se edita -->
    <x-jet-dialog-modal wire:model='open_edit'>

        <x-slot name='title'>
            Editar del  users
        </x-slot>

        <x-slot name='content'>
            <div class="mb-4">
                <x-jet-label value="Titulo del producto" />
                <x-jet-input wire:model="name" type="text" class="w-full" />
            </div>

          </div>
          <div class="mb-4">
              <x-jet-label value="email" />
              <x-jet-input wire:model="email" type="text" class="w-full" />
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
            livewire.on('deleteUser', userid => {
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
                        livewire.emitTo('users', 'delete', userid)
                        Swal.fire(
                            'Eliminado!',
                            'El user  ha sido eliminado.',
                            'exitosamente'
                        )
                    }
                })
            });
        </script>
    @endpush



</div>
