<x-admin.layout title="Tambah Guru">
    <a href="{{ route('admin.guru.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-ink-500 transition hover:text-brand-700">
        <x-icon name="arrow-left" class="size-4" />
        Kembali ke daftar guru
    </a>

    <form method="POST" action="{{ route('admin.guru.store') }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        @include('admin.guru._form')
    </form>
</x-admin.layout>
