<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Pengembalian Kendaraan') }}
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
                    <form action="{{ route('transactions.update') }}" method="post">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="idTransaksi" class="form-label">ID Transaksi</label>
                            <input name="idTransaksi" id="idTransaksi" value="{{ $transaction->id }}" readonly class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="namaPeminjam" class="form-label">Peminjam</label>
                            <input name="namaPeminjam" id="namaPeminjam" value="{{ $transaction->peminjam }}" readonly class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="namaKendaraan" class="form-label">Kendaraan</label>
                            <input name="namaKendaraan" id="namaKendaraan" value="{{ $transaction->peminjam }}" readonly class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start</label>
                            <input name="startDate" id="startDate" value="{{ $transaction->start }}" readonly class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Start</label>
                            <input name="endDate" id="endDate" value="{{ $transaction->end }}" readonly class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status*</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">--Pilih dulu--</option>
                                <option value="1" {{ $transaction->status == 1 ? 'selected' : '' }}>Pinjam</option>
                                <option value="2" {{ $transaction->status == 2 ? 'selected' : '' }}>Kembali</option>
                                <option value="3" {{ $transaction->status == 3 ? 'selected' : '' }}>Hilang</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <button class="btn btn-primary col-6">Save</button>
                            <button type="reset" class="btn btn-danger col-6">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
