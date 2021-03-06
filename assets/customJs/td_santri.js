var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": locList,
            "type": "POST",
        },

        "coulmn":[
            { className: "my_class" },
        ],
         "scrollX": true,
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
            "className" : "col-lg-3 Action",
        },
        ],

    });

    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});



function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Santri'); // Set Title to Bootstrap modal title
}

function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : locPrev+"/"+ id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id_santri);
            $('[name="nis"]').val(data.nis);
            $('[name="nisn"]').val(data.nisn);
            $('[name="nama"]').val(data.nama);
            $('[name="nama_ar"]').val(data.nama_ar);
            $('[name="daerah"]').val(data.daerah);
            $('[name="daerah_ar"]').val(data.daerah_ar);
            $('[name="tempat_lahir"]').val(data.tempat_lahir);
            $('[name="tgl_lahir"]').datepicker('update',data.tgl_lahir);
            $('[name="tgl_awal"]').datepicker('update',data.tgl_awal);
            $('[name="tgl_akhir"]').datepicker('update',data.tgl_akhir);
            $('[name="nama_ayah"]').val(data.nama_ayah);
            $('[name="no_hp_ayah"]').val(data.no_hp_ayah);
            $('[name="nama_ibu"]').val(data.nama_ibu);
            $('[name="no_hp_ibu"]').val(data.no_hp_ibu);
            $('[name="alamat"]').val(data.alamat);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = locAdd;
    } else {
        url = locUpd;
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            alert(textStatus);
            alert(errorThrown);
            alert(jqXHR);
        }
    });
}

function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : locDel+"/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}