<div>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Peminjam</th>
                <th>Division</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
                <th>Return Qty</th>
                <th>Keterangan barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invlog as $item)
            <tr class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger'  : 'text-bg-success') }}">
                <td>{{$loop->iteration}}</td>
                <td>{{$item->user->username ?? 'None'}}</td>
                <td>{{$item->nickname}}</td>
                <td>{{$item->depart_id}} </td>
                <td>{{$item->inv->title}}</td>
                <td>{{$item->stock}}</td>
                <td>{{$item->inv_date}}</td>
                <td>{{$item->return_date}}</td>
                <td>{{$item->actual_return_date}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->condition}}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
