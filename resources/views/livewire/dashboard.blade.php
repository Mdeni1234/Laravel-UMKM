
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Product
    </h2>
</x-slot>
<div class="py-1">
    <div class="w-full mb-8 sm:px-6 lg:px-8">
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
            <p class="px-4 font-semibold text-xl text-gray-800 leading-tight">Data Products</p>
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Product</button>
            @if($isModal)
                @include('livewire.create')
            @endif
            @if($isBanner)
                @include('livewire.createBanner')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">UMKM</th>
                        <th class=" px-4 py-2">Title</th>
                        <th class="hidden px-4 py-2 md:table-cell">Description</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="hidden px-4 py-2 md:table-cell">Profile Image</th>
                        <th class="px-4 py-2">Banner</th>
                        <th class="px-4 py-2">Highlight</th>
                        <th class=" px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $row)
                        <tr class="h-28">
                            <td class="border px-4 py-2">{{ $row->umkm }}</td>
                            <td class="border px-4 py-2">{{ $row->title }}</td>
                            <td class="border px-4 py-2">{{ $row->description }}</td>
                            <td class="border hidden px-4 py-2 md:table-cell">{{ $listCategory[$row->category]}}</td>
                            <td class="border hidden px-4 py-2 md:table-cell"><img class="h-24 mx-auto" src="{{asset('storage/'.$row->profile_img)}}"></td>
                            <td class="border px-4 py-2">
                                @if ( $row->banner)
                                <button wire:click="createBanner({{ $row->id }})" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                @else
                                <button wire:click="createBanner({{ $row->id }})" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</button>
                                @endif    
                            </td>
                            <td class="border px-4 py-2">
                                @if ($row->highlight)
                                <button wire:click="Highlight({{ $row->id }},{{$row->highlight}})" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Active</button>
                                @else
                                <button wire:click="Highlight({{ $row->id }},{{$row->highlight}})" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"> Non Active</button>
                                @endif    
                            </td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $row->id }})" class="w-full mb-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $row->id }})" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="8">Tidak ada data</td>
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