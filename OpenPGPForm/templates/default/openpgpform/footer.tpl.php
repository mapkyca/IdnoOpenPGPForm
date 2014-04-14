<?php 
if ((\Idno\Core\site()->config()->openpgpPublicKey) && (\Idno\Core\site()->plugins->get('OpenPGPJS'))) {
    ?>
<script>
    $(document).ready(function() {
	$('form').submit(function(event) {
	    
	    var serialized = $(this).serialize();
	    var openpgp = window.openpgp;
	    
	    var publickey = openpgp.key.readArmored("<?= str_replace("\n","\\n\"+\"", \Idno\Core\site()->config()->openpgpPublicKey);?>");
	    var pgpMessage = openpgp.encryptMessage(publickey.keys, serialized);
	    
	    $(this).html("<textarea name=\"__encrypted_form_data\" style=\"display: none;\">" + pgpMessage + "</textarea>");
	    
	});
    });
</script>
<?php
} else { ?>
<!-- OpenPGPForm: Public key for server not available. Please set openpgpPublicKey in your config.ini -->
<?php } ?>
