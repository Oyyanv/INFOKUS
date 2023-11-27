<table class="table">
    <thead>
      <tr>
        <th scope="col">NIS</th>
        <th scope="col">Nama</th>
        <th scope="col">Kelas</th>
        <th scope="col">Jurusan</th>
        <th scope="col">Angkatan</th>
        <th scope="col">NIK Ortu</th>
        
        
      </tr>
    </thead>
    <tbody>
              @foreach ($ortus as $ortu)
              <tr>
                  @foreach ($ortu->siswas as $siswa)
  
                  <td>{{ $siswa->NIS }}</td>
                  <td>{{ $siswa->Nama }}</td>
                  <td>{{ $siswa->kelas }}</td>
                  <td>{{ $siswa->Jurusan }}</td>
                  <td>{{ $siswa->Angkatan }}</td>
                  @endforeach
  
                  <td>{{ $ortu->NIK }}</td>
              </tr>
          @endforeach
  
     
    </tbody>
  
  </table>
  