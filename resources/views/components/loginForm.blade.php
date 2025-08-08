<form action="" method="POST" enctype="multipart/form-data">
  @csrf 
  <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="user" class="block text-sm/6 font-medium text-gray-900">Nombre Usuario</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                    <input 
                                    type="text" 
                                    name="user" 
                                    id="user" 
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" 
                                    placeholder="Ingresa un Nombre de Usuario" 
                                    value=""
                                    required/>
                                </div>
                        </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Contraseña</label>
                        <div class="mt-2">
                            <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" 
                            placeholder="Ingresa una contraseña"
                            value=""
                            required 
                            />
                        </div>
                </div>

                <div class="mt-9 flex items-center justify-end gap-x-6">
                    <div class="flex item-center gap-x-6"> 
                        <div>
                            <button type="submit" class="rounded-md bg-red-700 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Iniciar Sesion</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>