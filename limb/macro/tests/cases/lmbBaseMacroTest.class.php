<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

class lmbBaseMacroTest extends UnitTestCase
{
  public $base_dir;
  public $tpl_dir;
  public $cache_dir;
  public $tags_dir;
  public $filters_dir;
  
  function setUp()
  {
    $this->base_dir = LIMB_VAR_DIR . '/tpl';
    $this->tpl_dir = $this->base_dir;      
    $this->cache_dir = $this->base_dir . '/compiled';
    $this->tags_dir = dirname(__FILE__).'/../../src/tags';
    $this->filters_dir = dirname(__FILE__).'/../../src/filters';
    
    lmbFs :: rm($this->base_dir);
    lmbFs :: mkdir($this->base_dir);
    lmbFs :: mkdir($this->tpl_dir);
    lmbFs :: mkdir($this->cache_dir);
    lmbFs :: mkdir($this->tags_dir);
    lmbFs :: mkdir($this->filters_dir);
  }

  protected function _createMacro($file)
  {
    return new lmbMacroTemplate($file, $this->_createMacroConfig());
  }

  protected function _createTemplate($code, $name)
  {
    $file = $this->tpl_dir . '/'. $name;
    file_put_contents($file, $code);
    return $file;
  }

  protected function _createMacroTemplate($code, $name)
  {
    $file = $this->_createTemplate($code, $name);
    return $this->_createMacro($file);
  }

  protected function _createMacroConfig()
  {
    $config = array(
      'cache_dir' => $this->cache_dir,
      'is_force_compile' => true,
      'is_force_scan' => true,     
      'tpl_scan_dirs' =>  array($this->tpl_dir),
      'tags_scan_dirs' => array($this->tags_dir),
      'filters_scan_dirs' => array($this->filters_dir)
    );
    return $config;
  }
}