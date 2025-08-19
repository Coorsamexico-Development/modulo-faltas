<a {{$attributes->merge(['href' => route('descargar'), 'class' => 'rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-xs hover:bg-blue-950 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'])}}>
    {{$slot}}
</a>