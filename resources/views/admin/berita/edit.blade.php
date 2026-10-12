<x-admin.layout title="Ubah Berita">
    <x-slot:aksi-halaman>
        <a href="{{ route('berita.show', $berita) }}" target="_blank" rel="noopener" class="btn-outline !py-2.5">
            <x-icon name="arrow-up-right" class="size-4" />
            Lihat di situs
        </a>
    </x-slot:aksi-halaman>

    <a href="{{ route('admin.berita.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-ink-500 transition hover:text-brand-700">
        <x-icon name="arrow-left" class="size-4" />
        Kembali ke daftar berita
    </a>

    <form method="POST" action="{{ route('admin.berita.update', $berita) }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        @method('PUT')
        @include('admin.berita._form')
    </form>
</x-admin.layout>
