<?php

    namespace IdnoPlugins\OpenPGPForm {
        class Main extends \Idno\Common\Plugin {
            function registerPages() {
		
		
		// Add OpenPGP JS and jquery form
		\Idno\Core\site()->template()->extendTemplate('shell/footer','openpgpform/footer');
		
		
		
		// If there's an encrypted payload, decrypt it and declare variables.
                if (isset($_REQUEST['__encrypted_form_data'])) { // TODO: Do this properly!
		    
		    
		    // TODO: Decrypt or error && unserialize && declare variables.
		    
		    
                }
            }
        }
    }
