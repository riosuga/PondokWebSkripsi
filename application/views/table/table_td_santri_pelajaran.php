    <div class="container">  
      <h3>List Nilai Pelajaran - <?php foreach($data_santri as $data){
        echo $data['nama'];
        }?></h3>
        <br />
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Nilai</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="overflow: scroll; overflow: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Pelajaran</th>
                    <th>Guru</th>
                    <th>Tahun</th>
                    <th>Semester</th>
                    <th>Jenis Kegiatan</th>
                    <th>Tanggal Ujian</th>
                    <th>Tanggal Remidi</th>
                    <th>Nomor Bayanat</th>
                    <th>Nilai Awal</th>
                    <th>Nilai Remidi</th>
                    <th>Nilai Akhir</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
           <tr>
               <th>No</th>
               <th>Kelas</th>
               <th>Pelajaran</th>
               <th>Guru</th>
               <th>Tahun</th>
               <th>Semester</th>
               <th>Jenis Kegiatan</th>
               <th>Tanggal Ujian</th>
               <th>Tanggal Remidi</th>
               <th>Nomor Bayanat</th>
               <th>Nilai Awal</th>
               <th>Nilai Remidi</th>
               <th>Nilai Akhir</th>
               <th>Action</th>
             </tr>
            </tfoot>
        </table>
    </div>