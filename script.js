 $(document).ready(function(){
$('#add_fee').click(function(){

  var name = $('#multtotal').val()
  //alert (name);
 var tr = $("#fee_clone tr").clone()
  tr.find('[name="name[]"]').val(name)
        tr.find('.proname').text(name)


         $('#table2 tbody').append(tr)
        $('#name').val('').focus()

 GrandTotal();
calculate_total2();
//var tr = $("#multtotal").clone().appendTo(".proname");
//var tr = 
//$("#fee_clone tr").clone().appendTo(".proname");
//$("#multtotal").clone().appendTo(".proname");
/*$("button").click(function(){
    $("p").clone().appendTo("body");
  });*/

  
 //var tr = $('#fee_clone').clone()
            // tr.find('[name="name[]"]').val(name)
            // tr.find('.proname').text(name)
            // alert (name);
        // var hes = $('#nameclone').val(name);

          // console.log(hes);
//$('#proname').clone().appendTo(hes);
});

});







 function loadproducts(){
  var name = $("#search").val();
  if(name){
    $.ajax({
      type: 'post',
      data: {
        products:name,
      },
      url: 'loadproducts.php',
      success: function (Response){
        $('#products').html(Response);
      }
    });
  }
};

/*customer search*/

$(document).ready(function(){

  $('#customer_search').typeahead({

    source: function(query, result)
    {

        $.ajax({
          url: 'loadcustomer.php',
          method: "POST",
          data:{
            query:query
          },
          dataType: "json",
          success:function(data)
          {
            result($.map(data,function(item){
              return item;
            }));
          }
        })
    }
  });
});

 function calculate_total2(){
        var total2 = 0;
        $('.mult').find('[name="multtotal[]"]').each(function(){
            total2 += parseFloat($(this).val())
             //alert (total2);
        })
        $('.mult').find('.tscore2').text(parseFloat(total2).toLocaleString('en-US'))
        $('.mult').find('[name="multtota2"]').val(total2)


    }

function GrandTotal(){
  var TotalValue = 0;
  var TotalPriceArr = $('#fee_clone tr .totalPrice').get()
  var discount = $('#discount').val();
alert (TotalPriceArr);
  $(TotalPriceArr).each(function(){
    TotalValue += parseFloat($(this).text().replace(/,/g, "").replace("Ghc",""));
  });

  if(discount != null){
    var f_discount = 0;

    f_discount = TotalValue - discount;

    $(".multtot").text(accounting.formatMoney(f_discount,{symbol:"Ghc",format: "%s %v"}));
    $(".totalValue1").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }else{
    $(".multtot").text(accounting.formatMoney(TotalValue,{symbol:"Ghc",format: "%s %v"}));
    $(".tscore2").text(accounting.formatMoney(TotalValue,{format: "%v"}));
  }
};

$(document).on('change', '#discount', function(){
  GrandTotal();
});




$('body').on('click','.js-add',function(){
      var totalPrice = 0;
      var target = $(this);
      var barcode = target.attr('data-barcode[]');
       var product = target.attr('data-product[]');
     // var product = target.attr('data-product');
      var price = target.attr('data-price[]');      
      var unit = target.attr('data-unt[]'); 

      swal({
        title: "Enter number of items:",
        content: "input",
      })
      .then((value) => {
        if (value == "") {
          swal("Error","You Did Not Enter Item Qty !","error");
        }else{
          var qtynum = value;
          if (isNaN(qtynum)){
            swal("Error","Please enter a valid number !","error");
          }else if(qtynum == null){
            swal("Error","Please Stop Double Clicking !","error");
          }else{
            var total = parseInt(value,10) * parseFloat(price);


            //order table copy#
             $('input:hidden').val('')
            
          /* var tr = $("#fee_clone tr").clone()
           tr.find('[name="product[]"]').val(product)
*/



            var tr = $("#fee_clone tr ").clone()
           tr.find('[name="product[]"]').val(product)
            tr.find('.proproduct').text(product)
           
            tr.find('[name="barcode[]"]').val(barcode)
            tr.find('.probarcode').text(barcode)

            tr.find('[name="price[]"]').val(accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"}))
            tr.find('.proprice').text(accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"}))

             tr.find('[name="unit[]"]').val(unit)
            tr.find('.prounit').text(unit)

              tr.find('[name="qty[]"]').val(value)
            tr.find('.proqty').text(value)

            tr.find('[name="subtotal[]"]').val(accounting.formatMoney(total,{symbol:"Ghc",format: "%s %v"}))
            tr.find('.prosubtotal').text(accounting.formatMoney(total,{symbol:"Ghc",format: "%s %v"}))



         $('#table2 tbody').append(tr)
        $('#name').val('').focus()




           /* var tr = $('#fee_clone').clone()
             tr.find('[name="name[]"]').val(name)
             tr.find('.proname').text(name)
            // alert (name);
         var hes = $('#nameclone').val(name);

           console.log(hes);
           $('#proname').clone().appendTo(hes);*/

          // $('#tableData').append("<tr class='prd'><td class='barcode text-center'>"+barcode+"</td><td class='text-center'>"+product+"</td><td class='price text-center'>"+accounting.formatMoney(price,{symbol:"Ghc",format: "%s %v"})+"</td><td class='text-center'>"+unit+"</td><td class='qty text-center'>"+value+"</td><td class='totalPrice text-center'>"+accounting.formatMoney(total,{symbol:"Ghc",format: "%s %v"})+"</td><td class='text-center p-1'><button class='btn btn-danger btn-sm' type='button' id='delete-row'><i class='fas fa-times-circle'></i></button><tr>");
           calculate_total2()
            GrandTotal();

        }
      }
  });
});

 function rem_list(_this){
        _this.closest('tr').remove()
       
    }




//remove of items
$("body").on('click','#deletee', function(){
    var target = $(this);
    swal({
      title: "Are You Sure To Remove This Item?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $(this).parents("tr").remove();
        swal("Removed Successfully!", {
          icon: "success",
        });
          GrandTotal();
      }
  });
});

$(document).on('click','.Enter',function(){

  var TotalPriceArr = $('#tableData tr .totalPrice').get();
 
  if($.trim($('#customer_search').val()).length == 0){
      swal("Warning","Please Enter Customer Name!","warning");
      return false;
    }

  if (TotalPriceArr == 0){
    swal("Warning","No products ordered!","warning");
    return false; 
  }else{

    var product = [];
    var quantity = [];
    var price = [];
    var user = $('#user').val();
    var customer = $('#customer_search').val();
    var discount = $('#discount').val();

    $('.barcode').each(function(){
    product.push($(this).text());
    });
    $('.qty').each(function(){
      quantity.push($(this).text());
    });
    $('.price').each(function(){
      price.push($(this).text().replace(/,/g, "").replace("Ghc",""));
    });

    swal({
      title: "Enter Cash",
      content: "input",
    })
    .then((value) => {  
      if(value == "") {
        swal("Error","Entered None!","error");
      }else{

        var qtynum = value;
        if(isNaN(qtynum)){
          swal("Error","Please enter a valid number!","error");
        }else if(qtynum == null){
          swal("Error","Entered None!","error");
        }else{

          var change = 0;
        
          var TotalValue = parseFloat($('#totalValue').text().replace(/,/g, "").replace("Ghc",""));

          if(TotalValue > qtynum){
            swal("Error","Can't process a smaller number","error");
          }else{            
            change = parseInt(value,10) - parseFloat(TotalValue);

            $.ajax({
              url:"insert_sales.php",
              method:"POST",
              data:{totalvalue:TotalValue, product:product, price:price, user:user, customer:customer, quantity:quantity, discount:discount},
              success: function(data){                
                           
                if(data.status = "success"){                 
                  swal({
                    title: "Change is " + accounting.formatMoney(change,{symbol:"Ghc",format: "%s %v"}),
                    icon: "success",
                    buttons: "Okay",
                  })
                  .then((okay)=>{ 
                    if(okay){
                     window.location.href='mainpa.php';
                    }
                  })
                }else{
                window.location.href='mainpa.php?'+data;
                }
                
              }
            });
          }
        }
      }
    });
  }
});

$(document).on('click','.cancel',function(e){
  var TotalPriceArr = $('#tableData tr .totalPrice').get();
  if (TotalPriceArr == 0){
    return 0;
  }else{
    swal({
      title: "Cancel orders?",
      text: "By doing this,orders will remove!",
      icon: "warning",
      buttons: ["No","Yes"],
      dangerMode: true,
    })
    .then((reload) => {
      if (reload) {
        location.reload();
      }
    });
  }
});

$('#new_course').click(function(){
    uni_modal("New Customer","customer.php",'small')
    
  })
