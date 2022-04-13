<section>
    @if($order->surat_jalan == null)
    <h5>Lengkapi Orderan anda dan upload surat perintah jalan disini</h5>
    <div class="card">
        <div class="container-fluid">

            <form method="POST" enctype="multipart/form-data" action="{{route('complete_data',$order->order_number)}}">
                @csrf
                <div class="m-2">
                    <label>Alamat Pengiriman</label>
                    <input class="form-control" name="address" value="{{$order->address ?? auth()->user()->profile->address}}" />
                </div>

                <div class="m-2">
                    <label>Ditujukan Kepada</label>
                    <input class="form-control" name="pic_name" value="{{$order->pic_name ?? auth()->user()->profile->pic_name}}" />
                </div>

                <div class="m-2">
                    <label>Upload Surat Perintah</label>
                    <input type="file" name="surat_jalan" class="form-control" />
                </div>

                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
        <div class="justify-content-center">
            <button class="btn btn-success">Terima Kasih telah memilih kami, Penawaran telah di setujui</button>
        </div>
    </div>
    @else
    @endif
</section>