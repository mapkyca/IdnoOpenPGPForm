<?php

    namespace IdnoPlugins\OpenPGPForm {
        class Main extends \Idno\Common\Plugin {
	    
	    /**
	     * Pass data through to gnupg (TODO: do this better)
	     * @param type $data
	     */
	    private function decrypt($data) {
		$gpg = \Idno\Core\site()->config()->opengpg_gnupg ? \Idno\Core\site()->config()->opengpg_gnupg : '/usr/bin/gpg';
		
		$command = "echo ". escapeshellarg($data) . " | $gpg --trust-model always --batch --yes -d";
		
		ob_start();
		$return = "";
		passthru($command, $return);
		$result = ob_get_clean();
		
		if ($return == 0) {
		    return $result;
		}
		
		return false;
	    }
	    
            function registerPages() {
		
		
		// Add OpenPGP JS and jquery form
		\Idno\Core\site()->template()->extendTemplate('shell/footer','openpgpform/footer');
		
		
		
		// If there's an encrypted payload, decrypt it and declare variables.
		try {
		    if (isset($_REQUEST['__encrypted_form_data'])) { // TODO: Do this properly!

			$decrypted = $this->decrypt($_REQUEST['__encrypted_form_data']);
			if (!$decrypted) throw new \Exception("There was a problem decrypting payload, check your logs and make sure the keyring is accessible to your web server user.");

			parse_str($decrypted, $output);
			if ((!$output) || (!is_array($output)))
			    throw new Exception("Problem parsing decrypted payload.");

			// Add the encrypted payload
			foreach ($output as $key => $value) {
			    \Idno\Core\site()->currentPage()->setInput($key, $value);
			}

		    }
		} catch (\Exception $e) {
		    \Idno\Core\site()->session()->addMessage($e->getMessage(), 'alert-danger');
		}
            }
        }
    }
