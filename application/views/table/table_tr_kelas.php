    <div class="container">  
      <h3>Data Santri</h3>
        <br />
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Kelas</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" style="overflow: scroll; overflow: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Nama Kelas Arab</th>
                    <th>Kapasitas</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
           <tr>
               <th>No</th>
               <th>Nama Kelas</th>
               <th>Nama Kelas Arab</th>
               <th>Kapasitas</th>
               <th>Action</th>
             </tr>
            </tfoot>
        </table>
    </div>