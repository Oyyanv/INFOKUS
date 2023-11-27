<div>
    <h3>NIS: {{ $siswa->NIS }}</h3>
    <p>Nama Siswa: {{ $siswa->Nama }}</p>
    <p>Kelas: {{ $siswa->kelas }}</p>
    <p>Jurusan: {{ $siswa->Jurusan }}</p>
    <p>Angkatan: {{ $siswa->Angkatan }}</p>

    <h4>Orang Tua:</h4>
    <p>Nama Orang Tua: {{ $siswa->ortu->Nama }}</p>
    <p>Alamat Orang Tua: {{ $siswa->ortu->Alamat }}</p>
    <p>No. Telepon Orang Tua: {{ $siswa->ortu->No_Telp }}</p>
    <!-- Tampilkan data lainnya -->
</div>