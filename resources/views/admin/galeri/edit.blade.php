<x-admin.layout title="Ubah Foto Galeri">
    <a href="{{ route('admin.galeri.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-ink-500 transition hover:text-brand-700">
        <x-icon name="arrow-left" class="size-4" />
        Kembali ke galeri
    </a>

    <form method="POST" action="{{ route('admin.galeri.update', $galeri) }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        @method('PUT')
        @include('admin.galeri._form')
    </form>
</x-admin.layout>
