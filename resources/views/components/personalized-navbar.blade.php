<div class="sidebar">
    <nav>
        <h1><a href="/dashboard">Jelajah Kuliner</a></h1>
        <ul>
            <!-- <li><a href="/spots">Best Spots</a></li>
            <li><a href="/list-products">Products</a></li>
            <li><a href="/your-history">Your History</a></li> -->
            <li><a href="/profile">My Profile</a></li>
            @php
                $pklExists = \App\Models\PKL::where('idAccount', session('account')['id'])->exists();
                use Illuminate\Support\Facades\Request;

            @endphp

            @if (Request::is('dashboard'))
                <button onclick="OpenPesanan()"
                    style="background-color: white; margin-bottom: 10px; border-radius: 6px; height: 5vh;">List
                    Pesanan</button>
            @endif

            @if ($pklExists && session('account')['status'] == 'PKL')
                <a class="btn btn-primary" href="/dataPKL/{{ session('account')['id'] }}" role="button">Dashboard PKL</a>

                <a class="btn btn-primary" href="/Dashboard-Penjualan/{{ session('account')['id'] . 'VToday' }}"
                    role="button">Dashboard Penjualan</a>
            @elseif (session('account')['status'] == 'PKL')
                <a class="btn btn-primary" href="/PKL/create" role="button">Create Data PKL</a>
            @elseif (session('account')['status'] == 'Admin')
                <a class="btn btn-primary" href="/account" role="button">List Account</a>
                <a class="btn btn-danger" href="/report" role="button">Account Reports</a>
            @endif
        </ul>
        <hr>
        <a class="btn btn-warning" href="/logout" role="button">Logout</a>
        <!-- iki lapo kok warning -->
        @if (session('account')['nama'] == 'Admin')
            <a class="btn btn-primary" href="/account" role="button">List Account</a>
        @endif
        <a class="btn btn-primary" href="/userguide" role="button">User Guides</a>


    </nav>
    <div class="menu">
        <p>≡</p>
    </div>
</div>
