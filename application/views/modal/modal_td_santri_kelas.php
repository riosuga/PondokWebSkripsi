<script language="Javascript">
function SelectMoveRows(SS1,SS2)
{
    var SelID='';
    var SelText='';
    // Move rows from SS1 to SS2 from bottom to top
    for (i=SS1.options.length - 1; i>=0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID=SS1.options[i].value;
            SelText=SS1.options[i].text;
            var newRow = new Option(SelText,SelID);
            SS2.options[SS2.length]=newRow;
            SS1.options[i]=null;
        }
    }
    SelectSort(SS2);
}
function SelectSort(SelList)
{
    var ID='';
    var Text='';
    for (x=0; x < SelList.length - 1; x++)
    {
        for (y=x + 1; y < SelList.length; y++)
        {
            if (SelList[x].text > SelList[y].text)
            {
                // Swap rows
                ID=SelList[x].value;
                Text=SelList[x].text;
                SelList[x].value=SelList[y].value;
                SelList[x].text=SelList[y].text;
                SelList[y].value=ID;
                SelList[y].text=Text;
            }
        }
    }
}
</script>
 <script type="text/javascript">
        $(document).ready(function() {

          var last_valid_selection = null;

          $('#Features').change(function(event) {

            if ($(this).val().length > 150) {

              $(this).val(last_valid_selection);
            } else {
              last_valid_selection = $(this).val();
            }
          });
        });
</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Pengisian Kelas Tahun Ajaran</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal"  name ="Example">
                    <input type="hidden" value="" name="id"/> 
                    <input type="hidden" name="id_ta" value="<?php echo $slug; ?>">
                    <input type="text" name="id_santri_kelas" value="<?php foreach ($data_kelas as $kelas) {
                        echo $kelas['id_santri_kelas'];
                    } ?>">
                    <div class="form-body">
                       <div class="col-lg-12">
                          <table class="table table-striped table-advance table-hover border-top" id="sample_2">
                           <tr>
                            <td>
                                <select id="Features" name="Features" size="9" class="form-control" MULTIPLE> 
                                  <?php foreach ($data_santri as $data) {
                                    echo '<option value="'.$data['id_santri'].'">'.$data['nis'].' - '.$data['nama'].'</option>';
                                  }?>
                              </select>
                          </td>
                          <td align="center" valign="middle">
                            <input id="to-right" name ="to-right" class="btn btn-primary btn-lg btn-block" type="Button" value="Add >>" style="width:100px" onClick="SelectMoveRows(document.Example.Features,document.Example.FeatureCodes)"><br>
                            <br>
                            <input id="to-left" name="to-left" class="btn btn-primary btn-lg btn-block" type="Button" value="<< Remove" style="width:100px" onClick="SelectMoveRows(document.Example.FeatureCodes,document.Example.Features)">
                        </td>
                        <td>
                            <select id="FeatureCodes" name="FeatureCodes" class="form-control" size="9" MULTIPLE >
                                <!-- onchange="getCombo(this)" -->
                                <!-- <option value ="1">000117 - Roni</option> -->
                            </select>
                            <textarea type="text" id="myField" name="myField" class="form-control" readonly="true"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
    $('#FeatureCodes').on('DOMNodeInserted', function(){ 
      var values = $("#FeatureCodes > option").map(function() {
        return $(this).val();
      }).get().join(',');
      if($("#FeatureCodes > option").size() != 0 && $("#FeatureCodes > option").size() != null){
        $('#myField').val(values);
      }else{
        $('#myField').val("");
      }
});
    $('#to-left').click(function(){
    $('#myField').val('');
  });
</script>