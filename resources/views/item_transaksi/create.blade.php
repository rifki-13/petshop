<h1>Form tambah data item transaksi</h1>
<form action="{{ route('item-transaksi.store') }}" method="post">
    @csrf
    <label for="transaksi_id">Nomor Transaksi</label>
    <select name="transaksi_id" id="transaksi_id">
        @foreach ($transaksi as $t)
            <option value="{{ $t->id }}">{{ $t->nomor }}</option>
        @endforeach
    </select>
    @error('transaksi_id')
        <p>{{ $message }} </p>
    @enderror
    <label for="produk_id">Produk</label>
    {{-- <select name="" id=""></select> --}}
    @error('tanggal')
        <p>{{ $message }} </p>
    @enderror
    <label for="total_harga">Total Harga:</label>
    <input type="number" name="total_harga" id="total_harga">
    @error('total_harga')
        <p>{{ $message }} </p>
    @enderror
    <label for="user_id">User</label>
    <select name="user_id" id="user_id">
        @foreach ($user as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <label for="status">Status</label>
    <select name="status" id="status">
        <option value="belum bayar">Belum Bayar</option>
        <option value="lunas">Lunas</option>
    </select>
    <br><br>
    <button type="submit">Submit</button>
</form>
