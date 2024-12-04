<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Program Studi') }}
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
                            <a href="{{ route('prodi.create') }}" class="btn btn-primary mr-2">Tambah Program Studi</a>
                            
                            <!-- Search Form -->
                            <form action="{{ route('/prodi') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control" placeholder="Pencarian" value="{{ old('search', $search) }}">
                                <button class="btn btn-primary ml-2" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Program Studi Table -->
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodis as $prodi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prodi->nama }}</td>
                                    <td>
                                        <a href="{{ route('prodi.edit', $prodi->id) }}" class="btn btn-secondary">Edit</a>
                                        <button class="btn btn-danger" onclick="confirmDelete({{ $prodi->id }}, '{{ $prodi->nama }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Back Button after Search moved to bottom left -->
                    @if(request()->has('search'))
                        <div class="mt-4">
                            <a href="{{ route('/prodi') }}" class="btn btn-secondary">Back</a>
                        </div>
                    @endif

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fs-5">Apakah Anda yakin ingin menghapus <span id="prodiName"></span>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- JavaScript -->
                    <script>
                        function confirmDelete(id, name) {
                            const deleteUrl = "{{ route('prodi.delete', ':id') }}".replace(':id', id);
                            document.getElementById('deleteForm').action = deleteUrl;
                            document.getElementById('prodiName').textContent = name;
                            new bootstrap.Modal(document.getElementById('deleteModal')).show();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
