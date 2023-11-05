<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Peminjaman Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="alert alert-danger" onClick="$(this).remove();">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('transactions.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="idPeminjam" class="form-label">Peminjam*</label>
                            <select name="idPeminjam" id="idPeminjam" class="form-control">
                                <option value="">--Pilih dahulu--</option>
                                @foreach ($users as $user)
                                    @if (old('idPeminjam') == $user->id)
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="jenisKendaraan" class="form-label">Kendaraan*</label>
                            <select name="jenisKendaraan" id="jenisKendaraan" class="form-control">
                                <option value="">--Pilih dahulu--</option>
                                @foreach ($vehicles as $vehicle)
                                    @if (old('vehicleId') == $vehicle->id)
                                        <option value="{{ $vehicle->id }}" selected>{{ $vehicle->name }}</option>
                                    @else
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start*</label>
                            <input class="form-control" type="date" name="startDate" id="startDate"
                                value="{{ old('startDate') }}">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End*</label>
                            <input class="form-control" type="date" name="endDate" id="endDate"
                                value="{{ old('endDate') }}">
                        </div>
                        <div class="row">
                            <button class="btn btn-primary col-6">Ok</button>
                            <button type="reset" class="btn btn-danger col-6">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
