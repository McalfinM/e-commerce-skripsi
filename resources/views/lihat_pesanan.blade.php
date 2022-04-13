<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aloha!</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;

        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top"><img src="data:image/jpeg;base64,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tNFcqnFBnGrHcC9WS2HmDwDqJ5c+0/FPFaaK5VORGFXudDo2tUb8q9s+MnwC8DbItNFcqnJDwDTXdQhW7ogXEORgUUCZT1tyZ3OVaaK5VOWdD+uS3aJx9qAziogAEyVOAql2RySSZOXaaK5VOZLIsBYhShsA9j8QyMcCODlhWoAz7qUjSMv9zbTRXKpznn3oJAQ/z27XILghalPu5ZnZEkiSXJmc600Vyqc8OIgxUYH0/wCoOKOow9qMJDcp/wCNBoNuQtNFcqnkRw7WodwoQr6OnBlaganZRp+dvyVporlU4q7H0cytSp2ywCSAA5KZhNDf8AReXClODtljBRJAI3QHhr47TRXKpxpDrkDEGLp1DqpdipgRgMciU7YiCgav+VOBuGbQruYExsiREBBEwcgiAHX/AMU1es5leO9HHaaK5VOSlHlOjDYK7eSiNmGXiYDlDEwbHIHUZgAYDCI2gZow9ICWEaINoFDj9N+oAAMBw8F6OO00VyqctKEmncyIztKh2PB4R5DYpsKZHIABAODMFP8AvCXZG5YNDwjo85MqB5O+DwXo47TRXKpzEj0o1/insFL+syLZQ6hOrPgdHbF4L0cdporlU/AJeC9HHaaK5VPwCXgvRx2miuVT8Al4L0cdporlU4n1D8J3Ow5piCRHWDInNBMHFaaK5VOAxE6BQw/U71QAAAGA05vbbBMJ9Z0em+G00VsqeMbXX8QTPw6nU7nnt09M/cfiLCOJaaK7VKeKq9gqEqs8A+CIgg9J/epaP3haaLo3kWkSgRzID4WAMneB91ZaL//aAAwDAQACAAMAAAAQbC8888888888888888ey8sW1888888888888vDhA8++t98888888884/wCCA8+++/o+888888TACCCCA8+++++MM888wJBCCCCCA8+++++++O+hhCCCCCCCA8++B++++/iEKCCCDDCCA8++W4x3pT88RPAtdpCCA8++D88B88888sm88pCCA8++H888888888888pCCA8+zD888888888888ABCA3m+88888888888888dgE+888888888888888888g/8QAJREBAAIBAwQCAwEBAAAAAAAAAQARoSExQRAgUXEwYUCBkcGx/9oACAEDAQE/EExuNOSXi765PwSlfT/7NH1NOxMlHikyk0XzxBEs+VIAOWamf60VVrcY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" alt="" width="100" /></td>

        </tr>

    </table>

    <table width="100%" style="border: 1px solid;">
        <tr>
            <td style="text-align: center; font-size:20px;"><strong>Pesanan {{$order->User->username}}</td>

        </tr>

    </table>
    <br />

    <table width="100%">
        <thead">
            <tr>
                <th id="tableku">No</th>
                <th id="tableku">Barang</th>
                <th id="tableku">Quantity</th>
                <th id="tableku">Volume</th>
                <th id="tableku">Harga Satuan Rp</th>
                <th id="tableku">Total Rp</th>
            </tr>
            </thead>
            <tbody>
                @php
                $number = 0;
                $sub_total = 0;
                $total = 0;
                @endphp
                @foreach($data as $datas)
                @php
                $number += 1;
                $sub_total += $datas->total_price;
                @endphp
                <tr>
                    <th id="tableku" scope="row">{{$number}}</th>
                    <td id="tableku" align="right">{{$datas->product->name}}</td>
                    <td id="tableku" align="right">{{$datas->quantity}}</td>
                    <td id="tableku" align="right">{{$datas->volume}}</td>
                    <td id="tableku" align="right">{{$datas->product->rupiah()}}</td>
                    <td id="tableku" align="right">{{"Rp " . number_format($datas->total_price, 0, ',', '.');}}</td>
                </tr>
                @endforeach
                @php
                $total = $sub_total / 10 + $sub_total;
                @endphp
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Jumlah Rp</td>
                    <td align="right">{{"Rp " . number_format($sub_total, 0, ',', '.');}}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">PPN Rp</td>
                    <td align="right">{{"Rp " . number_format($sub_total / 10, 0, ',', '.');}}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td align="right">Total </td>
                    <td align="right" class="gray">{{"Rp " . number_format($total, 0, ',', '.');}}</td>
                </tr>
            </tfoot>
    </table>
    </br>
    <footer class="footer">
        <table width="100%">
            <tr>
                <td style="text-align: left;">
                    Hormat Kami<br>
                    CV MANYAR SEWU

                </td>


            </tr>

        </table>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        <table width="100%">


        </table>
        <p></p>
        <p></p>
        <p></p>
        <p style="font-size: 10px;">CV. Manyar Sewu<br>
            Jl.Raya Pondok Cabe</p>
    </footer>
</body>

</html>