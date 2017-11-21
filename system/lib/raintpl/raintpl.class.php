<?php
/**
 *  RainTPL
 *  -------
 *  Realized by Federico Ulfo & maintained by the Rain Team
 *  Distributed under the MIT license http://www.opensource.org/licenses/mit-license.php
 *
 *  @version 2.7.2
 */
class RainTPL
{
    /**
     * Template directory
     *
     * @var string
     */
    static $tplDir = "tpl/";

    /**
     * Cache directory. Is the directory where RainTPL will compile the template and save the cache
     *
     * @var string
     */
    static $cacheDir = "tmp/";

    /**
     * Template base URL. RainTPL will add this URL to the relative paths of element selected in $pathReplaceList.
     *
     * @var string
     */
    static $baseUrl = null;

    /**
     * Template extension.
     *
     * @var string
     */
    static $tplExt = "html";

    /**
     * Path replace is a cool features that replace all relative paths of images (<img src="...">), stylesheet (<link href="...">), script (<script src="...">) and link (<a href="...">)
     * Set true to enable the path replace.
     *
     * @var unknown_type
     */
    static $pathReplace = true;

    /**
     * You can set what the pathReplace method will replace.
     * Avaible options: a, img, link, script, input
     *
     * @var array
     */
    static $pathReplaceList = array( 'a', 'img', 'link', 'script', 'input' );

    /**
     * You can define in the black list what string are disabled into the template tags
     *
     * @var unknown_type
     */
    static $blackList = array( '\$this', 'raintpl::', 'self::', '_SESSION', '_SERVER', '_ENV',  'eval', 'exec', 'unlink', 'rmdir' );

    /**
     * Check template.
     * true: checks template update time, if changed it compile them
     * false: loads the compiled template. Set false if server doesn't have write permission for cacheDirectory.
     *
     */
    static $checkTemplateUpdate = true;

    /**
     * PHP tags <? ?> 
     * True: php tags are enabled into the template
     * False: php tags are disabled into the template and rendered as html
     *
     * @var bool
     */
    static $phpEnabled = false;

    /**
     * Debug mode flag.
     * True: debug mode is used, syntax errors are displayed directly in template. Execution of script is not terminated.
     * False: exception is thrown on found error.
     *
     * @var bool
     */
    static $debug = false;

    /**
     * Path for the root directory
     *
     * @var string
     */
    static $rootDir = '';

    /**
     * Is the array where RainTPL keep the variables assigned
     *
     * @var array
     */
    public $var = array();

    protected $tpl     = array();    // variables to keep the template directories and info
    protected $cache   = false;      // static cache enabled / disabled
    protected $cacheID = null;       // identify only one cache

    protected static $configNameSum = array();   // takes all the config to create the md5 of the file

    // -------------------------

    const CACHE_EXPIRE_TIME = 3600; // default cache expire time = hour
    const PHP_START         = '<?php'; // default cache expire time = hour
    const PHP_END           = '?>'; // default cache expire time = hour

    /**
     * Assign variable
     * eg. 	$t->assign('name', 'mickey');
     *
     * @param mixed $variable_name Name of template variable or associative array name/value
     * @param mixed $value value assigned to this variable. Not set if variable_name is an associative array
     */
    public function assign( $variable, $value = null )
    {
        if(is_array( $variable ))
        {
            $this->var = $variable + $this->var;
        }
        else
        {
            $this->var[ $variable ] = $value;
        }
    }

    /**
     * Draw the template
     * eg. 	$html = $tpl->draw( 'demo', TRUE ); // return template in string
     * or 	$tpl->draw( $tplName );             // echo the template
     *
     * @param string $tpl_name  template to load
     * @param boolean $return_string  true=return a string, false=echo the template
     * @return string
     */
    function draw($tplName, $returnString = false)
    {
        try 
        {
            $this->compileFile($tplName);
        }
        catch(RainTpl_Exception $e) 
        {
            die($this->printDebug($e));
        }

        if(!$this->cache && !$returnString)
		{
            extract($this->var);
            include $this->tpl['compiledFile'];
            unset($this->tpl);
        }
        else
		{
			ob_start();
			extract($this->var);
			include $this->tpl['compiledFile'];
			$contents = ob_get_clean();
            if($this->cache) file_put_contents($this->tpl['cacheFile'], "<?php if(!class_exists('raintpl')){exit;}" . self::PHP_END . $contents);
            unset($this->tpl);
            if($returnString) return trim($contents);
			echo $contents;
        }
    }

    /**
     * If exists a valid cache for this template it returns the cache
     *
     * @param string $tpl_name Name of template (set the same of draw)
     * @param int $expiration_time Set after how many seconds the cache expire and must be regenerated
     * @return string it return the HTML or null if the cache must be recreated
     */
    function cache($tplName, $expireTime = self::CACHE_EXPIRE_TIME, $cacheID = null)
    {
        /* Set the cacheID. */
        $this->cacheID = $cacheID;

        if( !$this->check_template($tplName) && file_exists($this->tpl['cacheFile']) && ( time() - filemtime($this->tpl['cacheFile']) < $expireTime) )
		{
            /* return the cached file as HTML. It remove the first 43 character, which are a PHP code to secure the file <?php if(!class_exists('raintpl')){exit;}? >*/
            return substr(file_get_contents( $this->tpl['cacheFile'] ), 43);
        }
        else
		{
            /* Delete the cache of the selected template. */
            if(file_exists($this->tpl['cacheFile'])) unlink($this->tpl['cacheFile'] );
            $this->cache = true;
        }
    }

    /**
     * Configure the settings of RainTPL
     * 
     * @param  array|function    $setting 
     * @param  mix               $value 
     * @static
     * @access public
     * @return void
     */
    static function configure($setting, $value = null)
    {
        if(is_array($setting))
        {
            foreach($setting as $key => $value) self::configure( $key, $value );
        }
        elseif(property_exists( __CLASS__, $setting ))
        {
            self::$$setting = $value;
            self::$configNameSum[$setting] = $value; // take trace of all config
        }
    }

    /**
     * Prepare compile params.
     * 
     * @param  string    $tplName 
     * @access public
     * @return array
     */
    public function prepareCompile($tplName)
    {
        if(!isset($this->tpl['checked']))
        {
            $tplBasename = basename( $tplName );                                               // template basename
            $tplBasedir  = (strpos($tplName, "/") !== false) ? dirname($tplName) . '/' : null; // template basedirectory

            $this->tpl['templateDir'] = self::$tplDir . $tplBasedir;
            if(strpos($tplName, "/") === 0) $this->tpl['templateDir'] = dirname($tplName) . DS;

            $this->tpl['tplFile']      = self::$rootDir . $this->tpl['templateDir'] . $tplBasename . '.' . self::$tplExt;    // template file name
            $tempCmpiledFile           = self::$rootDir . self::$cacheDir . $tplBasename . "." . md5( $this->tpl['templateDir'] . serialize(self::$configNameSum));
            $this->tpl['compiledFile'] = $tempCmpiledFile . '.rtpl.php';	// cache file name
            $this->tpl['cacheFile']    = $tempCmpiledFile . '.s_' . $this->cacheID . '.rtpl.php';	// static cache filename
            $this->tpl['checked']      = true;

            /* If tplFile is not exists append extension to it. */
            if(!file_exists($this->tpl['tplFile'])) $this->tpl['tplFile'] = dirname($this->tpl['tplFile']) . DS . basename($this->tpl['tplFile'], "." . self::$tplExt);

            /* If the template doesn't exist and is not an external source throw an error. */
            if( self::$checkTemplateUpdate && !file_exists( $this->tpl['tplFile'] ) && !preg_match('/http/', $tplName) )
            {
                $e = new RainTpl_NotFoundException( "Template $tplBasename not found!" );
                throw $e->setTemplateFile($this->tpl['tplFile']);
            }

            $compileSetting = array();
            if(preg_match('/http/', $tplName))
            {
                /* We check if the template is not an external source. */
                $compileSetting['baseName']     = '';
                $compileSetting['baseDir']      = '';
                $compileSetting['tplFile']      = $tplName;
                $compileSetting['cacheDir']     = self::$cacheDir;
                $compileSetting['compiledFile'] = $this->tpl['compiledFile'];

            }
            elseif( !file_exists($this->tpl['compiledFile']) || (self::$checkTemplateUpdate && filemtime($this->tpl['compiledFile']) < filemtime($this->tpl['tplFile'])) )
            {
                /* file doesn't exist, or the template was updated, Rain will compile the template. */
                $compileSetting['baseName']     = $tpl_basename;
                $compileSetting['baseDir']      = $tplBasedir;
                $compileSetting['tplFile']      = $this->tpl['tplFile'];
                $compileSetting['cacheDir']     = self::$rootDir . self::$cacheDir;
                $compileSetting['compiledFile'] = $this->tpl['compiledFile'];
            }
            return $compileSetting;
        }

        return false;
    }

    /**
     * Compile and write the compiled template file.
     * 
     * @param  string    $tplName 
     * @access protected
     * @return void
     */
    protected function compileFile($tplName)
    {
        $compileSetting = $this->prepareCompile($tplName);
        if(!$compileSetting) return true;
        extract($compileSetting);

        /* Read template file. */
        $this->tpl['source'] = $templateCode = file_get_contents($tplFile);

        /* Xml substitution. */
        $templateCode = preg_replace("/<\?xml(.*?)" . "\?" . ">/s", "##XML\\1XML##", $templateCode);

        /* Disable php tag. */
        if(!self::$phpEnabled) $templateCode = str_replace(array("<?", PHP_END), array("&lt;?","?&gt;"), $templateCode);

        /* Xml re-substitution. */
        $templateCode = preg_replace_callback ("/##XML(.*?)XML##/s", array($this, 'xml_reSubstitution'), $templateCode); 

        /* Compile template. */
        $templateCompiled = self::PHP_START . " if(!class_exists('raintpl')){exit;}" . self::PHP_END . $this->compileTemplate($templateCode, $baseDir);

        /* Fix the php-eating-newline-after-closing-tag-problem. */
        $templateCompiled = str_replace(self::PHP_END . "\n", self::PHP_END . "\n\n", $templateCompiled);

        /* Create directories. */
        if(!is_dir($cacheDir)) mkdir($cacheDir, 0755, true);

        if(!is_writable($cacheDir)) throw new RainTpl_Exception('Cache directory ' . $cacheDir . 'doesn\'t have write permission. Set write permission or set RAINTPL_CHECK_TEMPLATE_UPDATE to false. More details on https://feulf.github.io/raintpl');

        /* Write compiled file. */
        file_put_contents($compiledFile, $templateCompiled);
    }

    /**
     * Compile template code.
     * 
     * @param  string    $templateCode 
     * @param  string    $tplBasedir 
     * @access protected
     * @return string
     */
    protected function compileTemplate($templateCode, $tplBasedir)
    {
        $tagPatterns = array();
        $tagPatterns['loop']          = '(\{loop(?: name){0,1}="\${0,1}[^"]*"\})';
        $tagPatterns['break']	      = '(\{break\})';
        $tagPatterns['continue']      = '(\{continue\})';
        $tagPatterns['loop_close']    = '(\{\/loop\})';
        $tagPatterns['if']            = '(\{if(?: condition){0,1}="[^"]*"\})';
        $tagPatterns['if']            = '(\{if\(.*\)\})';
        $tagPatterns['elseif']        = '(\{elseif(?: condition){0,1}="[^"]*"\})';
        $tagPatterns['elseif']        = '(\{elseif\(.*\)\})';
        $tagPatterns['else']          = '(\{else\})';
        $tagPatterns['if_close']      = '(\{\/if\})';
        $tagPatterns['function']      = '(\{function="[^"]*"\})';
        $tagPatterns['noparse']       = '(\{noparse\})';
        $tagPatterns['noparse_close'] = '(\{\/noparse\})';
        $tagPatterns['ignore']        = '(\{ignore\}|\{\*)';
        $tagPatterns['ignore_close']  = '(\{\/ignore\}|\*\})';
        $tagPatterns['include']       = '(\{include="[^"]*"(?: cache="[^"]*")?\})';
        $tagPatterns['template_info'] = '(\{\$template_info\})';
        $tagPatterns['function']      = '(\{function="(\w*?)(?:.*?)"\})';

        $tagRegexp = "/" . join( "|", $tagPatterns ) . "/";
        
        /* Path replace (src of img, background and href of link) . */
        $templateCode = $this->pathReplace( $templateCode, $tplBasedir );
        $templateCode = preg_split($tagRegexp, $templateCode, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $compiledCode = $this->compileCode($templateCode);

        return $compiledCode;
    }

    /**
     * Compile the code
     * 
     * @param  array     $parsedCode 
     * @access protected
     * @return string
	 */
    protected function compileCode($parsedCode)
    {
        if(!$parsedCode) return "";

        /* Variables initialization. */
        $compiledCode = $openIf = $commentIsOpen = $ignoreIsOpen = null;
        $loop_level   = 0;

        /* Ead all parsed code. */
        foreach($parsedCode as $html)
        {
            /* Close ignore tag. */
            if(!$commentIsOpen && (strpos($html, '{/ignore}') !== FALSE || strpos($html, '*}') !== FALSE)) 
            {
                $ignoreIsOpen = false;
            }
            elseif($ignoreIsOpen)
            {

            }
            elseif(strpos($html, '{/noparse}') !== FALSE)
            {
                $commentIsOpen = false;
            }
            elseif( $commentIsOpen )
            {
                $compiledCode .= $html;
            }
            elseif( strpos( $html, '{ignore}' ) !== FALSE || strpos( $html, '{*' ) !== FALSE )
            {
                $ignoreIsOpen = true;
            }
            elseif( strpos( $html, '{noparse}' ) !== FALSE )
            {
                $commentIsOpen = true;
            }
            elseif( preg_match( '/\{include="([^"]*)"(?: cache="([^"]*)"){0,1}\}/', $html, $code ) )
            {
                if(preg_match("/http/", $code[1]))
                {
                    $content = file_get_contents($code[1]);
                    $compiledCode .= $content;
                }
                else
                {
                    /* Variables substitution. */
                    $include_var = $this->var_replace( $code[ 1 ], $left_delimiter = null, $right_delimiter = null, $php_left_delimiter = '".' , $php_right_delimiter = '."', $loop_level );

                    /* Get the folder of the actual template. */
                    $actual_folder = substr( $this->tpl['templateDir'], strlen(self::$tplDir) );

                    /* Get the included template. */
                    $include_template = $actual_folder . $include_var;

                    /* Reduce the path. */
                    $include_template = $this->reduce_path( $include_template );

                    /* If the cache is active. */
                    if( isset($code[ 2 ]) )
                    {
                        $compiledCode .= '<?php $tpl = new '.get_called_class().';' .
                            'if( $cache = $tpl->cache( "'.$include_template.'" ) )' .
                            '	echo $cache;' .
                            'else{' .
                            '$tpl->assign( $this->var );' .
                            ( !$loop_level ? null : '$tpl->assign( "key", $key'.$loop_level.' ); $tpl->assign( "value", $value'.$loop_level.' );' ).
                            '$tpl->draw( "'.$include_template.'" );'. '}'
                            . self::PHP_END;

                    }
                    else
                    {
                        $compiledCode .= '<?php $tpl = new '.get_called_class().';' .
                            '$tpl->assign( $this->var );' .
                            ( !$loop_level ? null : '$tpl->assign( "key", $key'.$loop_level.' ); $tpl->assign( "value", $value'.$loop_level.' );' ).
                            '$tpl->draw( "'.$include_template.'" );'
                            . self::PHP_END;
                    }
                }
            }

            //loop
            elseif( preg_match( '/\{loop(?: name){0,1}="\${0,1}([^"]*)"\}/', $html, $code ) ){

                //increase the loop counter
                $loop_level++;

                //replace the variable in the loop
                $var = $this->var_replace( '$' . $code[ 1 ], $tag_left_delimiter=null, $tag_right_delimiter=null, $php_left_delimiter=null, $php_right_delimiter=null, $loop_level-1 );

                //loop variables
                $counter = "\$counter$loop_level";       // count iteration
                $key = "\$key$loop_level";               // key
                $value = "\$value$loop_level";           // value

                //loop code
                $compiledCode .=  "<?php $counter=-1; if( !is_null($var) && is_array($var) && sizeof($var) ) foreach( $var as $key => $value ){ $counter++; ?>";

            }

            // loop break
            elseif( strpos( $html, '{break}' ) !== FALSE ) {

                //else code
                $compiledCode .=   '<?php break; ?>';

            }

            // loop continue
            elseif( strpos( $html, '{continue}' ) !== FALSE ) {

                //else code
                $compiledCode .=   '<?php continue; ?>';

            }


            //close loop tag
            elseif( strpos( $html, '{/loop}' ) !== FALSE ) {

                //iterator
                $counter = "\$counter$loop_level";

                //decrease the loop counter
                $loop_level--;

                //close loop code
                $compiledCode .=  "<?php } ?>";

            }

            //if
            elseif( preg_match( '/\{if(?: condition){0,1}="([^"]*)"\}/', $html, $code ) ){

                //increase open if counter (for intendation)
                $openIf++;

                //tag
                $tag = $code[ 0 ];

                //condition attribute
                $condition = $code[ 1 ];

                // check if there's any function disabled by blackList
                $this->function_check( $tag );

                //variable substitution into condition (no delimiter into the condition)
                $parsed_condition = $this->var_replace( $condition, $tag_left_delimiter = null, $tag_right_delimiter = null, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level );

                //if code
                $compiledCode .=   "<?php if( $parsed_condition ){ ?>";

            }

            //short if
            elseif( preg_match( '/\{if\((.*)\)\}/', $html, $code ) ){

                //increase open if counter (for intendation)
                $openIf++;

                //tag
                $tag = $code[ 0 ];

                //condition attribute
                $condition = $code[ 1 ];

                // check if there's any function disabled by blackList
                $this->function_check( $tag );

                //variable substitution into condition (no delimiter into the condition)
                $parsed_condition = $this->var_replace( $condition, $tag_left_delimiter = null, $tag_right_delimiter = null, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level );

                //if code
                $compiledCode .=   "<?php if( $parsed_condition ){ ?>";

            }


            //elseif
            elseif( preg_match( '/\{elseif(?: condition){0,1}="([^"]*)"\}/', $html, $code ) ){

                //tag
                $tag = $code[ 0 ];

                //condition attribute
                $condition = $code[ 1 ];

                //variable substitution into condition (no delimiter into the condition)
                $parsed_condition = $this->var_replace( $condition, $tag_left_delimiter = null, $tag_right_delimiter = null, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level );

                //elseif code
                $compiledCode .=   "<?php }elseif( $parsed_condition ){ ?>";
            }

            //elseif short
            elseif( preg_match( '/\{elseif\(.*\)\}/', $html, $code ) ){

                //tag
                $tag = $code[ 0 ];

                //condition attribute
                $condition = $code[ 1 ];

                //variable substitution into condition (no delimiter into the condition)
                $parsed_condition = $this->var_replace( $condition, $tag_left_delimiter = null, $tag_right_delimiter = null, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level );

                //elseif code
                $compiledCode .=   "<?php }elseif( $parsed_condition ){ ?>";
            }


            //else
            elseif( strpos( $html, '{else}' ) !== FALSE ) {

                //else code
                $compiledCode .=   '<?php }else{ ?>';

            }

            //close if tag
            elseif( strpos( $html, '{/if}' ) !== FALSE ) {

                //decrease if counter
                $openIf--;

                // close if code
                $compiledCode .=   '<?php } ?>';

            }

            //function
            elseif( preg_match( '/\{function="(\w*)(.*?)"\}/', $html, $code ) ){

                //tag
                $tag = $code[ 0 ];

                //function
                $function = $code[ 1 ];

                // check if there's any function disabled by blackList
                $this->function_check( $tag );

                if( empty( $code[ 2 ] ) )
                    $parsed_function = $function . "()";
                else
                    // parse the function
                    $parsed_function = $function . $this->var_replace( $code[ 2 ], $tag_left_delimiter = null, $tag_right_delimiter = null, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level );

                //if code
                $compiledCode .=   "<?php echo $parsed_function; ?>";
            }

            // show all vars
            elseif ( strpos( $html, '{$template_info}' ) !== FALSE ) {

                //tag
                $tag  = '{$template_info}';

                //if code
                $compiledCode .=   '<?php echo "<pre>"; print_r( $this->var ); echo "</pre>"; ?>';
            }


            //all html code
            else{

                //variables substitution (es. {$title})
                $html = $this->var_replace( $html, $left_delimiter = '\{', $right_delimiter = '\}', $php_left_delimiter = '<?php ', $php_right_delimiter = ';?>', $loop_level, $echo = true );
                //const substitution (es. {#CONST#})
                $html = $this->const_replace( $html, $left_delimiter = '\{', $right_delimiter = '\}', $php_left_delimiter = '<?php ', $php_right_delimiter = ';?>', $loop_level, $echo = true );
                //functions substitution (es. {"string"|functions})
                $compiledCode .= $this->func_replace( $html, $left_delimiter = '\{', $right_delimiter = '\}', $php_left_delimiter = '<?php ', $php_right_delimiter = ';?>', $loop_level, $echo = true );
            }
        }

        if( $openIf > 0 ) {
            $e = new RainTpl_SyntaxException('Error! You need to close an {if} tag in ' . $this->tpl['tplFile'] . ' template');
            throw $e->setTemplateFile($this->tpl['tplFile']);
        }
        return $compiledCode;
    }

    /**
     * Execute stripslaches() on the xml block. Invoqued by preg_replace_callback function below
     *
     * @param  array      $capture 
     * @access protected
     * @return string
     */
    protected function xml_reSubstitution($capture)
    {
        return self::PHP_START . " echo '<?xml " . stripslashes($capture[1]) . self::PHP_END . self::PHP_END;
    } 
 

    /**
     * Reduce a path, eg. www/library/../filepath//file => www/filepath/file
     * @param type $path
     * @return type
     */
    protected function reduce_path( $path ){
        $path = str_replace( "://", "@not_replace@", $path );
        $path = preg_replace( "#(/+)#", "/", $path );
        $path = preg_replace( "#(/\./+)#", "/", $path );
        $path = str_replace( "@not_replace@", "://", $path );

        while( preg_match( '#\.\./#', $path ) ){
            $path = preg_replace('#\w+/\.\./#', '', $path );
        }
        return $path;
    }



    /**
     * Replace URL according to the following rules:
     * http://url => http://url
     * url# => url
     * /url => base_dir/url
     * url => path/url (where path generally is baseUrl/template_dir)
     * (The last one is => base_dir/url for <a> href)
     *
     * @param string $url Url to rewrite.
     * @param string $tag Tag in which the url has been found.
     * @param string $path Path to prepend to relative URLs.
     * @return string rewritten url
     */
    protected function rewrite_url( $url, $tag, $path ) {
        // If we don't have to rewrite for this tag, do nothing.
        if( !in_array( $tag, self::$pathReplaceList ) ) {
            return $url;
        }

        // Make protocol list. It is a little bit different for <a>.
        $protocol = 'http|https|ftp|file|apt|magnet';
        if ( $tag == 'a' ) {
            $protocol .= '|mailto|javascript';
        }

        // Regex for URLs that should not change (except the leading #)
        $no_change = "/(^($protocol)\:)|(#$)/i";
        if ( preg_match( $no_change, $url ) ) {
            return rtrim( $url, '#' );
        }

        // Regex for URLs that need only base url (and not template dir)
        $base_only = '/^\//';
        if ( $tag == 'a' or $tag == 'form' ) {
            $base_only = '//';
        }
        if ( preg_match( $base_only, $url ) ) {
            return rtrim( self::$baseUrl, '/' ) . '/' . ltrim( $url, '/' );
        }

        // Other URLs
        return $path . $url;
    }

    /**
     * replace one single path corresponding to a given match in the `pathReplace` regex.
     * This function has no reason to be used anywhere but in `pathReplace`.
     * @see pathReplace
     *
     * @param array $matches
     * @return replacement string
     */
    protected function single_pathReplace ( $matches ){
        $tag  = $matches[1];
        $_    = $matches[2];
        $attr = $matches[3];
        $url  = $matches[4];
        $new_url = $this->rewrite_url( $url, $tag, $this->path );

        return "<$tag$_$attr=\"$new_url\"";
    }



    /**
     * replace the path of image src, link href and a href.
     * @see rewrite_url for more information about how paths are replaced.
     *
     * @param string $html
     * @return string html sostituito
     */
    protected function pathReplace($html, $tplBasedir)
    {

        if(self::$pathReplace)
        {
            $tplDir = self::$baseUrl . self::$tplDir . $tplBasedir;

            // Prepare reduced path not to compute it for each link
            $this->path = $this->reduce_path( $tplDir );

            $url = '(?:(?:\\{.*?\\})?[^{}]*?)*?'; // allow " inside {} for cases in which url contains {function="foo()"}

            $exp = array();

            $tags = array_intersect( array( "link", "a" ), self::$pathReplaceList );
            $exp[] = '/<(' . join( '|', $tags ) . ')(.*?)(href)="(' . $url . ')"/i';

            $tags = array_intersect( array( "img", "script", "input" ), self::$pathReplaceList );
            $exp[] = '/<(' . join( '|', $tags ) . ')(.*?)(src)="(' . $url . ')"/i';

            $tags = array_intersect( array( "form" ), self::$pathReplaceList );
            $exp[] = '/<(' . join( '|', $tags ) . ')(.*?)(action)="(' . $url . ')"/i';

            return preg_replace_callback( $exp, 'self::single_pathReplace', $html );
        }
        return $html;

    }



    // replace const
    function const_replace( $html, $tag_left_delimiter, $tag_right_delimiter, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level = null, $echo = null ){
        // const
        return preg_replace( '/\{\#(\w+)\#{0,1}\}/', $php_left_delimiter . ( $echo ? " echo " : null ) . '\\1' . $php_right_delimiter, $html );
    }



    // replace functions/modifiers on constants and strings
    function func_replace( $html, $tag_left_delimiter, $tag_right_delimiter, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level = null, $echo = null ){

        preg_match_all( '/' . '\{\#{0,1}(\"{0,1}.*?\"{0,1})(\|\w.*?)\#{0,1}\}' . '/', $html, $matches );

        for( $i=0, $n=count($matches[0]); $i<$n; $i++ ){

            //complete tag ex: {$news.title|substr:0,100}
            $tag = $matches[ 0 ][ $i ];

            //variable name ex: news.title
            $var = $matches[ 1 ][ $i ];

            //function and parameters associate to the variable ex: substr:0,100
            $extra_var = $matches[ 2 ][ $i ];

            // check if there's any function disabled by blackList
            $this->function_check( $tag );

            $extra_var = $this->var_replace( $extra_var, null, null, null, null, $loop_level );


            // check if there's an operator = in the variable tags, if there's this is an initialization so it will not output any value
            $is_init_variable = preg_match( "/^(\s*?)\=[^=](.*?)$/", $extra_var );

            //function associate to variable
            $function_var = ( $extra_var and $extra_var[0] == '|') ? substr( $extra_var, 1 ) : null;

            //variable path split array (ex. $news.title o $news[title]) or object (ex. $news->title)
            $temp = preg_split( "/\.|\[|\-\>/", $var );

            //variable name
            $var_name = $temp[ 0 ];

            //variable path
            $variable_path = substr( $var, strlen( $var_name ) );

            //parentesis transform [ e ] in [" e in "]
            $variable_path = str_replace( '[', '["', $variable_path );
            $variable_path = str_replace( ']', '"]', $variable_path );

            //transform .$variable in ["$variable"]
            $variable_path = preg_replace('/\.\$(\w+)/', '["$\\1"]', $variable_path );

            //transform [variable] in ["variable"]
            $variable_path = preg_replace('/\.(\w+)/', '["\\1"]', $variable_path );

            //if there's a function
            if( $function_var ){

                // check if there's a function or a static method and separate, function by parameters
                $function_var = str_replace("::", "@double_dot@", $function_var );

                // get the position of the first :
                if( $dot_position = strpos( $function_var, ":" ) ){

                    // get the function and the parameters
                    $function = substr( $function_var, 0, $dot_position );
                    $params = substr( $function_var, $dot_position+1 );

                }
                else{

                    //get the function
                    $function = str_replace( "@double_dot@", "::", $function_var );
                    $params = null;

                }

                // replace back the @double_dot@ with ::
                $function = str_replace( "@double_dot@", "::", $function );
                $params = str_replace( "@double_dot@", "::", $params );


            }
            else
                $function = $params = null;

            $php_var = $var_name . $variable_path;

            // compile the variable for php
            if( isset( $function ) ){
                if( $php_var )
                    $php_var = $php_left_delimiter . ( !$is_init_variable && $echo ? 'echo ' : null ) . ( $params ? "( $function( $php_var, $params ) )" : "$function( $php_var )" ) . $php_right_delimiter;
                else
                    $php_var = $php_left_delimiter . ( !$is_init_variable && $echo ? 'echo ' : null ) . ( $params ? "( $function( $params ) )" : "$function()" ) . $php_right_delimiter;
            }
            else
                $php_var = $php_left_delimiter . ( !$is_init_variable && $echo ? 'echo ' : null ) . $php_var . $extra_var . $php_right_delimiter;

            $html = str_replace( $tag, $php_var, $html );

        }

        return $html;

    }



    function var_replace( $html, $tag_left_delimiter, $tag_right_delimiter, $php_left_delimiter = null, $php_right_delimiter = null, $loop_level = null, $echo = null ){

        //all variables
        if( preg_match_all( '/' . $tag_left_delimiter . '\$(\w+(?:\.\${0,1}[A-Za-z0-9_]+)*(?:(?:\[\${0,1}[A-Za-z0-9_]+\])|(?:\-\>\${0,1}[A-Za-z0-9_]+))*)(.*?)' . $tag_right_delimiter . '/', $html, $matches ) ){

            for( $parsed=array(), $i=0, $n=count($matches[0]); $i<$n; $i++ )
                $parsed[$matches[0][$i]] = array('var'=>$matches[1][$i],'extra_var'=>$matches[2][$i]);

            foreach( $parsed as $tag => $array ){

                //variable name ex: news.title
                $var = $array['var'];

                //function and parameters associate to the variable ex: substr:0,100
                $extra_var = $array['extra_var'];

                // check if there's any function disabled by blackList
                $this->function_check( $tag );

                $extra_var = $this->var_replace( $extra_var, null, null, null, null, $loop_level );

                // check if there's an operator = in the variable tags, if there's this is an initialization so it will not output any value
                $is_init_variable = preg_match( "/^[a-z_A-Z\.\[\](\-\>)]*=[^=]*$/", $extra_var );

                //function associate to variable
                $function_var = ( $extra_var and $extra_var[0] == '|') ? substr( $extra_var, 1 ) : null;

                //variable path split array (ex. $news.title o $news[title]) or object (ex. $news->title)
                $temp = preg_split( "/\.|\[|\-\>/", $var );

                //variable name
                $var_name = $temp[ 0 ];

                //variable path
                $variable_path = substr( $var, strlen( $var_name ) );

                //parentesis transform [ e ] in [" e in "]
                $variable_path = str_replace( '[', '["', $variable_path );
                $variable_path = str_replace( ']', '"]', $variable_path );

                //transform .$variable in ["$variable"] and .variable in ["variable"]
                $variable_path = preg_replace('/\.(\${0,1}\w+)/', '["\\1"]', $variable_path );

                // if is an assignment also assign the variable to $this->var['value']
                if( $is_init_variable )
                    $extra_var = "=\$this->var['{$var_name}']{$variable_path}" . $extra_var;



                //if there's a function
                if( $function_var ){

                    // check if there's a function or a static method and separate, function by parameters
                    $function_var = str_replace("::", "@double_dot@", $function_var );


                    // get the position of the first :
                    if( $dot_position = strpos( $function_var, ":" ) ){

                        // get the function and the parameters
                        $function = substr( $function_var, 0, $dot_position );
                        $params = substr( $function_var, $dot_position+1 );

                    }
                    else{

                        //get the function
                        $function = str_replace( "@double_dot@", "::", $function_var );
                        $params = null;

                    }

                    // replace back the @double_dot@ with ::
                    $function = str_replace( "@double_dot@", "::", $function );
                    $params = str_replace( "@double_dot@", "::", $params );
                }
                else
                    $function = $params = null;

                //if it is inside a loop
                if( $loop_level ){
                    //verify the variable name
                    if( $var_name == 'key' )
                        $php_var = '$key' . $loop_level;
                    elseif( $var_name == 'value' )
                        $php_var = '$value' . $loop_level . $variable_path;
                    elseif( $var_name == 'counter' )
                        $php_var = '$counter' . $loop_level;
                    else
                        $php_var = '$' . $var_name . $variable_path;
                }else
                    $php_var = '$' . $var_name . $variable_path;

                // compile the variable for php
                if( isset( $function ) )
                    $php_var = $php_left_delimiter . ( !$is_init_variable && $echo ? 'echo ' : null ) . ( $params ? "( $function( $php_var, $params ) )" : "$function( $php_var )" ) . $php_right_delimiter;
                else
                    $php_var = $php_left_delimiter . ( !$is_init_variable && $echo ? 'echo ' : null ) . $php_var . $extra_var . $php_right_delimiter;

                $html = str_replace( $tag, $php_var, $html );


            }
        }

        return $html;
    }



    /**
     * Check if function is in black list (sandbox)
     *
     * @param string $code
     * @param string $tag
     */
    protected function function_check( $code ){

        $preg = '#(\W|\s)' . implode( '(\W|\s)|(\W|\s)', self::$blackList ) . '(\W|\s)#';

        // check if the function is in the black list (or not in white list)
        if( count(self::$blackList) && preg_match( $preg, $code, $match ) ){

            // find the line of the error
            $line = 0;
            $rows=explode("\n",$this->tpl['source']);
            while( !strpos($rows[$line],$code) )
                $line++;

            // stop the execution of the script
            $e = new RainTpl_SyntaxException('Unallowed syntax in ' . $this->tpl['tplFile'] . ' template');
            throw $e->setTemplateFile($this->tpl['tplFile'])
                ->setTag($code)
                ->setTemplateLine($line);
        }

    }

    /**
     * Prints debug info about exception or passes it further if debug is disabled.
     *
     * @param RainTpl_Exception $e
     * @return string
     */
    protected function printDebug(RainTpl_Exception $e){
        if (!self::$debug) {
            throw $e;
        }
        $output = sprintf('<h2>Exception: %s</h2><h3>%s</h3><p>template: %s</p>',
            get_class($e),
            $e->getMessage(),
            $e->getTemplateFile()
        );
        if ($e instanceof RainTpl_SyntaxException) {
            if (null != $e->getTemplateLine()) {
                $output .= '<p>line: ' . $e->getTemplateLine() . '</p>';
            }
            if (null != $e->getTag()) {
                $output .= '<p>in tag: ' . htmlspecialchars($e->getTag()) . '</p>';
            }
            if (null != $e->getTemplateLine() && null != $e->getTag()) {
                $rows=explode("\n",  htmlspecialchars($this->tpl['source']));
                $rows[$e->getTemplateLine()] = '<font color=red>' . $rows[$e->getTemplateLine()] . '</font>';
                $output .= '<h3>template code</h3>' . implode('<br />', $rows) . '</pre>';
            }
        }
        $output .= sprintf('<h3>trace</h3><p>In %s on line %d</p><pre>%s</pre>',
            $e->getFile(), $e->getLine(),
            nl2br(htmlspecialchars($e->getTraceAsString()))
        );
        return $output;
    }
}


/**
 * Basic Rain tpl exception.
 */
class RainTpl_Exception extends Exception{
    /**
     * Path of template file with error.
     */
    protected $templateFile = '';

    /**
     * Returns path of template file with error.
     *
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->templateFile;
    }

    /**
     * Sets path of template file with error.
     *
     * @param string $templateFile
     * @return RainTpl_Exception
     */
    public function setTemplateFile($templateFile)
    {
        $this->templateFile = (string) $templateFile;
        return $this;
    }
}

/**
 * Exception thrown when template file does not exists.
 */
class RainTpl_NotFoundException extends RainTpl_Exception{}

/**
 * Exception thrown when syntax error occurs.
 */
class RainTpl_SyntaxException extends RainTpl_Exception{
    /**
     * Line in template file where error has occured.
     *
     * @var int | null
     */
    protected $templateLine = null;

    /**
     * Tag which caused an error.
     *
     * @var string | null
     */
    protected $tag = null;

    /**
     * Returns line in template file where error has occured
     * or null if line is not defined.
     *
     * @return int | null
     */
    public function getTemplateLine()
    {
        return $this->templateLine;
    }

    /**
     * Sets  line in template file where error has occured.
     *
     * @param int $templateLine
     * @return RainTpl_SyntaxException
     */
    public function setTemplateLine($templateLine)
    {
        $this->templateLine = (int) $templateLine;
        return $this;
    }

    /**
     * Returns tag which caused an error.
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Sets tag which caused an error.
     *
     * @param string $tag
     * @return RainTpl_SyntaxException
     */
    public function setTag($tag)
    {
        $this->tag = (string) $tag;
        return $this;
    }
}

// -- end
