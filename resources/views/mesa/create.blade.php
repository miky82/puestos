<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title" id="modalTitle">Crear Mesa</h4>
	    </div>
	    <div class="modal-body">
      			<div class="row">
      				<div class="col-md-12">
      					<h4>uuuu:</h4>
      				</div>
      				<div class="col-md-12">
      					<div class="table-responsive">
      					<input type="text" name="nombremesa">
      					</div>
      				</div>
      			</div>
      		
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-primary no-print" 
	        aria-label="Print" 
	          onclick="$(this).closest('div.modal').printThis();">
	        <i class="fa fa-print"></i> @lang( 'messages.print' )
	      </button>
	      	<button type="button" class="btn btn-default no-print" data-dismiss="modal">@lang( 'messages.close' )</button>
	    </div>
	</div>
</div>
<!--
<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>
-->