<?php namespace Tests\Support;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\CIUnitTestCase;

class DbTestCase extends CIUnitTestCase
{
    use DatabaseTestTrait;

    /**
     * Should the database be refreshed before each test?
     *
     * @var boolean
     */
    protected $refresh = true;


    /**
     * The path to the seeds directory.
     * Allows overriding the default application directories.
     *
     * @var string
     */
    protected $basePath = SUPPORTPATH . 'Database/';

    /**
     * Should run db migration?
     *
     * @var boolean
     */
    protected $migrate = false;

    protected function regressDatabase()
    {
        //$sql = file_get_contents('/opt/lampp/htdocs/my_project/tests/_support/Database/radostan_sqlite.sql');
        //$this->db->query($sql);
        $sql = "
            DROP TABLE IF EXISTS grejanje;
            CREATE TABLE grejanje (
                idGrejanja INTEGER PRIMARY KEY AUTOINCREMENT,
                naziv TEXT NOT NULL
            );
        ";
    }

    public function setUp(): void
    {
        parent::setUp();
        // Extra code to run before each test
    }

    public function tearDown(): void
    {
        parent::tearDown();
        // Extra code to run after each test
    }
}