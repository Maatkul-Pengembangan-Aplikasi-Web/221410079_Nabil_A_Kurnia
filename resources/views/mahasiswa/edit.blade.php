<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('error'))
                <div>
                    {{ session('error') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col"> Nama Lengkap
                                <input type="text" name="nama" class="form-control" placeholder="Aa Herdi Prayoga"
                                    value="{{ $mahasiswa->nama }}">
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col"> NPM
                                <input type="number" name="npm" class="form-control" placeholder="191410001"
                                    value="{{ $mahasiswa->npm }}">
                                @error('npm')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="prodi" class="form-label">Program Studi</label>
                                <select name="prodi" class="form-control" id="prodi">
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->nama }}"
                                            {{ $mahasiswa->prodi == $prodi->nama ? 'selected' : '' }}>
                                            {{ $prodi->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($mahasiswa->foto)
                            <div class="mb-3">
                                <img src="{{ asset('fotomahasiswa/' . $mahasiswa->foto) }}" width="100">
                            </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col"> Pas Foto
                                <input type="file" name="foto" class="form-control">
                                @error('foto')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>