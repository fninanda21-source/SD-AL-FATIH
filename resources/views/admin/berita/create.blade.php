<x-admin.layout title="Tulis Berita">
    <a href="{{ route('admin.berita.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-ink-500 transition hover:text-brand-700">
        <x-icon name="arrow-left" class="size-4" />
        Kembali ke daftar berita
    </a>

    <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        @include('admin.berita._form')
    </form>
</x-admin.layout>
