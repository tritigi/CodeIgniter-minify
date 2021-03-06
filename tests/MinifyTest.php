<?php
/**
 * Created by PhpStorm.
 * User: slav
 * Date: 10/02/15
 * Time: 9:51 AM
 */

class MinifyTest extends PHPUnit_Framework_TestCase {

	public $minify;

	public function setUp() {
		include_once('application/libraries/Minify.php');
	}

	public function testInit()
	{

		// Arrange
		$this->minify = new Minify();

		// Assert
		$this->assertTrue(is_object($this->minify), 'is object');
	}

	public function testJsCompress()
	{
		$this->minify = new Minify();

		$this->minify->js_dir = 'assets/js';
		$this->minify->js(array('helpers.js'));

		$result = $this->minify->deploy_js(FALSE, 'ut.js');
		$this->assertTrue(is_string($result), 'deploy js with name');

		$this->assertEquals($this->minify->js_file, 'ut.min.js', 'output js file name');
	}

	public function testCssCompress()
	{
		$this->minify = new Minify();

		$this->minify->css_dir = 'assets/css';
		$this->minify->css(array('style.css'));

		$result = $this->minify->deploy_css(TRUE, 'ut.css');
		$this->assertTrue(is_string($result), 'deploy css with name');

		$this->assertEquals($this->minify->css_file, 'ut.min.css', 'output css file name');
	}

	public function testJsCompressWithAutoNames()
	{
		$this->minify = new Minify();

		$this->minify->auto_names = TRUE;
		$this->minify->js_dir = 'assets/js';
		$this->minify->js(array('helpers.js'));

		$result = $this->minify->deploy_js(FALSE);
		$this->assertTrue(is_string($result), 'deploy js with auto name');

		$this->assertEquals($this->minify->js_file, '91e30b9b77dc616476b94acf4dbb25c1.min.js', 'output js auto file name');
	}

	public function testCssCompressWithAutoNames()
	{
		$this->minify = new Minify();

		$this->minify->auto_names = TRUE;
		$this->minify->css_dir = 'assets/css';
		$this->minify->css(array('style.css'));

		$result = $this->minify->deploy_css(TRUE);
		$this->assertTrue(is_string($result), 'deploy css with auto name');

		$this->assertEquals($this->minify->css_file, '72ac8bfd7cb9dd0f9df9ef4aafe0c714.min.css', 'output css auto file name');
	}

	public function testJsCompressWithAdd()
	{
		$this->minify = new Minify();

		$this->minify->js_dir = 'assets/js';
		$this->minify->add_js(array('helpers.js'))->add_js('jqModal.js');

		$result = $this->minify->deploy_js(FALSE);
		$this->assertTrue(is_string($result), 'deploy with add_js');

		$this->assertEquals($this->minify->js_file, 'scripts.min.js', 'output js default file name');
	}

	public function testCssCompressWithAdd()
	{
		$this->minify = new Minify();

		$this->minify->css_dir = 'assets/css';
		$this->minify->add_css(array('style.css'))->add_css('browser-specific.css');

		$result = $this->minify->deploy_css(TRUE);
		$this->assertTrue(is_string($result), 'deploy with add_css');

		$this->assertEquals($this->minify->css_file, 'styles.min.css', 'output css default file name');
	}
}
