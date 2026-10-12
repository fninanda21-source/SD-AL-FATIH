<x-admin.layout title="Galeri">
    <x-slot:aksi-halaman>
        <a href="{{ route('admin.galeri.create') }}" class="btn-primary !py-2.5">
            <x-icon name="photo" class="size-4" />
            Unggah foto
        </a>
    </x-slot:aksi-halaman>

    @if ($galeri->isEmpty())
        <div class="card px-6 py-16 text-center">
            <span class="mx-auto flex size-14 items-center justify-center rounded-2xl bg-ink-50 text-ink-300">
                <x-icon name="photo" class="size-7" />
            </span>
            <p class="mt-4 text-sm font-semibold text-ink-600">Belum ada foto di galeri.</p>
            <a href="{{ route('admin.galeri.create') }}" class="btn-primary mt-5">Unggah foto pertama</a>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($galeri as $foto)
                <article class="card-hover overflow-hidden">
                    <a href="{{ route('admin.galeri.edit', $foto) }}" class="block">
                        <div class="aspect-4/3 overflow-hidden bg-ink-50">
                            @if ($foto->gambar)
                                <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}" class="size-full object-cover">
                            @else
                                <div class="grid size-full place-items-center text-ink-300">
                                    <x-icon name="photo" class="size-8" />
                                </div>
                            @endif
                        </div>
                    </a>

                    <div class="p-4">
                        <p class="chip bg-brand-50 text-brand-700">{{ $foto->kategori }}</p>
                        <p class="mt-2 truncate text-sm font-bold text-ink-900">{{ $foto->judul }}</p>
                        <p class="text-xs text-ink-500">{{ $foto->tanggal?->translatedFormat('d M Y') }}</p>

                        <div class="mt-4 flex items-center gap-1 border-t border-ink-100 pt-3">
                            <a href="{{ route('admin.galeri.edit', $foto) }}"
                                class="btn !px-3 !py-2 text-xs !bg-ink-50 !text-ink-700 hover:!bg-brand-50 hover:!text-brand-700">
                                <x-icon name="document-text" class="size-4" />
                                Ubah
                            </a>
                            <form method="POST" action="{{ route('admin.galeri.destroy', $foto) }}" class="ml-auto"
                                onsubmit="return confirm('Hapus foto &quot;{{ $foto->judul }}&quot;?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn !px-3 !py-2 text-xs !bg-red-50 !text-red-700 hover:!bg-red-100">
                                    <x-icon name="x-mark" class="size-4" />
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $galeri->links() }}
        </div>
    @endif
</x-admin.layout>
