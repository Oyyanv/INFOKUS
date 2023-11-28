@if(isset($ortu))
    <div>
        <h3>NIK Orang Tua: {{ $ortu->NIK }}</h3>
        <p>Nama Orang Tua: {{ $ortu->Nama }}</p>
        <p>Alamat Orang Tua: {{ $ortu->Alamat }}</p>
        <p>No. Telepon Orang Tua: {{ $ortu->No_Telp }}</p>

        @php
            $siswa = $ortu->siswas->first();
        @endphp

        @if($siswa)
            <h4>Siswa yang Terkait:</h4>
            <ul>
                <li>NIS: {{ $siswa->NIS }}</li>
                <li>Nama Siswa: {{ $siswa->Nama }}</li>
            </ul>
        @else
            <p>Tidak ada siswa yang terkait dengan orang tua ini.</p>
        @endif
    </div>
    <hr>
@endif
