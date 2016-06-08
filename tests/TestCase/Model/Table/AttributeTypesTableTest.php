<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttributeTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttributeTypesTable Test Case
 */
class AttributeTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttributeTypesTable
     */
    public $AttributeTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attribute_types',
        'app.quizzes',
        'app.users',
        'app.shared_users',
        'app.data',
        'app.attributes',
        'app.data_attributes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AttributeTypes') ? [] : ['className' => 'App\Model\Table\AttributeTypesTable'];
        $this->AttributeTypes = TableRegistry::get('AttributeTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttributeTypes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
