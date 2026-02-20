<?php 
include 'server/config.php'; 
include 'easoftsql.php'; 


if(isset($_GET['id'])){
$qry = $conn->query("SELECT sd.*,su.* FROM supplierdeliver sd  inner join supplier su on sd.name = su.supplier_id  where sid= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
}
}
?>
<div class="container-fluid">
    <form action="" id="supplierlin">
      <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>"> 
        <div class="row">
        <div class="col-md-3 border-right ">
            <h5><b>Company Details</b></h5>
            <hr>
            <div id="msg" class="form-group"></div>
            <div class="form-group">
                <label for="" class="control-label">Company Name</label>        
           
            <select name="companynameid" id="companynameid" class="custom-select input-sm select2"  cols="30" rows="4" required=""> <!-- onchange="FetchState(this.value) -->
               
                <option selected="" value="<?php echo isset ($supplier_id)? $supplier_id :'' ?>"><?php echo isset ($companyname)? $companyname :'' ?></option>
                 <?php
                    $query = "SELECT * FROM supplier";
                    $result = $conn->query($query);
                   if ($result->num_rows > 0) {
                    while($row= $result->fetch_assoc()){                    
             
                    }
                  }
                    ?>          
                    <?php
                    $fees = $conn->query("SELECT * FROM supplier");

                    while($row= $fees->fetch_assoc()):
                        
                ?>
                <option value="<?php echo $row['supplier_id'] ?>" ><?php echo  $row['supplier_id'].' | '.ucwords($row['companyname']) ?></option>
                <?php endwhile; ?>              
            </select>

            </div>
           




        </div>
        

        <div class="col-md-2 border-right">
            <h5><b>Product</b></h5>
            <hr>          
                <div class="form-group">
                    <label for="subj" class="control-label">Name</label>
                    <input type="text" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Quantity</label>
                    <input type="number" step="any" min="0" id="quantity" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Price</label>
                    <input type="number" step="any" min="0" id="price" class="form-control">
                </div>             

                <div class="form-group">
                    <label for="" class="control-label">Unit</label>
                    <input type="type" step="any" min="0" id="unit" class="form-control">
                </div> 
                <div class="form-group">
                    <label for="" class="control-label">Expiring Date</label>
                    <input type="date" step="any" min="0" id="expire_date" class="form-control">
                </div>

                <div class="form-group">
                    <label for="" class="control-label">Description</label>
                    <input type="type" step="any" min="0" id="description" class="form-control">
                </div> 
                <div class="form-group">
                <input type="hidden" step="any" id="multtotal" class="form-control">
                </div>
                 <div class="form-group pt-1">
                    <label for="" class="control-label">&nbsp;</label>
                    <button class="btn btn-primary btn-sm" type="button" id="add_fee"> List</button>
                </div>
            
        </div>
           <div class="col-lg-7">
            <h5><b>Production Details</b></h5>
            <hr>  
            <table class="table table-condensed" id="fee-list">
                <thead>
                    <tr>
                        <th width="5%"></th>
                        <th width="30%">Name</th>
                        <th width="25%">quantity</th>
                        <th width="25%">Price</th>
                        <th width="25%">TCost</th>
                        <th width="50%">Unit</th>
                         <th width="50%">Expire D</th>
                        <th width="50%">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($id)):
                    $fees = $conn->query("SELECT sc.*,sd.* FROM suppliercompany sc inner join supplierdeliver sd on sc.id = sd.supplierid where  id= $id");
                        /*$classt = 0;
                        $examt = 0;*/
                    while($row=$fees->fetch_assoc()): 
                          /* $classt += $row[''];
                           $examt += $row[''];*/
                    ?>
                        <tr>
                            <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                            <td>
                                <input type="hidden" name="sid[]" value="<?php echo $row['sid'] ?>">
                                <input type="hidden" name="name[]" value="<?php echo $row['name'] ?>">
                                <p><small><b class="proname text-center" style="padding-right: 30px;"><?php echo $row['name'] ?></b></small></p>
                            </td>
                             <td>
                                <input type="hidden" name="quantity[]" value="<?php echo $row['quantity'] ?>">
                                <p class="text-center" style="padding-right: 25px;"><small><b class="proquantity"><?php echo number_format($row['quantity']) ?></b></small></p>
                            </td>

                            <td>
                                
                                <input type="hidden" name="price[]" value="<?php echo $row['price'] ?>">
                                <p  class="text-left" style="padding-right: 25px;"><small><b class="proprice"><?php echo number_format($row['price']) ?></b></small></p>
                            </td> 

                                <td>                                
                                <input type="hidden" name="multtota[]" value="<?php echo $row['multtota'] ?>">
                                <p  class="text-left" style="padding-right: 25px;"><small><b class="prodescription"><?php echo ($row['multtota']) ?></b></small></p>                                

                            </td>

                             <td>
                                
                                <input type="hidden" name="unit[]" value="<?php echo $row['unit'] ?>">
                                <p  class="text-left" style="padding-right: 50px;"><small><b class="prounit"><?php echo ($row['unit']) ?></b></small></p>
                            </td> 

                             <td>
                                
                                <input type="hidden" name="expire_date[]" value="<?php echo $row['unit'] ?>">
                                <p  class="text-left" style="padding-right: 50px;"><small><b class="expire_date"><?php echo ($row['unit']) ?></b></small></p>
                            </td> 
                              
                             <td>                          
                                <input type="hidden" name="description[]" value="<?php echo $row['description'] ?>">
                                <p  class="text-left" style="padding-right: 50px;"><small><b class="prodescription"><?php echo ($row['description']) ?></b></small></p>                                

                            </td>                           
                        </tr>
                    <?php
                        endwhile; 
                        endif; 
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center">Total Price</th>
                        <th class="text-right">
                            <input type="hidden" name="price2" value="">
                            <span class="tprice"><?php echo isset($price2) ? number_format($price2,2) : '0.00' ?></span>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">Total Cost</th>
                        <th class="text-right">
                            
                            <input type="hidden" name="multtota2"  value="">
                            <span class="tscore2"><?php echo isset($multtota2) ? number_format($multtota2,2) : '0.00' ?></span>
                        </th>
                    </tr> 
                </tfoot>
            </table>
        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>
    </form>
</div>
<div id="fee_clone" style="display: none">
     <table >
            <tr>
                <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                <td>
                    <input type="hidden" name="sid[]">
                    <input type="hidden" name="name[]">
                    <p class="text-center"  style="padding-right: 30px;"><small><b class="proname"></b></small></p>
                </td>
                <td>
                    <input type="hidden" name="quantity[]">
                    <p class="text-center" style="padding-right: 25px;"><small><b class="proquantity"></b></small></p>
                </td>
                <td>
                    <input type="hidden" name="price[]">
                    <p class="text-center" style="padding-right: 25px;"><small><b class="proprice"></b></small></p>
                </td>
                <td>
                    <input type="hidden" name="unit[]">
                    <p class="text-left"><small><b class="prounit"></b></small></p>
                </td>
                <td>
                    <input type="hidden" name="multtota[]">
                    <p class="text-left" style="padding-right: 50px;"><small><b class="promult"></b></small></p>
                    
                </td>
                 <td>
                    <input type="hidden" name="expire_date[]">
                    <p class="text-left" style="padding-right: 50px;"><small><b class="proexpire_date"></b></small></p>
                    
                </td>
                <td>
                    <input type="hidden" name="description[]">
                    <p class="text-left" style="padding-right: 50px;"><small><b class="prodescription"></b></small></p>
                    
                </td>
            </tr>
    </table>
</div>
<script>
    $('#manage-examination').on('reset',function(){
        $('#msg').html('')
        $('input:hidden').val('')
    })
/*
   function FetchState(supplier_id){ 
    $('#StudentName').html('');
    $.ajax({
        type:'post',
        url: 'server/suppliersdropdown.php',
        data:{aja_id :supplier_id},
        success : function(data){
            conson
            $('#StudentName').html(data);
             return false;
        }

    })
   }*/
$("#price, #quantity").keyup(function(){
 var multtotal1 = 0;
 var x = Number($("#price").val());
 var y = Number($("#quantity").val());
 var multtotal1= x * y;

 $("#multtotal").val(multtotal1);

});





    $('#add_fee').click(function(){
        var name = $('#name').val()
        var quantity = $('#quantity').val()
        var price = $('#price').val()
        var unit = $('#unit').val()
        var description = $('#description').val()
        var multtotal = $('#multtotal').val()
        var expiredate = $('#expire_date').val()
        if(name == '' || quantity == '' || price == '' || unit == '' || multtotal == ''){
            alert_toast("Please make sure you fill Name,Quantity,Price,Expiring Date and Unit.",'warning')
            return false;
        }
        var tr = $('#fee_clone tr').clone()
        tr.find('[name="name[]"]').val(name)
        tr.find('.proname').text(name)
        tr.find('[name="quantity[]"]').val(quantity)
        tr.find('.proquantity').text(parseFloat(quantity).toLocaleString('en-US'))
         tr.find('[name="price[]"]').val(price)
        tr.find('.proprice').text(parseFloat(price).toLocaleString('en-US'))
        tr.find('[name="unit[]"]').val(unit)
        tr.find('.prounit').text(unit)
        tr.find('[name="description[]"]').val(description)
        tr.find('.prodescription').text(description)
        tr.find('[name="multtota[]"]').val(multtotal)
        tr.find('.promult').text(multtotal)
         tr.find('[name="expire_date[]"]').val(expiredate)
        tr.find('.proexpire_date').text(expiredate)



        
        $('#fee-list tbody').append(tr)
        $('#name').val('').focus()
        $('#quantity').val('')
        $('#price').val('')
        $('#unit').val('')
        $('#description').val('')
        $('#multtotal').val('')
         $('#expire_date').val('')
        
        calculate_total1()
        calculate_total2()
    })
    function calculate_total1(){
        var total = 0;
        $('#fee-list tbody').find('[name="price[]"]').each(function(){
            total += parseFloat($(this).val())
        })
        $('#fee-list tfoot').find('.tprice').text(parseFloat(total).toLocaleString('en-US'))
        $('#fee-list tfoot').find('[name="price2"]').val(total)

    }

    function calculate_total2(){
        var total2 = 0;
        $('#fee-list tbody').find('[name="multtota[]"]').each(function(){
            total2 += parseFloat($(this).val())
          //  alert (total2)
        })
        $('#fee-list tfoot').find('.tscore2').text(parseFloat(total2).toLocaleString('en-US'))
        $('#fee-list tfoot').find('[name="multtota2"]').val(total2)

    }

    function rem_list(_this){
        _this.closest('tr').remove()
        calculate_total1()
        calculate_total2()
    }
        $(document).on('submit', '#supplierlin', function(e) {
        e.preventDefault()
        start_load()
        
        $('#msg').html('')
        if($('#fee-list tbody').find('[name="sid[]"]').length <= 0){
            alert_toast("Please insert atleast 1 row in the fees table",'danger')
            end_load()
            return false;
        }
        alert('dsldls');
        $.ajax({
            url:'easoftfun.php?action=save_supplierdeliver',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
               
                if(resp==1){
                    alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
                }else if(resp == 2){
                $('#msg').html('<div class="alert alert-danger mx-2">Name,Date,Term & Class  already exist.</div>')
                end_load()
                }   
            }
        })
    })

//    $(document).ready(function() {
//     $('.select2').select2({
//         placeholder: 'Please select here',
//         width: '100%'
//     });
// });

</script>