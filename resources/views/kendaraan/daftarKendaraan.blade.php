<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kendaraan</th>
                                <th>Tipe</th>
                                <th>License</th>
                                <th>Daily Price</th>
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
        $(document).ready(function () {
            $('#myTable').DataTable({
                ajax: "{{route('vehicles.getAllVehicles')}}",
                serverSide: false,
                processing: true,
                deferRender: true,
                type: "GET",
                destroy: true,
                columns: [
                    {data: 'id', name:'id'},
                    {data: 'name', name:'name'},
                    {data: 'type', name:'type'},
                    {data: 'license', name:'license'},
                    {data: 'dailyPrice', name:'dailyPrice'},
                ]
            })
        })
    </script>
</x-app-layout>
