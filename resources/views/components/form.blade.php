<form action="{{ route('generar') }}" method="POST" enctype="multipart/form-data">
  @csrf 
  <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="rfc" class="block text-sm/6 font-medium text-gray-900">Registro Patronal</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                    <input 
                                    type="text" 
                                    name="RP" 
                                    id="RP" 
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                    placeholder="Ingresa el Registro Patronal" 
                                    value=""
                                    required/>
                                </div>
                        </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="mes" class="block text-sm/6 font-medium text-gray-900">Mes</label>
                        <div class="mt-2">
                            <input 
                            id="mes" 
                            name="mes" 
                            type="month" 
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            style="cursor:pointer;" 
                            value=""
                            required 
                            />
                        </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="archivo" class="block text-sm/6 font-medium text-gray-900">Archivo</label>
                        <div class="mt-2">
                            <input 
                            id="file" 
                            name="file" 
                            type="file" 
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                            value="" 
                            accept=".xlsx,.xls"
                            required
                            />
                        </div>
                </div>
                <div class="mt-9 flex items-center justify-end gap-x-6">
                    <div class="flex item-center gap-x-6"> 
                        <!-- <a href="" class="text-sm font-semibold leading-8 text-gray-900 hover-red-400">Cancelar</a>  -->
                        <div>
                            <button type="submit" class="rounded-md bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generar</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>
