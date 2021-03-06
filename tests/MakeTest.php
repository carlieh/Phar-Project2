<?php
/**
 * namespace
 */
namespace tests;

use src\PharCompiler\Console\Make;

$autoloader = require_once __DIR__ . '/../vendor/autoload.php';
$autoloader->add('PharCompiler', __DIR__ . '/../src');

/**
 * MakeTest class extending PHPUnit_Framework_TestCase
 *
 * @package tests
 *
 * @author Jeremy Mills
 * @author Insu Mun
 * @author Carlie Hiel
 *
 * @copyright 2013
 * @version PHP 5.3
 */
class MakeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * run_protected_method
     *
     * @access protected 
     */
    protected function run_protected_method($obj, $method, $args = array()) {
        $method = new \ReflectionMethod(get_class($obj), $method);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
    
    /**
     * testInit tests __construct() of Make class
     *
     * @access public
     */
    public function testInit() {
        $test = new \PharCompiler\Console\Make();
        
        $this->assertEquals(true, is_object($test));
    }
    
    /**
     * testConfigure tests configure() of Make class
     *
     * @access public
     */
    public function testConfigure() {
        $test = new \PharCompiler\Console\Make();
        $this->assertEquals(true, is_object($test));
        
        //$result = $this->run_protected_method($test, 'configure', array());
        
        //$this->assertEquals('Name', $result->setName('Name'));
        
        //$name->configure()->setName('Name');
        
        //$this->assertEquals('Name', $test->configure()->setName('Name'));
       // $this->assertEquals('Description', $test->configure()->setDescription('Description'));*/
        
    }
    
    /**
     * testExecute tests execute() of Make class
     *
     * @access public
     */
    public function testExecute() {
        //Cannot be tested because it is a command line call
    }
    
    /**
     * testCompress tests compress() of Make class
     *
     * @access public
     */
    public function testCompress() {
        $test = new \PharCompiler\Console\Make();
        
        $file = 'far.phar';
        $stub = 'src/index.php';
        $root = '../../Review';
        
        $test->compress($file, $stub, $root);
        $this->assertFileExists($file);
        
        /*$this->assertEquals($test->compress($file, $stub, $root) , print "CREATED $file.. \nthank you for using:
 _______    _____      _   __	  _   __        _
|__   __|  / ___ \    | | / /    | | / /       / \
   | |	  / /   \ \   | |/ /     | |/ /       / / \
   | |   | |    | |   | | /      | | /       / /_\ \
   | |   | |    | |   | |\ \     | |\ \     / _____ \
 __| |   \ \___/ /    | | \ \    | | \ \   / /     \ \
|____/    \_____/     |_|  \_\   |_|  \_\ /_/       \_\
(c) Jeremy Mills <jeremy.mills89@gmail.com>
(c) Insu Mun <mis8680@gmail.com>
(c) Carlie Hiel <carlie.hiel@gmail.com>
Jokka is a complete symfony based phar compiling tool.
Jokka is built with the help of (c) Jeremy Perret's <jeremy@devstar.org> Empir php compiling tool.
");*/
        //$this->assertEquals($test->compress($file, $stub, $root) instanceof CommandOutput);
    }
    
    /**
     * testIsPharWritiable tests is_phar_writable() of Make class
     *
     * @access public
     */
    public function testIsPharWritable() {
        $test = new \PharCompiler\Console\Make();
        
        $file = 'far.phar';
        $stub = 'src/index.php';
        $root = '../../Review';
        
        $test->compress($file, $stub, $root);
        
        $result = $this->run_protected_method($test, 'is_phar_writable', array());
        
        $this->assertEquals(null, $result);

    }
    
    /**
     * testStubExists tests stub_exists() of Make class
     *
     * @access public
     */
    public function testStubExists() {
        $test = new \PharCompiler\Console\Make();
        
        $file = 'far.phar';
        $stub = 'src/index.php';
        $root = '../../Review';
        
        $test->compress($file, $stub, $root);
        
        $this->assertFileExists($root . '/' . $stub);       
        
    }
    
    /**
     * testError tests error() of Make class
     *
     * @access public
     */
    public function testError() {
        $test = new \PharCompiler\Console\Make();
        
        $result = $this->run_protected_method($test, 'error', array(1));
        
        $this->assertEquals(1, $result);
    }
    
    /**
     * testSuccess tests success() of Make class
     *
     * @access public
     */
    public function testSuccess() {
        $test = new \PharCompiler\Console\Make();
        
        $result = $this->run_protected_method($test, 'success', array('success'));

        $this->assertEquals(null, $result);
        
    }
    
    /**
     * testScandir tests _scandir() of Make class
     *
     * @access public
     */
    public function testScandir() {
        $test = new \PharCompiler\Console\Make();
        $stub = 'src/index.php';
        $root = '../../Review';
        
        $result = $this->run_protected_method($test, 'success', array('../../Review/src/index.php'));
        
        $this->assertEquals(null, $result);
    }
}
