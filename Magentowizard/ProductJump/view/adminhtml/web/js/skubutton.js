require(
    [
        'jquery',
        'mage/translate',
    ],
    function ($) {
    	$(document).ready(function(url){
    		$('#jump-sku').replaceWith("<input id='jump-sku' type='text' value='Enter *id or sku'>");
    		$('#jump-sku').click(function(){
    			$('#jump-sku').val('');
    		})
            $("#jump-sku").on('keyup', function (e) {
                if (e.keyCode === 13) {
                  var skuid = $('#jump-sku').val();
                  window.location = "/productjump/index/index?skuid="+skuid;  
                }
            })
    		$('#jump-button').click(function(){
    			var skuid = $('#jump-sku').val();
    			window.location = "/productjump/index/index?skuid="+skuid;
    		})
	     });

    }
);