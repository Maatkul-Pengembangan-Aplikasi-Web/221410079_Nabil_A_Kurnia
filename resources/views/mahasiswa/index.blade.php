<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="ml-auto d-flex">
                            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mr-2">Tambah Mahasiswa</a>
                            <form action="{{ route('/mahasiswa') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control" placeholder="Pencarian"
                                    value="{{ old('search', $search) }}">
                                <button class="btn btn-primary ml-2" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Program Studi</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->nama }}</td>
                                    <td>{{ $mahasiswa->npm }}</td>
                                    <td>{{ $mahasiswa->prodi }}</td>
                                    <td>
                                        @if ($mahasiswa->foto)
                                            <img src="{{ asset('fotomahasiswa/' . $mahasiswa->foto) }}"
                                                alt="{{ $mahasiswa->nama }}" width="100">
                                        @else
                                            Tidak ada Fotonya
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"class="btn btn-secondary">Edit</a>
                                        <a href="javascript:void(0)" onclick="deleteFunction({{ $mahasiswa->id }})"
                                            type="button" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function deleteFunction(id) {
        // Set the product ID in the hidden input field
        document.getElementById('delete_id').value = id;

        // Update the form action dynamically
        var form = document.getElementById('deleteForm');
        form.action = '/mahasiswa/delete/' + id;

        // Show the modal
        $("#modalDelete").modal('show');
    }
</script>

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="post" id="deleteForm">
                @csrf
                @method('DELETE')
                <input type="hidden" name="mahasiswa_id" id="delete_id">

                <!-- Header Modal -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalDeleteTitle">Konfirmasi Penghapusan Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body text-center">
                    <p class="fs-5">Apakah kamu yakin untuk menghapus data tersebut?</p>
                    <p class="text-muted">data tidak dapat di kembalikan apabila sudah terhapus</p>
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>