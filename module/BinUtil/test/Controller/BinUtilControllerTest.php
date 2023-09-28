<?php
namespace BinUtilTest\Controller;

use BinUtil\Controller\BinUtilController;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use BinUtil\Model\Bin;
use Laminas\ServiceManager\ServiceManager;

class BinUtilControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = false;

    protected $bin;

    protected function setUp() : void{
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            // Grabbing the full application configuration:
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));
        parent::setUp();
        $this->configureServiceManager($this->getApplicationServiceLocator());
    }

    protected function configureServiceManager(ServiceManager $services){
        $services->setAllowOverride(true);

        $services->setService('config', $this->updateConfig($services->get('config')));
        $services->setService(Bin::class, $this->mockBin()->reveal());

        $services->setAllowOverride(false);
    }

    protected function updateConfig($config){
        $config['db'] = [];
        return $config;
    }

    protected function mockBin(){
        $this->bin = $this->prophesize(Bin::class);
        return $this->bin;
    }

    public function testIndexActionCanBeAccessed(){
            $this->dispatch('/binutil');
            $this->assertResponseStatusCode(500);
            $this->assertModuleName('binutil');
            $this->assertControllerName(BinUtilController::class);
            $this->assertControllerClass('BinUtilController');
            $this->assertMatchedRouteName('binutil');
    }

    public function testBinConstruct(){
        $bin = new Bin("frequency");

        $this->assertSame($bin->getFilterType(),"frequency");
        $this->assertNull($bin->input,"input should be null");
        $this->assertSame($bin->high,array());
        $this->assertSame($bin->medium,array());
        $this->assertSame($bin->low,array());

    }

    public function testWidth(){
        $bin = new Bin("width");
        $inputArray = array("0.1", "3.4", "3.5", "3.6", "7.0", "9.0", "6.0", "4.4", "2.5", "3.9", "4.5", "2.8");
        $bin->setInput($inputArray);
        $bin->widthFilter();
        $this->assertSame($bin->high,array("7.0","9.0"));
        $this->assertSame($bin->medium,array("3.4","3.5","3.6","3.9","4.4","4.5","6.0"));
        $this->assertSame($bin->low,array("0.1","2.5","2.8"));
    }
    public function testFrequency(){
        $bin = new Bin("frequency");
        $inputArray = array("0.1", "3.4", "3.5", "3.6", "7.0", "9.0", "6.0", "4.4", "2.5", "3.9", "4.5", "2.8");
        $bin->setInput($inputArray);
        $bin->frequencyFilter();
        $this->assertSame($bin->high,array("4.5","6.0","7.0","9.0"));
        $this->assertSame($bin->medium,array("3.5","3.6","3.9","4.4"));
        $this->assertSame($bin->low,array("0.1","2.5","2.8","3.4"));
    }
}