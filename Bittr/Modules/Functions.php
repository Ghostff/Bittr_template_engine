<?php
class Functions extends Controls
{
    protected function toFile($path_and_name, $write)
    {
        file_put_contents($path_and_name, $write, FILE_APPEND | LOCK_EX);
    }
    protected function makeDir($path_and_name)
    {
        if (!is_dir($path_and_name)) {
            mkdir($path_and_name);
        }
        return true;
    }
    protected function erroHandl($error, $type)
    {
        if (SANDBOX) {
            if (SANDBOX_TYPE == 1) {
                die($this->dump($error));
            }
            elseif (SANDBOX_TYPE == 2){
                $log_dir = ROOT . 'Logs' . DSEP;
                if ($this->makeDir($log_dir)) {
                    $this->toFile($log_dir . $type . '.log', '[' . DATE . ']:' . $error . PHP_EOL);
                }
                else {
                    die($this->dump($this->lang('CANT_MK_DIR', array('Logs'))));
                }
            }
            else {
                die($this->dump($this->lang('INVL_DBG_LVL', array(SANDBOX_TYPE))));    
            }    
        }
    }
    protected function lang($key, $markers = null)
    {
        
        global $lang;
        //Ensure language key exists
        if (!array_key_exists($key, $lang)) {
            return $this->erroHandl('No language key \'' . $key . '\' found', $this->lang('ER_LG'));
        }
        else{
            if ($markers == NULL) {
                return $lang[$key];
            }
            else{
                //Replace any dyamic markers
                $string = $lang[$key];
                $iteration = 1;
                foreach ($markers as $marker) {
                    $string = str_replace("%m" . $iteration . "%", $marker, $string);
                    $iteration++;
                }
                return $string;
            }
        }
    }
    protected function isValidTemplate($template_name)
    {
        $template = $this->template_dir . $template_name . TPL_EX;
        if (file_exists($template)) {
            $this->template = $template;
            return true;
        }
        else {
            $this->erroHandl($this->lang('FILE_N_EXT', array($template_name, $this->template_dir)), $this->lang('ER_LG'));
            return false;
        }
        
    }
    protected function staticAttributes()
    {    
        return array('v' => static::VERSION, 'd' => static::RELEASE_DATE);
    }
    protected function getVersion()
    {
        return array('VS' => 1.0, 'DF' => 10);
    }
    protected function checkUpdate($check_update)
    {
        if ($check_update) {
            //get latest version
            $latest_version = $this->getVersion();
            //get version of biter you are currently using
            $working_version = static::VERSION;
            if ( $latest_version['VS'] != $working_version) {
                $version_diffrent = ($latest_version['VS'] - $working_version) * 10;
                if ($version_diffrent < $latest_version['DF']) {
                    $this->erroHandl($this->lang('UDATED_V_NL', array($latest_version['VS'])), $this->lang('V_LOG'));
                }
                else {
                    $this->erroHandl($this->lang('UDATED_V_L'), $this->lang('V_LOG'));
                }
            }
        }
    }
}