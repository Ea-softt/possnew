<?php 
session_start();
include 'server/config.php'; 
include 'easoftsql.php'; 


if(isset($_GET['id'])){
$qry = $conn->query("SELECT mi.*,mi.name as Name  FROM moneyout mi inner join moneyout_des md on mi.id = md.money_id  where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
}
}
$fees = $conn->query("SELECT * FROM newemployee WHERE EmpID = '{$_SESSION['uid']}' ");
foreach($fees->fetch_array() as $k => $v){
  $$k= $v;
  $meta[$k] = $v;
}
?>
<div class="container-fluid">
    <form action="" id="manage-moneyout">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
        <div class="col-md-3 border-right ">
            <h5><b>Money Out Details</b></h5>
            <hr>
            <div id="msg" class="form-group"></div>
            <div class="form-group">
                <label for="" class="control-label">Name</label>        
              <input type="text" class="form-control" name="name"  value="<?php echo $FullName;?>" required="" readonly>
            </div>           
             <div class="form-group">
                <label for="" class="control-label">Day</label>
               <select name="day" id="day" class="custom-select input-sm select2 "  cols="30" rows="4" required="">
               <?php
               for($i = 0; $i <= 31; ++$i){

                $time = strtotime(sprintf('+%d days',$i));
                $day_valye=date('d',$time);
                $days=date('d',$time);
                printf('<option class="text-center" value="%s">%s</option>',$day_valye,$days);
               }

               ?>
               <option selected="" value="<?php echo isset ($day)? $day :'' ?>"><?php echo isset ($day)? $day :'' ?></option>


               </select>
            </div>           
         <div class="form-group">
            <label for="" class="control-label">Month</label>
               <select name="month" id="month" class="custom-select input-sm select2" required="">
               <?php
               for($i = 0; $i <= 12; ++$i){

                $time = strtotime(sprintf('--%d months',$i));
                $monthValue=date('F',$time);
                $monthname=date('F',$time);
                printf('<option selected value="%s">%s</option>',$monthValue,$monthname);
               }
               ?>
                <option selected="" value="<?php echo isset ($month)? $month :'' ?>"><?php echo isset ($month)? $month :'' ?></option>
               </select>
            </div>           
         <div class="form-group">
            <label for="" class="control-label">Year</label>
               <select name="year" id="year" class="custom-select input-sm select2"   required="">
               <?php $y=(int)date("Y"); ?>

               <option value="<?php echo $y; ?>" selected="true"><?php echo $y; ?></option>
               <?php $y--;
               for(; $y>"2019"; $y--){ ?>
                <option value="<?php echo $y; ?>"><?php echo $y; ?> </option>

            <?php } ?>        

               <option selected="" value="<?php echo isset ($year)? $year :'' ?>"><?php echo isset ($year)? $year :'' ?></option>
               </select>
            </div>           
           </div>

            <br/>   
            <div class="col-md-2 border-right">        
            <h6><b> Description and Amount</b></h6>
             <hr> 
                   
                    <div class="form-group">
                    <label for="subj" class="control-label">Description</label>
                    <input type="text" id="description1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Amount</label>
                    <input type="number" step="any" min="0" id="amount1" class="form-control">
                </div>                     
               
              
                 <div class="form-group pt-1">
                    <label for="" class="control-label">&nbsp;</label>
                    <button class="btn btn-primary btn-sm" type="button" id="add_moneyout">Add to List</button>
                </div>
          </div>
               
           
            
            <div class="col-lg-6">
            <table class="table table-condensed" id="amount-list">
                <thead>
                    <tr>
                        <th width="5%"></th>
                        <th style="padding-right: 60px;">Description</th>
                        <th style="padding-left: 60px;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($id)):
                        $fees = $conn->query("SELECT * FROM moneyout_des where  money_id= $id");
                        $total = 0;
                        while($row=$fees->fetch_assoc()): 
                            $total += $row['amount'];
                    ?>
                        <tr>
                            <td  class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                            <td>
                                <input type="hidden" name="did[]" value="<?php echo $row['did'] ?>">
                                <input type="hidden" name="description[]" value="<?php echo $row['description'] ?>">
                                <p ><small><b class="textdecription"><?php echo $row['description'] ?></b></small></p>
                            </td>
                            <td class="text-center">
                                <input type="hidden" name="amount[]" value="<?php echo $row['amount'] ?>">
                                <p class="text-right"><b class="textamount"><?php echo number_format($row['amount']) ?></b></p>
                            </td>
                        </tr>
                    <?php
                        endwhile; 
                        endif; 
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center">Total</th>
                        <th class="text-right">
                            <input type="hidden" name="total_amount" value="<?php echo isset($total) ? $total : 0 ?>">
                            <span class="tamount"><?php echo isset($total) ? number_format($total,2) : '0.00' ?></span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    

 </div>
</div>
<div id="moneyout_clone" style="display: none">
     <table >
            <tr>
                <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                <td>
                    <input type="hidden" name="did[]">
                    <input type="hidden" name="description[]">
                    <p><small><b class="textdecription"></b></small></p>
                </td>
                <td>
                    <input type="hidden" name="amount[]">
                    <p class="text-right"><small><b class="textamount"></b></small></p>
                </td>                
            </tr>
    </table>
</div>


<div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit" form="manage-moneyout"><i class="fas fa-thumbs-up"></i>&nbsp;&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i>&nbsp;&nbsp;Cancel</button>
      </div>
              

<script>
    $('#manage-moneyout').on('reset',function(){
        $('#msg').html('')
        $('input:hidden').val('')
    })

   

    $('#add_moneyout').click(function(){
        var dec = $('#description1').val()
        var amo = $('#amount1').val()
        
        if( dec == '' || amo == ''){
            alert_toast("Please fill the Subject and Scores first.",'warning')
            return false;
        }
        var tr = $('#moneyout_clone tr').clone()
        tr.find('[name="description[]"]').val(dec)
        tr.find('.textdecription').text(dec)
        tr.find('[name="amount[]"]').val(amo)
        tr.find('.textamount').text(parseFloat(amo).toLocaleString('en-US'))
        



        $('#amount-list tbody').append(tr)
        $('#description1').val('').focus()
        $('#amount1').val('')        
        calculate_total()
      
    })
    function calculate_total(){
        var total = 0;
        $('#amount-list tbody').find('[name="amount[]"]').each(function(){
            total += parseFloat($(this).val())
        })
        $('#amount-list tfoot').find('.tamount').text(parseFloat(total).toLocaleString('en-US'))
        $('#amount-list tfoot').find('[name="total_amount"]').val(total)

    }

    

    function rem_list(_this){
        _this.closest('tr').remove()
        calculate_total()
        
    }
     $(document).on('submit', '#manage-moneyout', function(e) {
    //$('#manage-moneyout').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')
        if($('#amount-list tbody').find('[name="did[]"]').length <= 0){
            alert_toast("Please insert atleast 1 row in the fees table",'danger')
            end_load()
            return false;
        }
        $.ajax({
            url:'easoftfun.php?action=save_moneyout',
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

    // $('.select2').select2({
    //     placeholder:"Please Select here",
    //     width:'100%'
    // })
</script>
