
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Highlight Product
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <p class="px-4 mb-16 font-semibold text-xl text-gray-800 leading-tight">Data Highlight</p>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">UMKM</th>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse( $products as $row)
                        <tr class="h-24">
                            <td class="border px-4 py-2">{{ $row->umkm }}</td>
                            <td class="border px-4 py-2">{{ $row->title }}</td>
                            <td class="border px-4 py-2">
                                @if ($row->highlight)
                                <button wire:click="Highlight({{ $row->id }},{{$row->highlight}})" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Active</button>
                                @else
                                <button wire:click="Highlight({{ $row->id }},{{$row->highlight}})" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"> Non Active</button>
                                @endif    
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="5">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-10">
        {!! $products->links() !!}
        </div>
    </div>
</div>
