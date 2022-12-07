<div> 
    <div class="flex flex-col" >
        <div class="flex">
                <p class="text-sm  px-1 ">Tags  </p>
                    @foreach ($tag as $item)
                            <span class=" bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 p-5 rounded dark:bg-indigo-200 dark:text-indigo-900">{{$item->name_tag}}
                                <a class="  cursor-pointer {{$show?' fas fa-backspace absolute      
                                    -mt-2 rounded-lg':''}}" wire:click="delete({{ $item->id}})" >
                                </a> 
                            </span>
                    @endforeach
                        <a class=" {{$show?'fas fa-minus':'fas fa-plus'}} ml-1 rounded-md
                            items-center gap-4 text-sm px-2.5 py-0.5 bg-gradient-to-tr bg-indigo-500 text-white shadow-md hover:shadow-lg-light-blue"
                            href="#"  wire:click="$toggle('show')" >
                        </a>
        </div>
              @if ($show)
                    <div class="flex">
                        <input placeholder="Crear Etiqueta"  type="text" class="block py-2.5 pr-20 w-1/3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                        wire:model="name_tag" wire:keydown.enter="save"> 
                    </div>
              @endif
                
    </div>
</div> 

