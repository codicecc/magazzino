$(function(){
	var totalquantity=0;
	var optionTotalAll=2000;
	var options = $("#form_quantity");
	$( "#form_code_id" )
  .change(function () {
  	$( "#result0" ).text( "---" );
  	var val = 0;
    $( "#form_code_id option:selected" ).each(function() {
      val = $( this ).val() + " ";
    });
    $.get( "/quantity/quantity?code_id="+val, function( data ) {
    		totalquantity=data;
    		$( "#result0" ).text( totalquantity );
    		$("#form_quantity_less").prop("checked",false);
    });
    populate(options,optionTotalAll);
  })
  .change();
  $("#form_quantity_less").on('change',(function () {
  	optionAll=optionTotalAll;
  	if ($(this).attr("checked")){
    	optionAll=totalquantity;
    }
    populate(options,optionAll);
  	})
  ); 
  function populate(options,optionAll){
  	options.find('option').remove().end();
  	for(i=0;i<=optionAll;i++){options.append($("<option />").val(i).text(i));}
  }
});
