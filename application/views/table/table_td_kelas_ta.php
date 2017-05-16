    <div class="container">  
      <h3>Data Detail Kelas - <?php foreach ($data_kelas as $kelas) {
        echo $kelas['nama_kelas'].'dengan kapasitas : '.$kelas['kapasitas'];
      } ?></h3>
        <br />
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Kelas Tahun Ajaran</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="overflow: scroll; overflow: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Nama Guru</th>
                    <th>Semester</th>
                    <th>Tahun</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
           <tr>
               <th>No</th>
               <th>Nama Kelas</th>
               <th>Nama Guru</th>
               <th>Semester</th>
               <th>Tahun</th>
               <th>Action</th>
             </tr>
            </tfoot>
        </table>
    </div>