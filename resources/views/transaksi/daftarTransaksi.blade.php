<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="alert alert-success" onClick="$(this).remove();">
                    <ul class="m-0">
                        <li>{{ session('success') }}</li>
                    </ul>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a class="btn btn-primary mb-4" href="{{ route('transactions.create') }}">+ Tambah Transaksi</a>
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Kendaraan</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Selesai</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                ajax: "{{ route('transactions.getAllTransactions') }}",
                serverSide: false,
                processing: true,
                deferRender: true,
                type: "GET",
                destroy: true,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'peminjam',
                        peminjam: 'name'
                    },
                    {
                        data: 'kendaraan',
                        name: 'kendaraan'
                    },
                    {
                        data: 'start',
                        name: 'start'
                    },
                    {
                        data: 'end',
                        name: 'end'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    },
                ]
            })
        })
    </script>
</x-app-layout>
