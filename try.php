<?php
include("head.php");
//include("../pdf/studentform.php");

//echo str_replace("world","Peter","Hello world!");


/*
$people = array("Peter", "Joe", "Glenn", "Cleveland");

if (in_array("Joe", $people))
  {
  echo "Match found";
  }
else
  {
  echo "Match not found";
  }

*/
/*
$data = "";
$a = "Original";
$my_array = array("a" => "Cat","b" => "1", "c" => "Horse");
extract($my_array);
foreach($my_array as $k => $v){
  if(!in_array($k, array('')) && !is_numeric($k)){    

if(empty($data)){
$data .= " $k='$v' ";
}else
{
  $data .= " $k='$v' ";
}

echo "$data";
}
}*/








?>


<!-- Modal -->

  <div class="col-lg-12">
    <div class="row mb-4 mt-4">
      <div class="col-md-12">
        
      </div>
    </div>
    <div class="row">
      <!-- FORM Panel -->

      <!-- Table Panel -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-success text-white">            
            <b>List of Class </b>
          <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_fees">
          <i class="fa fa-plus"></i> New 
        </a></span>

          </div>
          <div class="card-body">
            <table id="mytable" class="table table-condensed table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="">Product no</th>
                  <th class="">Product Name</th>
                 
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 1;
                $student = $conn->query("SELECT * FROM products");
                while($row=$student->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                  <td class="text-center"><?php echo $i++ ?></td>
                  <td>
                    <p> <b><?php echo $row['product_no']?></b></p>
                  </td>
                  <td class="">
                     <p><small><i><b><?php echo $row['product_name'] ?></i></small></p>
                  </td>
                 
                  <td class="text-center">                    
                  <button class="btn btn-sm btn-outline-primary edit_class" type="button" data-id="<?php echo $row['classID'] ?>" >Edit</button>
                    <button class="btn btn-sm btn-outline-danger delete_class" type="button" data-id="<?php echo $row['classID'] ?>" >Delete</button>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Table Panel -->
    </div>
  </div>  

</div>


</div>


<script type="text/javascript">
$(document).ready(function(){
    $('table').dataTable()
  })

$('#mytable').ddTableFilter();

$('#new_fees').click(function(){
    uni_modal("Add New Class","manage_class.php","mid-large")
    
  })

$('.edit_class').click(function(){
    uni_modal("Update the Class","manage_class.php?classID="+$(this).attr('data-id'),'large')
    
  })
$('.delete_class').click(function(){
    _conf("Are you sure to delete this course?","delete_class",[$(this).attr('data-id')])
  })


function delete_class($classID){
    start_load()
    $.ajax({
      url:'easoft.php?action=delete_class',
      method:'POST',
      data:{classID:$classID},
      success:function(resp){
        if(resp==1){
          alert_toast("Data successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
















/*$("#save").click(function(){
  $.ajax({
   url:"../connection/newclasscon.php",
   type:"POST",
   data:$("#formm").serialize(),
 
 success:function(resp)
              //  if(resp==1)
              {
                    alert(resp)
                  
                        setTimeout(function(){
                          location.reload()
                        },1000)

                }
           // }
});
});

*/


</script>