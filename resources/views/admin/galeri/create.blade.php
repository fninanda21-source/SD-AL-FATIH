<x-admin.layout title="Unggah Foto Galeri">
    <a href="{{ route('admin.galeri.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-ink-500 transition hover:text-brand-700">
        <x-icon name="arrow-left" class="size-4" />
        Kembali ke galeri
    </a>

    <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        @include('admin.galeri._form')
    </form>
</x-admin.layout>
