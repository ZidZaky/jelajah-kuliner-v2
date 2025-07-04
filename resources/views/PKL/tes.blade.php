<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="d-flex flex-column justify-content-start align-items-start">
        <h2 class="">List Pesanan</h2>
        <p>Dashboard ini disiapkan agar kamu lebih mudah melihat pesanan-pesanananmu</p>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link {{{$wht=='Pesanan Baru'?'active':''}}} text-black text-decoration-none" aria-current="page" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Baru'}}}">Pesanan Baru</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link {{{$wht=='Pesanan Diproses'?'active':''}}} text-black text-decoration-none" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Diproses'}}}">Pesanan Di Proses</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link {{{$wht=='Pesanan Siap Diambil'?'active':''}}} text-black text-decoration-none" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Siap Diambil'}}}">Pesanan Siap Diambil</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link {{{$wht=='Pesanan Selesai'?'active':''}}} text-black text-decoration-none" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Selesai'}}}">Pesanan Selesai</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link {{{$wht=='Pesanan Ditolak'?'active':''}}} text-black text-decoration-none" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Ditolak'}}}">Pesanan Ditolak</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow h-75" style="flex:1;">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th class="d-none text-center align-middle d-md-table-cell justify-content-center">Id Pesanan</th>
                            <th class="d-block text-center align-middle">Nama PKL</th>
                            <th class="d-none text-center align-middle d-md-table-cell">Keterangan</th>
                            <th class="text-center align-middle">Total Bayar</th>
                            <th class="d-none text-center align-middle d-md-table-cell">Tanggal</th>
                            <th class="text-center align-middle">Detail</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content pending">
                <table cellpadding="0" cellspacing="0" border="0">
                    @if($wht=='Pesanan Baru')

                    <tbody class="PesananBaru">
                        @if(collect($dataPesanan)->where('status', 'Pesanan Baru')->count()>0)
                        @foreach($dataPesanan as $data)
                        @if($data->status=='Pesanan Baru')
                        <tr>
                            <td class="text-center align-middle d-none d-md-table-cell">{{{$data->id}}}</td>
                            <td class="text-center align-middle">{{{$data->namaPKL}}} </td>
                            <td class="d-none d-md-table-cell">{{{$data->Keterangan}}}</td>
                            <td class="TotalBayar text-center align-middle">{{{$data->TotalBayar}}}</td>

                            <td class="actionButton text-center align-middle d-none d-md-table-cell d-flex flex-row gap-2">
                                {{{$data->created_at}}}
                            </td>



                            <td class="actionButton text-center align-middle">
                                <a href="/Detil/{{{$data->id}}}" class="text-decoration-none text-black"> Detail</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else

                        <p class="w-100 d-flex justify-content-center">Tidak ada pesanan lagi</p>
                        @endif

                    </tbody>
                    @endif
                    @if($wht=='Pesanan Diproses')

                    <tbody class="PesananDiproses">
                        @if(collect($dataPesanan)->where('status', 'Pesanan Diproses')->count()>0)
                        @foreach($dataPesanan as $data)
                        @if($data->status=='Pesanan Diproses')
                        <tr>
                            <td class="text-center align-middle d-none d-md-table-cell">{{{$data->id}}}</td>
                            <td class="text-center align-middle">{{{$data->namaPKL}}} </td>
                            <td class="d-none d-md-table-cell">{{{$data->Keterangan}}}</td>

                            
                            <td class="TotalBayar text-center align-middle">{{{$data->TotalBayar}}}</td>


                            <td class="actionButton text-center align-middle d-none d-md-table-cell d-flex flex-row gap-2">
                                {{{$data->created_at}}}
                            </td>
                            <td class="d-block">
                                <div class="buttongroup btn-group w-100 " role="group" aria-label="Basic mixed styles example">
                                    @if($data->status=='Pesanan Baru')
                                    <button type="button" onclick="window.location.href='/terimaPesanan/?id={{{$data->id}}}&wht=Pesanan'" class="btn btn-outline-success">
                                        <p class="p-clear">Terima</p>
                                    </button>
                                    <button type="button" onclick="window.location.href='/tolakPesanan/?id={{{$data->id}}}&wht=Pesanan'" class="btn btn-outline-danger">
                                        <p class="p-clear">Tolak</p>
                                    </button>
                                    @elseif($data->status=='Pesanan Diproses')
                                    <button type="button" onclick="window.location.href='/siapDiambilPesanan/?id={{{$data->id}}}&wht=Pesanan'" class="btn btn-outline-success">
                                        <p class="p-clear">Pesanan Siap Diambil</p>
                                    </button>
                                    @elseif($data->status=='Pesanan Siap Diambil')
                                    <button type="button" onclick="window.location.href='/selesaiPesanan/?id={{{$data->id}}}&wht=Pesanan'" class="btn btn-outline-success">
                                        <p class="p-clear">Pesanan Selesai</p>
                                    </button>
                                    @endif
                                </div>
                            </td>



                            <td class="actionButton text-center align-middle">
                                <a href="/Detil/{{{$data->id}}}" class="text-decoration-none text-black"> Detail</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else

                        <p class="w-100 d-flex justify-content-center">Tidak ada pesanan lagi</p>
                        @endif

                    </tbody>
                    @endif

                    @if($wht=='Pesanan Siap Diambil')

                    <tbody class="PesananSiapDiambil ">
                        @if(collect($dataPesanan)->where('status', 'Pesanan Siap Diambil')->count()>0)
                        @foreach($dataPesanan as $data)
                        @if($data->status=='Pesanan Siap Diambil')
                        <tr>
                            <td class="text-center align-middle d-none d-md-table-cell">{{{$data->id}}}</td>
                            <td class="text-center align-middle">{{{$data->namaPKL}}} </td>
                            <td class="d-none text-center align-middle d-md-table-cell">{{{$data->Keterangan}}}</td>

                            
                            <td class="TotalBayar text-center align-middle">{{{$data->TotalBayar}}}</td>


                            <td class="actionButton text-center align-middle d-none d-md-table-cell d-flex flex-row gap-2">
                                {{{$data->created_at}}}
                            </td>
                            



                            <td class="actionButton text-center align-middle">
                                <a href="/Detil/{{{$data->id}}}" class="text-decoration-none text-black"> Detail</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else

                        <p class="w-100 d-flex justify-content-center">Tidak ada pesanan lagi</p>
                        @endif

                    </tbody>
                    @endif
                    @if($wht=='Pesanan Selesai')
                    <tbody class="PesananSelesai justify-content-center">
                        @if(collect($dataPesanan)->where('status', 'Pesanan Selesai')->count()>0)
                        @foreach($dataPesanan as $data)
                        @if($data->status=='Pesanan Selesai')
                        <tr>
                            <td class="text-center align-middle d-none d-md-table-cell">{{{$data->id}}}</td>
                            <td class="text-center align-middle">{{{$data->namaPKL}}} </td>
                            <td class="d-none d-md-table-cell">{{{$data->Keterangan}}}</td>

                            
                            <td class="TotalBayar text-center align-middle">{{{$data->TotalBayar}}}</td>


                            <td class="actionButton text-center align-middle d-none d-md-table-cell d-flex flex-row gap-2">
                                {{{$data->created_at}}}
                            </td>
                            



                            <td class="actionButton text-center align-middle">
                                <a href="/Detil/{{{$data->id}}}" class="text-decoration-none text-black"> Detail</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else

                        <p class="w-100 d-flex justify-content-center">Tidak ada pesanan lagi</p>
                        @endif

                    </tbody>
                    @endif

                    @if($wht=='Pesanan Ditolak')
                    <tbody class="PesananDitolak">
                        @if(collect($dataPesanan)->where('status', 'Pesanan Ditolak')->count()>0)
                        @foreach($dataPesanan as $data)
                        @if($data->status=='Pesanan Ditolak')
                        <tr>
                            <td class="text-center align-middle d-none d-md-table-cell">{{{$data->id}}}</td>
                            <td class="text-center align-middle">{{{$data->namaPKL}}} </td>
                            <td class="d-none d-md-table-cell">{{{$data->Keterangan}}}</td>

                            
                            <td class="TotalBayar text-center align-middle">{{{$data->TotalBayar}}}</td>


                            <td class="actionButton text-center align-middle d-none d-md-table-cell d-flex flex-row gap-2">
                                {{{$data->created_at}}}
                            </td>



                            <td class="actionButton text-center align-middle">
                                <a href="/Detil/{{{$data->id}}}" class="text-decoration-none text-black"> Detail</a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @else

                        <p class="w-100 d-flex justify-content-center">Tidak ada pesanan lagi</p>
                        @endif

                    </tbody>
                    @endif

                </table>
            </div>
        </section>
    </div>
</div>